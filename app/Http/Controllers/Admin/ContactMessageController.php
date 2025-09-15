<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    // Constructor removed - middleware handled in routes

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = ContactMessage::recent();
        
        // Filter by read status
        if (request('filter') === 'unread') {
            $query->unread();
        } elseif (request('filter') === 'read') {
            $query->read();
        }
        
        $messages = $query->paginate(15);
        return view('admin.contact-messages.index', compact('messages'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactMessage $contactMessage)
    {
        // Mark as read when viewed
        if (!$contactMessage->is_read) {
            $contactMessage->markAsRead();
        }

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactMessage $contactMessage)
    {
        $validatedData = $request->validate([
            'notes' => 'nullable|string',
        ]);

        $contactMessage->update($validatedData);

        return redirect()->route('admin.contact-messages.show', $contactMessage)
                        ->with('success', 'Notlar güncellendi!');
    }

    /**
     * Mark as read/unread
     */
    public function markAsRead(ContactMessage $contactMessage)
    {
        $contactMessage->markAsRead();
        return redirect()->back()->with('success', 'Mesaj okundu olarak işaretlendi.');
    }

    public function markAsUnread(ContactMessage $contactMessage)
    {
        $contactMessage->markAsUnread();
        return redirect()->back()->with('success', 'Mesaj okunmadı olarak işaretlendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contact-messages.index')
                        ->with('success', 'Mesaj başarıyla silindi!');
    }
}
