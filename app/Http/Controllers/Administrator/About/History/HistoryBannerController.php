<?php

namespace App\Http\Controllers\Administrator\About\History;

use App\Http\Controllers\Controller;
use App\Repositories\Administrator\About\History\HistoryBannerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HistoryBannerController extends Controller
{
    protected $historyBannerRepository;

    public function __construct(HistoryBannerRepository $historyBannerRepository)
    {
        $this->historyBannerRepository = $historyBannerRepository;
    }

    public function getData()
    {
        $data = $this->historyBannerRepository->getData();
        return view('administrator.cms.about.history.history_banner', compact('data'));
    }

    public function store(Request $request)
    {
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $err = $_FILES['image']['error'];
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
                return redirect()->back()->with('error', 'Penyebab Gagal Upload: ' . ($errorNames[$err] ?? "Error code {$err}"));
            }
        }

        DB::beginTransaction();
        try {
            $request->validate([
                'title' => 'nullable|string|max:255',
                'sub_title' => 'nullable|string',
                'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,bmp,webp,svg,svgz|max:20480',
            ]);

            $folder = 'uploads/history_banner';
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            $data = [
                'title' => $request->title,
                'sub_title' => $request->sub_title,
            ];

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store($folder, 'public');
            }

            $this->historyBannerRepository->store($data);

            DB::commit();
            return redirect()->route('admin.history_banner.getData')->with('success', 'History banner created successfully.');
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
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $err = $_FILES['image']['error'];
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
                return redirect()->back()->with('error', 'Penyebab Gagal Upload: ' . ($errorNames[$err] ?? "Error code {$err}"));
            }
        }

        DB::beginTransaction();
        try {
            $request->validate([
                'title' => 'nullable|string|max:255',
                'sub_title' => 'nullable|string',
                'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,bmp,webp,svg,svgz|max:20480',
            ]);

            $oldData = $this->historyBannerRepository->find($id);

            $data = [
                'title' => $request->title,
                'sub_title' => $request->sub_title,
            ];

            $folder = 'uploads/history_banner';
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            if ($request->hasFile('image')) {
                if (!empty($oldData->image) && Storage::disk('public')->exists($oldData->image)) {
                    Storage::disk('public')->delete($oldData->image);
                }
                $data['image'] = $request->file('image')->store($folder, 'public');
            }

            $this->historyBannerRepository->update($id, $data);

            DB::commit();
            return redirect()->route('admin.history_banner.getData')->with('success', 'History banner updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $data = $this->historyBannerRepository->find($id);
            if (!empty($data->image) && Storage::disk('public')->exists($data->image)) {
                Storage::disk('public')->delete($data->image);
            }

            $this->historyBannerRepository->delete($id);
            DB::commit();
            return redirect()->route('admin.history_banner.getData')->with('success', 'History banner deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
