<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{

    // show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6),
        ]);
    }

    // show individual listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // create listing  form
    public function create(){
        return view('listings.create');
    }

    // store listing data
    public function store(Request $request) {
        // validtion
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        // file upload functionality
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // add ownership to listing
        $formFields['user_id'] = auth()->id();

        // creating...
        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing is created successfully!');
    }

    // show update form
    public function edit(Listing $listing) {
        return view('listing.edit', ['listing' => $listing]);
    }

    // submit update data
    public function update(Request $request, Listing $listing) {

        // make sure that logged in user is the owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized action');
        }

        // validation
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        // file upload functionality
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // updating...
        $listing->update($formFields);

        return back()->with('message', 'Listing is updated successfully!');
    }

    // delete listing
    public function destroy(Listing $listing) {
        // make sure that logged in user is the owner
        if($listing->user_id != auth()->id()){
            abort('403', 'Unauthorized action');
        }
        // deleting...
        $listing->delete();
        return redirect('/')->with('message', 'listing is deleted successfully!');
    }

    // manage listings
    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
