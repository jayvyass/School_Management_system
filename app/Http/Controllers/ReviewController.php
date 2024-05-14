<?php

namespace App\Http\Controllers;
use App\Models\Review; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function store(Request $request) {
        $review = new Review();
        $review->name = $request->input('name');
        $review->profession = $request->input('profession');
        $review->description = $request->input('description');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/images'), $imageName);
            $review->image = 'images/' . $imageName;
        }
       
        $review ->save();
        return redirect('admin/reviews');
    }

    public function submitreview(Request $request) {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'profession' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $review = new Review();
        $review->name = $request->input('name');
        $review->profession = $request->input('profession');
        $review->description = $request->input('description');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/images'), $imageName);
            $review->image = 'images/' . $imageName;
        }
        $review ->save();
        $request->session()->flash('status', 'success');
        $request->session()->flash('message', 'Your Review has been submitted successfully!');
        return redirect('write-review');    
    }
        
    public function form() {    
        $submit = "SUBMIT";
        $mode = "ADD REVIEW";
        $viewMode = false;
        return view('admin/reviewsform', compact('mode', 'submit','viewMode'));
    }
    
        
    public function delete($id) {
        $reviews = Review::find($id);
        
            if (!is_null($reviews)) {
                echo '<script>';
                echo 'if (confirm("Are you sure you want to delete this Review?")) {';
                echo '  window.location.href = "' . route('reviews.confirm-delete', ['id' => $id]) . '";';
                echo '} else {';
                echo '  window.location.href = "' . route('reviews') . '";'; 
                echo '}';
                echo '</script>';
                exit; 
            }
        
        }

        public function confirmDelete($id) {
            $reviews = Review::find($id);
            if (!is_null($reviews)) {
                $reviews->delete();
            }
            return redirect('admin/reviews');
        }
            
    
    public function edit($id) {
            $reviews =Review::find($id);
            if (is_null($reviews)) {
                return redirect()->back();
            } else {

                $id = "";
                $submit="UPDATE";
                $viewMode = false;
                $mode = "EDIT REVIEW";
                $data = compact("reviews","id","viewMode", "mode","submit");
                return view('admin/reviewsform')->with($data);
            }
    }
        
    public function update($id, Request $request) {
        $review = Review::find($id);
        $review->name = $request->input('name');
        $review->profession = $request->input('profession');
        $review->description = $request->input('description');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/images'), $imageName);
            $review->image = 'images/' . $imageName;
        }
       
        $review ->save();
        return redirect('admin/reviews');
    }


    public function viewreview($id) {
            $reviews = Review::find($id);
            
            if (is_null($reviews)) {
                return redirect()->back();
            } else {
                $submit="OK";                
                $mode = "REVIEW DETAILS";
                $viewMode = true;
                $data = compact("reviews","viewMode", "mode","submit");
                return view('admin/reviewsform')->with($data);
            }
    }
        
    public function search(Request $request) {
        $query = $request->input('query');
    
        // Perform search in your database based on the $query
        $reviewdata = Review::where(function ($queryBuilder) use ($query) {
                                $queryBuilder->where('name', 'like', "%{$query}%")
                                             ->orWhere('profession', 'like', "%{$query}%")
                                             ->orWhere('description', 'like', "%{$query}%");
                            })
                            ->get();
    
        return response()->json(['reviewdata' => $reviewdata]);
    }
    
}
