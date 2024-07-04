<?php

namespace App\Http\Controllers;
use App\Models\BusinessDirectory;
use Illuminate\Http\Request;

class BusinessDirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entries = BusinessDirectory::all();
        return view('business_directory.index', compact('entries'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     return view('business_directory.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'type' => 'required',
    //         'company' => 'required',
    //         'nickname' => 'required',
    //         'billing_currency' => 'required',
    //         'rfc_tax_id' => 'required',
    //         'street_address' => 'required',
    //         'building_number' => 'required',
    //         'neighborhood' => 'required',
    //         'city' => 'required',
    //         'state' => 'required',
    //         'postal_code' => 'required',
    //         'country' => 'required',
    //         'phone' => 'required',
    //         'email' => 'required|email',
    //     ]);

    //     BusinessDirectory::create($request->all());

    //     return redirect()->route('business-directory.index')
    //                      ->with('success', 'Entry created successfully.');
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(BusinessDirectory $businessDirectory)
    // {
    //     return view('business_directory.show', compact('businessDirectory'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(BusinessDirectory $businessDirectory)
    // {
    //     return view('business_directory.edit', compact('businessDirectory'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, BusinessDirectory $businessDirectory)
    // {
    //     $request->validate([
    //         'type' => 'required',
    //         'company' => 'required',
    //         'nickname' => 'required',
    //         'billing_currency' => 'required',
    //         'rfc_tax_id' => 'required',
    //         'street_address' => 'required',
    //         'building_number' => 'required',
    //         'neighborhood' => 'required',
    //         'city' => 'required',
    //         'state' => 'required',
    //         'postal_code' => 'required',
    //         'country' => 'required',
    //         'phone' => 'required',
    //         'email' => 'required|email',
    //     ]);

    //     $businessDirectory->update($request->all());

    //     return redirect()->route('business-directory.index')
    //                      ->with('success', 'Entry updated successfully.');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(BusinessDirectory $businessDirectory)
    // {
    //     $businessDirectory->delete();

    //     return redirect()->route('business-directory.index')
    //                      ->with('success', 'Entry deleted successfully.');
    // }
}
