<?php
namespace App\Http\Controllers;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
  
    public function delete($id) {
        $user = User::find($id);
        
        if (!is_null($user)) {
            // You can replace this with your own delete confirmation logic
            echo '<script>';
            echo 'if (confirm("Are you sure you want to delete this user?")) {';
            echo '  window.location.href = "' . route('users.confirm-delete', ['id' => $id]) . '";';
            echo '} else {';
            echo '  window.location.href = "' . route('users') . '";'; 
            echo '}';
            echo '</script>';
            exit; 
        }
    }

    public function confirmDelete($id) {
        $user = User::find($id);
        if (!is_null($user)) {
            $user->delete();
        }
        return redirect('admin/users');
    }

    public function edit($id) {
        $user = User::find($id);
        if (is_null($user)) {
            return redirect()->back();
        } else {
            $submit = "UPDATE";
            $viewMode = false;
            $mode = "EDIT USER";
            $data = compact("user", "viewMode", "mode", "submit");
            return view('admin/userform')->with($data);
        }
    }

    public function update($id, Request $request) {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->roles = $request->input('roles'); 
        $user->save();
        return redirect('admin/users');
    }

    public function viewuser($id) {
        $user = User::find($id);
        if (is_null($user)) {
            return redirect()->back();
        } else {
            $submit = "OK";                
            $mode = "USER DETAILS";
            $viewMode = true;
            $data = compact("user", "viewMode", "mode", "submit");
            return view('admin/userform')->with($data);
        }
    }

    public function search(Request $request) {
        $query = $request->input('query');
    
        $userdata = User::where(function ($queryBuilder) use ($query) {
                            $queryBuilder->where('name', 'like', "%{$query}%")
                                        ->orWhere('email', 'like', "%{$query}%")
                                        ->orWhere('roles', 'like', "%{$query}%");
                        })
                        ->get();
    
        return response()->json(['userdata' => $userdata]);
    }
    
}
