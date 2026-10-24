<?php

namespace App\Http\Controllers\Administrator\Infaq;

use App\Http\Controllers\Controller;
use App\Repositories\Administrator\Infaq\InfaqBankTransferRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InfaqBankTransferController extends Controller
{
    protected $infaqBankTransferRepository;

    public function __construct(InfaqBankTransferRepository $infaqBankTransferRepository)
    {
        $this->infaqBankTransferRepository = $infaqBankTransferRepository;
    }

    public function getData()
    {
        $data = $this->infaqBankTransferRepository->getData();
        return view('administrator.cms.infaq.infaq_bank', compact('data'));
    }

    public function store(Request $request)
    {
        if (isset($_FILES['logo_bank']) && !empty($_FILES['logo_bank']['name'])) {
            $err = $_FILES['logo_bank']['error'];
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
                'bank_name' => 'required|string|max:255',
                'account_name' => 'required|string|max:255',
                'account_number' => 'required|string|max:255',
                'logo_bank' => 'required|file|mimes:jpg,jpeg,png,webp,svg|max:20480',
            ]);

            $folder = 'uploads/infaq_bank';
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            $data = [
                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
            ];

            if ($request->hasFile('logo_bank')) {
                $data['logo_bank'] = $request->file('logo_bank')->store($folder, 'public');
            }

            $this->infaqBankTransferRepository->store($data);

            DB::commit();
            return redirect()->route('admin.infaq_bank.getData')->with('success', 'Rekening transfer infaq berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        if (isset($_FILES['logo_bank']) && !empty($_FILES['logo_bank']['name'])) {
            $err = $_FILES['logo_bank']['error'];
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
                'bank_name' => 'required|string|max:255',
                'account_name' => 'required|string|max:255',
                'account_number' => 'required|string|max:255',
                'logo_bank' => 'nullable|file|mimes:jpg,jpeg,png,webp,svg|max:20480',
            ]);

            $oldData = $this->infaqBankTransferRepository->find($id);

            $data = [
                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
            ];

            $folder = 'uploads/infaq_bank';
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            if ($request->hasFile('logo_bank')) {
                if (!empty($oldData->logo_bank) && Storage::disk('public')->exists($oldData->logo_bank)) {
                    Storage::disk('public')->delete($oldData->logo_bank);
                }
                $data['logo_bank'] = $request->file('logo_bank')->store($folder, 'public');
            }

            $this->infaqBankTransferRepository->update($id, $data);

            DB::commit();
            return redirect()->route('admin.infaq_bank.getData')->with('success', 'Rekening transfer infaq berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $data = $this->infaqBankTransferRepository->find($id);
            if (!empty($data->logo_bank) && Storage::disk('public')->exists($data->logo_bank)) {
                Storage::disk('public')->delete($data->logo_bank);
            }

            $this->infaqBankTransferRepository->delete($id);
            DB::commit();
            return redirect()->route('admin.infaq_bank.getData')->with('success', 'Rekening transfer infaq berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

