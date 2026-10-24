<?php

namespace App\Http\Controllers\Administrator\Setting;

use App\Http\Controllers\Controller;
use App\Repositories\Administrator\Setting\FooterSettingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FooterSettingController extends Controller
{
    protected $footerSettingRepository;

    public function __construct(FooterSettingRepository $footerSettingRepository)
    {
        $this->footerSettingRepository = $footerSettingRepository;
    }

    public function getData()
    {
        $footerSetting = $this->footerSettingRepository->getFooterSetting();
        $socialMediaList = $this->footerSettingRepository->getSocialMediaList();

        return view('administrator.cms.setting.footer_settings', compact('footerSetting', 'socialMediaList'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'pesantren_name' => 'required|string|max:255',
            'about_text' => 'nullable|string',
            'copyright_text' => 'required|string|max:255',
            'logo' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:5120',
        ]);

        DB::beginTransaction();
        try {
            $currentSetting = $this->footerSettingRepository->getFooterSetting();

            $payload = [
                'pesantren_name' => $request->pesantren_name,
                'about_text' => $request->about_text,
                'copyright_text' => $request->copyright_text,
            ];

            if ($request->hasFile('logo')) {
                $folder = 'uploads/settings';
                if (!Storage::disk('public')->exists($folder)) {
                    Storage::disk('public')->makeDirectory($folder);
                }

                if ($currentSetting && !empty($currentSetting->logo) && Storage::disk('public')->exists($currentSetting->logo)) {
                    Storage::disk('public')->delete($currentSetting->logo);
                }

                $payload['logo'] = $request->file('logo')->store($folder, 'public');
            }

            $this->footerSettingRepository->updateOrCreateFooterSetting($payload);

            DB::commit();
            return redirect()->route('admin.footer_setting.getData')->with('success', 'Identitas dan pengaturan footer berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function storeSocialMedia(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'url' => 'required|url|max:255',
            'image' => 'required|file|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {
            $folder = 'uploads/social_media';
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            $imagePath = $request->file('image')->store($folder, 'public');

            $payload = [
                'name' => $request->name,
                'url' => $request->url,
                'image' => $imagePath,
                'is_active' => $request->has('is_active') ? (bool) $request->is_active : true,
                'order' => $request->order ?? 0,
            ];

            $this->footerSettingRepository->storeSocialMedia($payload);

            DB::commit();
            return redirect()->route('admin.footer_setting.getData')->with('success', 'Media sosial berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function updateSocialMedia(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'url' => 'required|url|max:255',
            'image' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {
            $socialMedia = $this->footerSettingRepository->findSocialMedia($id);

            $payload = [
                'name' => $request->name,
                'url' => $request->url,
                'is_active' => $request->has('is_active') ? (bool) $request->is_active : false,
                'order' => $request->order ?? 0,
            ];

            if ($request->hasFile('image')) {
                $folder = 'uploads/social_media';
                if (!Storage::disk('public')->exists($folder)) {
                    Storage::disk('public')->makeDirectory($folder);
                }

                if (!empty($socialMedia->image) && Storage::disk('public')->exists($socialMedia->image)) {
                    Storage::disk('public')->delete($socialMedia->image);
                }

                $payload['image'] = $request->file('image')->store($folder, 'public');
            }

            $this->footerSettingRepository->updateSocialMedia($id, $payload);

            DB::commit();
            return redirect()->route('admin.footer_setting.getData')->with('success', 'Media sosial berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function deleteSocialMedia($id)
    {
        DB::beginTransaction();
        try {
            $socialMedia = $this->footerSettingRepository->findSocialMedia($id);

            if (!empty($socialMedia->image) && Storage::disk('public')->exists($socialMedia->image)) {
                Storage::disk('public')->delete($socialMedia->image);
            }

            $this->footerSettingRepository->deleteSocialMedia($id);

            DB::commit();
            return redirect()->route('admin.footer_setting.getData')->with('success', 'Media sosial berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

