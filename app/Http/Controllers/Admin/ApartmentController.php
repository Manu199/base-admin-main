<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApartmentRequest;
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
        $apartments = Apartment::where('user_id',Auth::id())->get();
        return view ('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Apartment - Create';
        $method = 'POST';
        $route = route('admin.apartment.store');
        $apartment = null;
        return view ('admin.apartments.create_edit',compact('title','route','method','apartment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApartmentRequest $request)
    {
        $form_data = $request->all();
        $apartment = null;
        dd($form_data);
        return redirect()->route('admin.project.show', $apartment )->with('success','Creazione avvenuta con successo!');
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
    public function edit(Apartment $apartment)
    {

        $title = 'Apartment - Edit';
        $method = 'PUT';
        $route = route('admin.apartment.update', $apartment);

        return view ('admin.apartments.create_edit',compact('title','route','method','apartment'));
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
