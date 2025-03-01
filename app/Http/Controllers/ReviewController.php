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

    public function store(Request $request, int $productId): RedirectResponse|JsonResponse
    {
        $validatedData = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:10'],
            'subject' => ['nullable', 'string', 'max:100'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($productId == null) {
            $error = 'Product ID null';
            return $request->ajax() ? response()->json(compact('error'), 404) : back()->with(compact('error'));
        }

        if ($validatedData['subject'] == null ^ $validatedData['comment'] == null) {
            $error = 'Both the subject and review details should be set; or both should be empty';
            return $request->ajax() ? response()->json(compact('error'), 404) : back()->with(compact('error'));
        }

        if (!Product::findOrderedBy($productId, Auth::user())) {
            $error = 'You have not ordered this product before';
            return $request->ajax() ? response()->json(compact('error'), 404) : back()->with(compact('error'));
        }

        if (Review::findReview($productId, Auth::id())) {
            $error = 'You have already reviewed this product';
            return $request->ajax() ? response()->json(compact('error'), 404) : back()->with(compact('error'));
        }

        Review::factory()->create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'rating' => $validatedData['rating'],
            'subject' => $validatedData['subject'],
            'comment' => $validatedData['comment'],
        ]);

        return $request->ajax() ? response()->json(['success' => 'Created review successfully']) : back()->with('success', 'Created review successfully');
    }
}
