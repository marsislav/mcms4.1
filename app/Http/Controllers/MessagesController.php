<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessagesController extends Controller
{
    /**
     * Handle the form submission to create a new message.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        // Create and save the message
        Message::create($request->only('name', 'email', 'message'));

        // Redirect with a success message
        return redirect('/')->with('success', 'Message sent! Thanks! :)');
    }

    /**
     * Display all messages.
     *
     * @return \Illuminate\View\View
     */
    public function getMessages()
    {
        // Fetch messages with pagination
        $messages = Message::paginate(10); // Adjust the number per page as needed
        return view('admin.messages', compact('messages'));
    }

    public function delete($id)
    {
        // Find the message by its ID
        $message = Message::findOrFail($id);

        // Delete the message
        $message->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Message deleted successfully!');
    }
}
