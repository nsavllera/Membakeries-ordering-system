<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $reviews = Review::with(['user', 'order'])
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })->orWhere('comment', 'like', "%$search%");
            })
            ->latest()
            ->paginate(10);

        return view('reviews.index', compact('reviews', 'search'));
    }
}
