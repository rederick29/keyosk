<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;

class ReviewController extends Controller
{
    // Store a new review
    public function store(Request $request, $productId)
    {
        // Validation
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'subject' => 'required|string|max:255',
            'comment' => 'nullable|string',
        ]);

        // Creating the review
        $review = new Review();
        $review->rating = $request->input('rating');
        $review->subject = $request->input('subject');
        $review->comment = $request->input('comment');
        $review->user_id = Auth::id(); // Assuming the user is authenticated
        $review->product_id = $productId;

        $review->save();

        return redirect()->route('product.show', $productId)->with('success', 'Review added successfully!');
    }

    // Fetch reviews for a product
    public function showReviews($productId)
    {
        $product = Product::findOrFail($productId);
        $reviews = $product->reviews()->get(); // Assuming 'reviews' relationship is defined in the Product model

        return view('product.show', compact('product', 'reviews'));
    }
}
