<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ImageUploaderController extends Controller
{
    public function index(): View|RedirectResponse
    {
        return view('image-upload');
    }

    static public function store_image_product(Product $product, UploadedFile $file, int $priority = -1)
    {
        $lowest_priority = $product->images()->max('priority') ?? -1;

        // 'priority' was not set in the form, set it to the lowest one
        if ($priority == -1 || $priority > $lowest_priority) {
            $priority = $lowest_priority + 1;
        } else { // priority is in 0..=lowest
            DB::beginTransaction();
            // sql sucks
            // $product->images()->where('priority', '>=', $priority)->increment('priority', 1);
            // ^^ won't work because of UNIQUE constraint violation, although logically that wouldn't happen
            try {
                $images = $product->images()->where('priority', '>=', $priority)->orderBy('priority', 'desc')->get();
                foreach ($images as $image) {
                    $image->priority += 1;
                    $image->save();
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        }

        $filePath = $file->store('images/db', 'public');
        Image::factory()->forProduct($product)->create(['location' => $filePath, 'priority' => $priority]);
    }

    public function store_db(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'image' => ['required', Rule::imageFile()->max(4096)->types('image/*')],
            'product_id' => ['required', 'int', Rule::exists('products', 'id')],
            'priority' => ['nullable', 'int', 'min:0'],
        ]);

        $productId = intval($validatedData['product_id']);
        $priority = intval($validatedData['priority'] ?? -1);

        try {
            $product = Product::findOrFail($productId);
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Product' . $productId . 'not found');
        }

        try {
            $this->store_image_product($product, $request->file('image'), $priority);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Database error: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Image uploaded successfully');
    }

    public function store_static(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'image' => ['required', Rule::imageFile()->max(4096)->types('image/*')],
            'filename' => ['nullable', 'string'],
        ]);

        $file = $request->file('image');
        $filename = !empty($validatedData['filename']) ? $validatedData['filename'] : $file->hashName() . '.' . $file->extension();
        $file->storeAs('images/static', $filename, 'public');

        return redirect()->back()->with('success', 'Image uploaded as "' . $filename . '" successfully');
    }
}
