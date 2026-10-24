<?php

namespace App\Repositories\Administrator\Contact;

use App\Models\Administrator\Contact\ContactMessageModel;

class ContactMessageRepository
{
    public function getData()
    {
        return ContactMessageModel::orderBy('created_at', 'desc')->get();
    }

    public function find($id)
    {
        return ContactMessageModel::findOrFail($id);
    }

    public function markAsRead($id)
    {
        $message = ContactMessageModel::findOrFail($id);
        $message->update(['is_read' => true]);
        return $message;
    }

    public function delete($id)
    {
        $message = ContactMessageModel::findOrFail($id);
        return $message->delete();
    }
}

