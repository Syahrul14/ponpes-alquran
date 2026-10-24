<?php

namespace App\Http\Controllers\Administrator\Contact;

use App\Http\Controllers\Controller;
use App\Repositories\Administrator\Contact\ContactInfoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactInfoController extends Controller
{
    protected $contactInfoRepository;

    public function __construct(ContactInfoRepository $contactInfoRepository)
    {
        $this->contactInfoRepository = $contactInfoRepository;
    }

    public function getData()
    {
        $data = $this->contactInfoRepository->getData();
        return view('administrator.cms.contact.contact_info', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'opening_hours' => 'required|string|max:255',
            'maps_iframe' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $mapsUrl = $request->maps_iframe;
            if (!empty($mapsUrl) && preg_match('/src=["\']([^"\']+)["\']/', $mapsUrl, $matches)) {
                $mapsUrl = $matches[1];
            }

            $payload = [
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'opening_hours' => $request->opening_hours,
                'maps_iframe' => $mapsUrl,
            ];

            $this->contactInfoRepository->updateOrCreate($payload);

            DB::commit();
            return redirect()->route('admin.contact_info.getData')->with('success', 'Informasi kontak pesantren berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}

