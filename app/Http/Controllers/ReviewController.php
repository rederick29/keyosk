<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function view(Request $request, int $reviewId): View|RedirectResponse|JsonResponse
    {
        if (!$request->ajax()) {
            return redirect()->route('index');
        }

        $review = Review::find($reviewId);
        if (!$review) {
            return response()->json(['error' => 'Review ' . $reviewId . ' not found.'], 404);
        }

        return view('components/products/review', compact('review'));
    }

    public function index(Request $request, int $productId): View|RedirectResponse
    {
        $product = Product::find($productId);

        if(!$product) {
            return back()->with(['error' => 'product ' . $productId . ' not found.']);
        }

        return view('review', compact('product'));
    }

    public function store(Request $request, int $productId): RedirectResponse|JsonResponse
    {
        $validatedData = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:10'],
            'subject' => ['nullable', 'string', 'max:100'],
            'comment' => ['nullable', 'string', 'max:1000'],
            'anonymous' => ['nullable', 'boolean'],
        ]);

        if ($productId == null) {
            $error = 'Product ID null';
            return $request->ajax() ? response()->json(compact('error'), 404) : back()->with(compact('error'));
        }

        if ($validatedData['subject'] == null ^ $validatedData['comment'] == null) {
            $error = 'Both the subject and review details should be set; or both should be empty';
            return $request->ajax() ? response()->json(compact('error'), 500) : back()->with(compact('error'));
        }

        if (!Product::findOrderedBy($productId, Auth::user())) {
            $error = 'You have not ordered this product before';
            return $request->ajax() ? response()->json(compact('error'), 500) : back()->with(compact('error'));
        }

        if (Review::findReview($productId, Auth::id())) {
            $error = 'You have already reviewed this product';
            return $request->ajax() ? response()->json(compact('error'), 500) : back()->with(compact('error'));
        }

        Review::factory()->create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'anonymous' => $validatedData['anonymous'] ?? false,
            'rating' => $validatedData['rating'],
            'subject' => $validatedData['subject'],
            'comment' => $validatedData['comment'],
        ]);

        return $request->ajax() ? response()->json(['success' => 'Created review successfully']) : back()->with('success', 'Created review successfully');
    }

    public function update(Request $request, int $reviewId): RedirectResponse|JsonResponse
    {
        $validatedData = $request->validate([
            'rating' => ['nullable', 'integer', 'min:1', 'max:10'],
            'subject' => ['nullable', 'string', 'max:100'],
            'comment' => ['nullable', 'string', 'max:1000'],
            'anonymous' => ['nullable', 'boolean'],
        ]);

        $review = Review::find($reviewId)->where('user_id', Auth::id())->first();
        if (!$review) {
            $error = 'Review not found';
            return $request->ajax() ? response()->json(compact('error'), 404) : back()->with(compact('error'));
        }

        $updates = [];
        foreach ($validatedData as $field => $form_input) {
            if ($form_input != null && $review->$field != $field) {
                $updates[$field] = $form_input;
            }
        }
        $review->update($updates);

        return $request->ajax() ? response()->json(['success' => 'Edited review successfully']) : back()->with('success', 'Edited review successfully');
    }


    public function destroy(Request $request, int $reviewId): RedirectResponse|JsonResponse
    {
        $review = Review::find($reviewId)->where('user_id', Auth::id())->first();
        if (!$review) {
            $error = 'Review not found';
            return $request->ajax() ? response()->json(compact('error'), 404) : back()->with(compact('error'));
        }
        $review->delete();
        return $request->ajax() ? response()->json(['success' => 'Removed review successfully']) : back()->with('success', 'Removed review successfully');
    }
}
