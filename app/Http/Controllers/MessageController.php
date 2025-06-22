<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $messages = Message::with('user')
            ->when($search, function ($q) use ($search) {
                $q->where('subject', 'like', "%$search%")
                  ->orWhere('message', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('message.index', compact('messages', 'search'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:2000',
        ]);

        $message = Message::findOrFail($id);
        $message->reply = $request->reply;
        $message->save();

        return back()->with('message', 'Reply sent successfully.');
    }
}
