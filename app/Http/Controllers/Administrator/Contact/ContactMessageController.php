<?php

namespace App\Http\Controllers\Administrator\Contact;

use App\Http\Controllers\Controller;
use App\Repositories\Administrator\Contact\ContactMessageRepository;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    protected $contactMessageRepository;

    public function __construct(ContactMessageRepository $contactMessageRepository)
    {
        $this->contactMessageRepository = $contactMessageRepository;
    }

    public function getData()
    {
        $data = $this->contactMessageRepository->getData();
        return view('administrator.cms.contact.contact_messages', compact('data'));
    }

    public function markAsRead($id)
    {
        $this->contactMessageRepository->markAsRead($id);
        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        try {
            $this->contactMessageRepository->delete($id);
            return redirect()->route('admin.contact_messages.getData')->with('success', 'Pesan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

