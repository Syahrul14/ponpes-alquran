<?php

namespace App\Http\Controllers\Website\Contact;

use App\Http\Controllers\Controller;
use App\Repositories\Website\Contact\WebsiteContactRepository;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contactRepository;

    public function __construct(WebsiteContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function index()
    {
        $contactInfo = $this->contactRepository->getContactInfo();
        return view('website.hubungi_kami.hubungi_kami_content', compact('contactInfo'));
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:5',
        ]);

        try {
            $this->contactRepository->storeMessage($validated);

            return redirect()->back()->with('success', 'Alhamdulillah, pesan Anda telah berhasil dikirim! Pihak pesantren akan segera merespons melalui email Anda.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim pesan. Silakan coba beberapa saat lagi.')->withInput();
        }
    }
}

