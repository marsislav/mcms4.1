<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessagesController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required'
        ]);

        Message::create($request->only('name', 'email', 'message'));

        return redirect('/')->with('success', 'Message sent! Thanks! :)');
    }

    public function getMessages()
    {
        // Mark all as read when viewing
        Message::where('is_read', false)->update(['is_read' => true]);

        $messages = Message::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.messages', compact('messages'));
    }

    public function delete($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->back()->with('success', 'Message deleted successfully!');
    }

    // API endpoint: returns count of unread messages as JSON
    public function unreadCount()
    {
        $count = Message::where('is_read', false)->count();
        return response()->json(['count' => $count]);
    }
}
