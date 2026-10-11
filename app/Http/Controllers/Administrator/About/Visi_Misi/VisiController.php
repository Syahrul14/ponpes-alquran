<?php

namespace App\Http\Controllers\Administrator\About\Visi_Misi;

use App\Http\Controllers\Controller;
use App\Repositories\Administrator\About\Visi_Misi\VisiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisiController extends Controller
{
    protected $visiRepository;

    public function __construct(VisiRepository $visiRepository)
    {
        $this->visiRepository = $visiRepository;
    }

    public function getData()
    {
        $data = $this->visiRepository->getData();
        return view('administrator.cms.about.visi_misi.visi', compact('data'));
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

            $this->visiRepository->store($data);

            DB::commit();
            return redirect()->route('admin.visi.getData')->with('success', 'Visi created successfully.');
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

            $this->visiRepository->update($id, $data);

            DB::commit();
            return redirect()->route('admin.visi.getData')->with('success', 'Visi updated successfully.');
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
            $this->visiRepository->delete($id);
            DB::commit();
            return redirect()->route('admin.visi.getData')->with('success', 'Visi deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

