<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Http\Controllers\GmailServices;

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

    public function reply(Request $request, $id, GmailServices $gmail)
    {
        $request->validate([
            'reply' => 'required|string|max:2000',
        ]);

        $message = Message::with('user')->findOrFail($id);
        $message->reply = $request->reply;
        $message->save();

        if ($message->user && $message->user->email) {
            $gmail->sendEmail(
                $message->user->email,
                'Reply to Your Inquiry',
                "<p><strong>Subject:</strong> {$message->subject}</p>
                <p><strong>Your Message:</strong> {$message->message}</p>
                <hr>
                <p><strong>Admin Reply:</strong> {$message->reply}</p>"
            );
        }

        return back()->with('message', 'Reply sent successfully.');
    }

    public function store(Request $request, GmailServices $gmail)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        $message = Message::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        $gmail->sendEmail(
            'nsavllera@gmail.com',
            'New Customer Message',
            "<p><strong>Subject:</strong> {$message->subject}</p><p>{$message->message}</p>"
        );

        return back()->with('message', 'Message sent successfully.');
    }

}
