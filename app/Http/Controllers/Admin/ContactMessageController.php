<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of contact messages
     */
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('subject', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $messages = $query->latest()->paginate(10);
        $unreadCount = ContactMessage::where('status', 'unread')->count();
        
        return view('admin.contact-messages.index', compact('messages', 'unreadCount'));
    }

    /**
     * Display the specified contact message
     */
    public function show(ContactMessage $contactMessage)
    {
        // Mark as read if currently unread
        if ($contactMessage->isUnread()) {
            $contactMessage->markAsRead();
        }

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    /**
     * Update admin notes
     */
    public function update(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'admin_notes' => 'nullable|string',
            'status' => 'nullable|in:unread,read,replied',
        ]);

        $contactMessage->update($validated);

        return back()->with('success', 'Message updated successfully.');
    }

    /**
     * Remove the specified contact message
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}
