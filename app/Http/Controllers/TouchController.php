<?php

namespace App\Http\Controllers;
use App\Models\Touch; 
use Illuminate\Http\Request;

class TouchController extends Controller
{
    public function store(Request $request) {
        $touch = new Touch();
        $touch->address = $request->input('address');
        $touch->email = $request->input('email');
        $touch->contact = $request->input('contact');
        $touch->status = $request['status_hidden']; 
        $touch ->save();
        return redirect('admin/getintouch');
    }
 
    public function form() {    
        $submit = "SUBMIT";
        $viewMode = false;
        $mode = "ADD DETAILS";
        return view('admin/getintouchform', compact('mode','viewMode', 'submit'));
    }
    
        
    public function delete($id) {
        $touchs = Touch::find($id);
        if (!is_null($touchs)) {
            $touchs->delete();
        }
        return redirect()->back();
    }
            
    
    public function edit($id) {
            $touch = Touch::find($id);
            if (is_null($touch)) {
                return redirect()->back();
            } else {

                $id = "";
                $submit="UPDATE";
                $viewMode = false;
                $mode = "EDIT DETAILS";
                $data = compact("touch","id","viewMode", "mode","submit");
                return view('admin/getintouchform')->with($data);
            }
    }
        
    public function update($id, Request $request) {
        $touch = Touch::find($id);
        $touch->address = $request->input('address');
        $touch->email = $request->input('email');
        $touch->contact = $request->input('contact');
        
        $touch ->save();
        return redirect('admin/getintouch');
    }


    public function viewtouch($id) {
            $touch = Touch::find($id);
            
            if (is_null($touch)) {
                return redirect()->back();
            } else {
                $submit="OK";                
                $mode = "DETAILS";
                $viewMode = true;
                $data = compact("touch","viewMode", "mode","submit");
                return view('admin/getintouchform')->with($data);
            }
    }
        
    public function search(Request $request) {
        $query = $request->input('query');
    
        // Perform search in your database based on the $query
        $getintouchdata = Touch::where(function ($queryBuilder) use ($query) {
                                $queryBuilder->where('address', 'like', "%{$query}%")
                                             ->orWhere('email', 'like', "%{$query}%")
                                             ->orWhere('contact', 'like', "%{$query}%");
                            })
                            ->get();
    
        return response()->json(['getintouchdata' => $getintouchdata]);
    }
    
}
