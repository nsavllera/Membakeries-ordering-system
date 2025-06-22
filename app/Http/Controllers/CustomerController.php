<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $customers = User::query()
            ->where('role', 'customer') 
            ->when($search, fn($q) =>
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('customers.index', compact('customers', 'search'));
    }
}
