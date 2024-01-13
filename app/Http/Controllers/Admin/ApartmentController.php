<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Auth::id());
        $apartments = Apartment::where('user_id',Auth::id())->get();

        return view ('admin.apartments.index', compact('apartments'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.apartments.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        if($apartment->user_id != Auth::id()) {
            $apartments = Apartment::where('user_id',Auth::id())->get();
            return redirect() -> route('admin.apartment.index', compact('apartments'));
        }
        return view ('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view ('admin.apartments.create_edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
