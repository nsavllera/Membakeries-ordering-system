<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Http\Controllers\GmailServices;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $reviews = Review::query()
            ->when($search, function ($query, $search) {
                $query->where('comment', 'like', "%$search%")
                      ->orWhere('order_id', 'like', "%$search%");
            })
            ->latest()
            ->paginate(10);

        return view('reviews.index', compact('reviews', 'search'));
    }


    public function store(Request $request, GmailServices $gmail)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review = Review::create([
            'order_id' => $validated['order_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);
        $adminEmail = env('ADMIN_EMAIL');
        $gmail->sendEmail(
            $adminEmail, 
            'New Review Received',
            "<p>Review for Order #{$review->order_id}:</p><p><strong>Rating:</strong> {$review->rating}</p><p>{$review->comment}</p>"
        );

        return redirect()->back()->with('message', 'Thank you for your review!');
    }

}
