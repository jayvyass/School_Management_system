<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function store(Request $request) {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'imagetext' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'status_hidden' => 'required|in:Active,Away',
        ]);

        // Create a new Banner instance
        $banner = new Banner();

        // Assign validated data to banner attributes
        $banner->text = $validatedData['imagetext'];
        $banner->description = $validatedData['description'];

        // Process and save the uploaded image
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('admin/images'), $imageName);
        $banner->image = 'images/' . $imageName;

        $banner->status = $validatedData['status_hidden'];

        // Save the banner data to the database
        $banner->save();

        // Redirect back to the banners page after successful creation
        return redirect('admin/banners');
    }

    public function form() {
        $submit = "SUBMIT";
        $viewMode = false;
        $mode = "ADD BANNER";
        return view('admin/bannersform', compact('mode', 'viewMode', 'submit'));
    }

    public function delete($id) {
        $banners = Banner::find($id);
        if (!is_null($banners)) {
            echo '<script>';
            echo 'if (confirm("Are you sure you want to delete this Banner?")) {';
            echo '  window.location.href = "' . route('banners.confirm-delete', ['id' => $id]) . '";';
            echo '} else {';
            echo '  window.location.href = "' . route('banners') . '";'; // Redirect back to student list
            echo '}';
            echo '</script>';
            exit;
        }
    }

    public function confirmDelete($id) {
        $banners = Banner::find($id);
        if (!is_null($banners)) {
            $banners->delete();
        }
        return redirect('admin/banners');
    }

    public function edit($id) {
        $banners = Banner::find($id);
        if (is_null($banners)) {
            return redirect()->back();
        } else {

            $id = "";
            $submit = "UPDATE";
            $viewMode = false;
            $mode = "EDIT BANNERS";
            $data = compact("banners", "id", "mode", "viewMode", "submit");
            return view('admin/bannersform')->with($data);
        }
    }

    public function update($id, Request $request){
        $banner = Banner::find($id);
        $banner->text = $request->input('imagetext');
        $banner->description = $request->input('description');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/images'), $imageName);
            $banner->image = 'images/' . $imageName;
        }
        $banner->status = $request->input('status_hidden');
        $banner->save();
        return redirect('admin/banners');
    }

    public function viewbanner($id) {
        $banners = Banner::find($id);

        if (is_null($banners)) {
            return redirect()->back();
        } else {
            $submit = "OK";
            $viewMode = true;
            $mode = "BANNERS DETAILS";
            $data = compact("banners", "mode", "viewMode", "submit");
            return view('admin/bannersform')->with($data);
        }
    }

    public function search(Request $request) {
        $query = $request->input('query');

        // Perform search in your database based on the $query
        $bannerdata = Banner::where('status', 'Active')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('image', 'like', "%{$query}%")
                    ->orWhere('text', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            })
            ->get();

        return response()->json(['bannerdata' => $bannerdata]);
    }
}
