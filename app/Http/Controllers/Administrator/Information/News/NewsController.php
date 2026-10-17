<?php

namespace App\Http\Controllers\Administrator\Information\News;

use App\Http\Controllers\Controller;
use App\Models\Administrator\Information\News\NewsModel;
use App\Repositories\Administrator\Information\News\NewsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    protected $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getData()
    {
        $data = $this->newsRepository->getData();
        return view('administrator.cms.information.news.news', compact('data'));
    }

    protected function generateUniqueSlug($title, $ignoreId = null)
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (NewsModel::where('slug', $slug)->when($ignoreId, function ($query, $ignoreId) {
            return $query->where('id', '!=', $ignoreId);
        })->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
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
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image' => 'required|file|mimes:jpg,jpeg,png,gif,bmp,webp,svg,svgz|max:20480',
            ]);

            $folder = 'uploads/news';
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            $slug = $this->generateUniqueSlug($request->title);

            $data = [
                'title' => $request->title,
                'slug' => $slug,
                'content' => $request->content,
            ];

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store($folder, 'public');
            }

            $this->newsRepository->store($data);

            DB::commit();
            return redirect()->route('admin.news.getData')->with('success', 'Berita berhasil ditambahkan.');
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
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,bmp,webp,svg,svgz|max:20480',
            ]);

            $oldData = $this->newsRepository->find($id);

            $slug = $this->generateUniqueSlug($request->title, $id);

            $data = [
                'title' => $request->title,
                'slug' => $slug,
                'content' => $request->content,
            ];

            $folder = 'uploads/news';
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            if ($request->hasFile('image')) {
                if (!empty($oldData->image) && Storage::disk('public')->exists($oldData->image)) {
                    Storage::disk('public')->delete($oldData->image);
                }
                $data['image'] = $request->file('image')->store($folder, 'public');
            }

            $this->newsRepository->update($id, $data);

            DB::commit();
            return redirect()->route('admin.news.getData')->with('success', 'Berita berhasil diperbarui.');
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
            $data = $this->newsRepository->find($id);
            if (!empty($data->image) && Storage::disk('public')->exists($data->image)) {
                Storage::disk('public')->delete($data->image);
            }

            $this->newsRepository->delete($id);
            DB::commit();
            return redirect()->route('admin.news.getData')->with('success', 'Berita berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

