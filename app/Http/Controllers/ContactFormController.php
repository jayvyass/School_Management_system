<?php

namespace App\Http\Controllers;

use App\Models\Contact_us;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function submitForm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        
        Contact_us::create($validatedData);
        $request->session()->flash('status', 'success');
        $request->session()->flash('message', 'Your query has been submitted successfully!');
        return redirect('contact');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $contactdata = Contact_us::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->orWhere('subject', 'like', "%{$query}%")
                ->orWhere('message', 'like', "%{$query}%");
        })
            ->get();

        return response()->json(['contactdata' => $contactdata]);
    }
}
