<?php

namespace App\Http\Controllers\Administrator\Infaq;

use App\Http\Controllers\Controller;
use App\Repositories\Administrator\Infaq\InfaqQrisRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InfaqQrisController extends Controller
{
    protected $infaqQrisRepository;

    public function __construct(InfaqQrisRepository $infaqQrisRepository)
    {
        $this->infaqQrisRepository = $infaqQrisRepository;
    }

    public function getData()
    {
        $data = $this->infaqQrisRepository->getData();
        return view('administrator.cms.infaq.infaq_qris', compact('data'));
    }

    public function update(Request $request)
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
            $currentData = $this->infaqQrisRepository->getData();

            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
                'note' => 'nullable|string',
                'image' => ($currentData ? 'nullable' : 'required') . '|file|mimes:jpg,jpeg,png,webp|max:20480',
            ]);

            $folder = 'uploads/infaq_qris';
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            $payload = [
                'title' => $request->title,
                'description' => $request->description,
                'note' => $request->note,
            ];

            if ($request->hasFile('image')) {
                if ($currentData && !empty($currentData->image) && Storage::disk('public')->exists($currentData->image)) {
                    Storage::disk('public')->delete($currentData->image);
                }
                $payload['image'] = $request->file('image')->store($folder, 'public');
            }

            $this->infaqQrisRepository->updateOrCreate($payload);

            DB::commit();
            return redirect()->route('admin.infaq_qris.getData')->with('success', 'Pengaturan QRIS infaq berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

