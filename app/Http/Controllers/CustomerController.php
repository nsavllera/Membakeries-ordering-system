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
            ->paginate(10);

        return view('customers.index', compact('customers', 'search'));
    }

    public function ban($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = true;
        $user->save();

        return back()->with('message', 'Customer has been banned successfully.');
    }

}
