<?php

namespace App\Http\Controllers\Administrator\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Administrator\Home\HomeBannerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeBannerController extends Controller
{
    protected $homeBannerRepository;

    public function __construct(HomeBannerRepository $homeBannerRepository)
    {
        $this->homeBannerRepository = $homeBannerRepository;
    }

    public function getData()
    {
        $data = $this->homeBannerRepository->getData();
        return view('administrator.cms.home.home_banner', compact('data'));
    }

    public function store(Request $request)
    {
        $rawErrors = [];
        foreach (['image_1', 'image_2', 'image_3'] as $img) {
            if (isset($_FILES[$img]) && !empty($_FILES[$img]['name'])) {
                $err = $_FILES[$img]['error'];
                $size = $_FILES[$img]['size'];
                $name = $_FILES[$img]['name'];
                if ($err !== UPLOAD_ERR_OK) {
                    $errorNames = [
                        UPLOAD_ERR_INI_SIZE => 'UPLOAD_ERR_INI_SIZE (Melebihi upload_max_filesize PHP)',
                        UPLOAD_ERR_FORM_SIZE => 'UPLOAD_ERR_FORM_SIZE (Melebihi MAX_FILE_SIZE form)',
                        UPLOAD_ERR_PARTIAL => 'UPLOAD_ERR_PARTIAL (File hanya terupload sebagian)',
                        UPLOAD_ERR_NO_FILE => 'UPLOAD_ERR_NO_FILE (Tidak ada file)',
                        UPLOAD_ERR_NO_TMP_DIR => 'UPLOAD_ERR_NO_TMP_DIR (Folder temp PHP tidak ada)',
                        UPLOAD_ERR_CANT_WRITE => 'UPLOAD_ERR_CANT_WRITE (Gagal menulis ke disk temp)',
                        UPLOAD_ERR_EXTENSION => 'UPLOAD_ERR_EXTENSION (Dibatalkan ekstensi PHP)',
                    ];
                    $rawErrors[] = "{$img} ({$name}, {$size} bytes): " . ($errorNames[$err] ?? "Error code {$err}");
                }
            }
        }

        if (!empty($rawErrors)) {
            return redirect()->back()->with('error', 'Penyebab Gagal Upload: ' . implode(' | ', $rawErrors));
        }

        DB::beginTransaction();
        try {
            $request->validate([
                'title' => 'nullable|string',
                'sub_title' => 'nullable|string',
                'link' => 'nullable|string',
                'image_1' => 'nullable|file|mimes:jpg,jpeg,png,gif,bmp,webp,svg,svgz|max:20480',
                'image_2' => 'nullable|file|mimes:jpg,jpeg,png,gif,bmp,webp,svg,svgz|max:20480',
                'image_3' => 'nullable|file|mimes:jpg,jpeg,png,gif,bmp,webp,svg,svgz|max:20480',
            ]);

            $folder = 'uploads/home_banner';
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            $data = [
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'link' => $request->link,
            ];

            foreach (['image_1', 'image_2', 'image_3'] as $imageField) {
                if ($request->hasFile($imageField)) {
                    $data[$imageField] = $request->file($imageField)->store($folder, 'public');
                }
            }

            $this->homeBannerRepository->store($data);

            DB::commit();
            return redirect()->route('admin.home_banner.getData')->with('success', 'Home banner created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'title' => 'nullable|string',
                'sub_title' => 'nullable|string',
                'link' => 'nullable|string',
                'image_1' => 'nullable|mimes:jpg,jpeg,png,gif,bmp,webp,svg,svgz|max:2048',
                'image_2' => 'nullable|mimes:jpg,jpeg,png,gif,bmp,webp,svg,svgz|max:2048',
                'image_3' => 'nullable|mimes:jpg,jpeg,png,gif,bmp,webp,svg,svgz|max:2048',
            ]);

            $oldData = $this->homeBannerRepository->find($id);

            $data = [
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'link' => $request->link,
            ];

            $folder = 'uploads/home_banner';
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            foreach (['image_1', 'image_2', 'image_3'] as $imageField) {
                if ($request->hasFile($imageField)) {
                    if (!empty($oldData->$imageField) && Storage::disk('public')->exists($oldData->$imageField)) {
                        Storage::disk('public')->delete($oldData->$imageField);
                    }

                    $data[$imageField] = $request->file($imageField)->store($folder, 'public');
                }
            }

            $this->homeBannerRepository->update($id, $data);

            DB::commit();
            return redirect()->route('admin.home_banner.getData')->with('success', 'Home banner updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $data = $this->homeBannerRepository->find($id);
            foreach (['image_1', 'image_2', 'image_3'] as $imageField) {
                if (!empty($data->$imageField) && Storage::disk('public')->exists($data->$imageField)) {
                    Storage::disk('public')->delete($data->$imageField);
                }
            }

            $this->homeBannerRepository->delete($id);
            DB::commit();
            return redirect()->route('admin.home_banner.getData')->with('success', 'Home banner deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}
