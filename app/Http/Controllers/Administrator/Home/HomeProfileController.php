<?php

namespace App\Http\Controllers\Administrator\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Administrator\Home\HomeProfileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeProfileController extends Controller
{
    protected $homeProfileRepository;

    public function __construct(HomeProfileRepository $homeProfileRepository)
    {
        $this->homeProfileRepository = $homeProfileRepository;
    }

    public function getData()
    {
        $data = $this->homeProfileRepository->getData();
        return view('administrator.cms.home.home_profile', compact('data'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'title' => 'nullable|string',
                'description' => 'nullable|string',
                'link' => 'nullable|string',
                'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,bmp,webp,svg,svgz|max:20480',
            ]);

            $folder = 'uploads/home_profile';
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'link' => $request->link,
            ];

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store($folder, 'public');
            }

            $this->homeProfileRepository->store($data);

            DB::commit();
            return redirect()->route('admin.home_profile.getData')->with('success', 'Home profile created successfully.');
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
                'description' => 'nullable|string',
                'link' => 'nullable|string',
                'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,bmp,webp,svg,svgz|max:20480',
            ]);

            $oldData = $this->homeProfileRepository->find($id);

            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'link' => $request->link,
            ];

            $folder = 'uploads/home_profile';
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            if ($request->hasFile('image')) {
                if (!empty($oldData->image) && Storage::disk('public')->exists($oldData->image)) {
                    Storage::disk('public')->delete($oldData->image);
                }

                $data['image'] = $request->file('image')->store($folder, 'public');
            }

            $this->homeProfileRepository->update($id, $data);

            DB::commit();
            return redirect()->route('admin.home_profile.getData')->with('success', 'Home profile updated successfully.');
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
            $data = $this->homeProfileRepository->find($id);
            if (!empty($data->image) && Storage::disk('public')->exists($data->image)) {
                Storage::disk('public')->delete($data->image);
            }

            $this->homeProfileRepository->delete($id);
            DB::commit();
            return redirect()->route('admin.home_profile.getData')->with('success', 'Home profile deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
