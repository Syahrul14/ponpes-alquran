<?php

namespace App\Http\Controllers\Administrator\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Administrator\Home\HomeAlumniRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeAlumniController extends Controller
{
    protected $homeAlumniRepository;

    public function __construct(HomeAlumniRepository $homeAlumniRepository)
    {
        $this->homeAlumniRepository = $homeAlumniRepository;
    }

    public function getData()
    {
        $data = $this->homeAlumniRepository->getData();
        return view('administrator.cms.home.home_alumni', compact('data'));
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
                'name' => 'required|string|max:255',
                'current_position' => 'nullable|string|max:255',
                'message' => 'nullable|string',
                'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,bmp,webp,svg,svgz|max:20480',
            ]);

            $folder = 'uploads/home_alumni';
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            $data = [
                'name' => $request->name,
                'current_position' => $request->current_position,
                'message' => $request->message,
            ];

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store($folder, 'public');
            }

            $this->homeAlumniRepository->store($data);

            DB::commit();
            return redirect()->route('admin.home_alumni.getData')->with('success', 'Home alumni created successfully.');
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
                'name' => 'required|string|max:255',
                'current_position' => 'nullable|string|max:255',
                'message' => 'nullable|string',
                'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,bmp,webp,svg,svgz|max:20480',
            ]);

            $oldData = $this->homeAlumniRepository->find($id);

            $data = [
                'name' => $request->name,
                'current_position' => $request->current_position,
                'message' => $request->message,
            ];

            $folder = 'uploads/home_alumni';
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            if ($request->hasFile('image')) {
                if (!empty($oldData->image) && Storage::disk('public')->exists($oldData->image)) {
                    Storage::disk('public')->delete($oldData->image);
                }
                $data['image'] = $request->file('image')->store($folder, 'public');
            }

            $this->homeAlumniRepository->update($id, $data);

            DB::commit();
            return redirect()->route('admin.home_alumni.getData')->with('success', 'Home alumni updated successfully.');
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
            $data = $this->homeAlumniRepository->find($id);
            if (!empty($data->image) && Storage::disk('public')->exists($data->image)) {
                Storage::disk('public')->delete($data->image);
            }

            $this->homeAlumniRepository->delete($id);
            DB::commit();
            return redirect()->route('admin.home_alumni.getData')->with('success', 'Home alumni deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

