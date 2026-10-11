<?php

namespace App\Http\Controllers\Administrator\About\Visi_Misi;

use App\Http\Controllers\Controller;
use App\Repositories\Administrator\About\Visi_Misi\MisiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MisiController extends Controller
{
    protected $misiRepository;

    public function __construct(MisiRepository $misiRepository)
    {
        $this->misiRepository = $misiRepository;
    }

    public function getData()
    {
        $data = $this->misiRepository->getData();
        return view('administrator.cms.about.visi_misi.misi', compact('data'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
            ]);

            $data = [
                'title' => $request->title,
                'description' => $request->description,
            ];

            $this->misiRepository->store($data);

            DB::commit();
            return redirect()->route('admin.misi.getData')->with('success', 'Misi created successfully.');
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
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
            ]);

            $data = [
                'title' => $request->title,
                'description' => $request->description,
            ];

            $this->misiRepository->update($id, $data);

            DB::commit();
            return redirect()->route('admin.misi.getData')->with('success', 'Misi updated successfully.');
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
            $this->misiRepository->delete($id);
            DB::commit();
            return redirect()->route('admin.misi.getData')->with('success', 'Misi deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

