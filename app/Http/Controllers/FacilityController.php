<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function store(Request $request) {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'facility' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status_hidden' => 'required|in:Active,Away',
        ]);

        // Create a new Facility instance
        $facility = new Facility();

        // Assign validated data to facility attributes
        $facility->facility = $validatedData['facility'];
        $facility->icon = $validatedData['icon'];
        $facility->description = $validatedData['description'];
        $facility->status = $validatedData['status_hidden'];

        // Save the facility data to the database
        $facility->save();

        // Redirect back to the facilities page after successful creation
        return redirect('admin/facilities');
    }

    public function view() {
        $facilities = Facility::where('status', 'Active')->get();
        return view('admin.facilities', ['facilities' => $facilities]);
    }

    public function form() {
        $submit = "SUBMIT";
        $viewMode = false;
        $mode = "ADD FACILITY";
        return view('admin.facilitiesform', compact('mode', 'viewMode', 'submit'));
    }

    public function delete($id) {
        $facilities = Facility::find($id);
        if (!is_null($facilities)) {
            echo '<script>';
            echo 'if (confirm("Are you sure you want to delete this Facility?")) {';
            echo '  window.location.href = "' . route('facilities.confirm-delete', ['id' => $id]) . '";';
            echo '} else {';
            echo '  window.location.href = "' . route('facilities') . '";'; // Redirect back to student list
            echo '}';
            echo '</script>';
            exit;
        }
    }

    public function confirmDelete($id) {
        $facilities = Facility::find($id);
        if (!is_null($facilities)) {
            $facilities->delete();
        }
        return redirect('admin/facilities');
    }

    public function edit($id) {
        $facilities = Facility::find($id);
        if (is_null($facilities)) {
            return redirect()->back();
        } else {
            $id = "";
            $submit = "UPDATE";
            $viewMode = false;
            $mode = "EDIT FACILITY";
            $data = compact("facilities", "id", "viewMode", "mode", "submit");
            return view('admin.facilitiesform')->with($data);
        }
    }

    public function update($id, Request $request) {
        $facility = Facility::find($id);
        $facility->facility = $request->input('facility');
        $facility->icon = $request->input('icon');
        $facility->description = $request->input('description');
        $facility->status = $request->input('status_hidden');
        $facility->save();
        return redirect('admin/facilities');
    }

    public function viewfacility($id) {
        $facilities = Facility::find($id);
        if (is_null($facilities)) {
            return redirect()->back();
        } else {
            $submit = "OK";
            $viewMode = true;
            $mode = "FACILITY DETAILS";
            $data = compact("facilities", "viewMode", "mode", "submit");
            return view('admin.facilitiesform')->with($data);
        }
    }

    public function search(Request $request) {
        $query = $request->input('query');

        // Perform search in your database based on the $query
        $facilitydata = Facility::where('status', 'Active')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('icon', 'like', "%{$query}%")
                    ->orWhere('facility', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            })
            ->get();

        return response()->json(['facilitydata' => $facilitydata]);
    }
}
