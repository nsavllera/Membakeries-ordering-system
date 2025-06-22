<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

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
}
