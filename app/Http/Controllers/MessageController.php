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
                '📬 Reply to Your Inquiry – Membakeries',
                "
                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #e0e0e0; padding: 20px; border-radius: 10px; background-color: #ffffff;'>
                    <h2 style='color: #6a1b9a;'>📬 We've Replied to Your Inquiry</h2>

                    <p>Hi <strong>{$message->user->name}</strong>,</p>

                    <p>Thank you for reaching out to us. Below is the response to your inquiry:</p>

                    <div style='margin-top: 20px; padding: 15px; background-color: #f3e5f5; border-left: 4px solid #9c27b0;'>
                        <p style='margin: 0;'><strong>Subject:</strong> {$message->subject}</p>
                        <p style='margin: 0;'><strong>Your Message:</strong><br>{$message->message}</p>
                    </div>

                    <div style='margin-top: 20px; padding: 15px; background-color: #e8f5e9; border-left: 4px solid #43a047;'>
                        <p style='margin: 0;'><strong>Admin's Reply:</strong><br>{$message->reply}</p>
                    </div>

                    <p style='margin-top: 30px;'>We hope this answers your question. Feel free to contact us if you have any more inquiries.</p>

                    <p>Warm regards,<br><strong>Membakeries Team</strong></p>

                    <hr style='margin: 20px 0; border: none; border-top: 1px solid #ddd;'>
                    <small style='color: #999;'>This is an automated message. Please do not reply directly to this email.</small>
                </div>
                "
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
