<?php

namespace App\Http\Controllers;

use App\Models\outlet;
use Illuminate\Http\Request;

class outletcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $outlet = outlet::paginate(5);
        return view('page.outlet.index')->with([
            'outlet' => $outlet
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
        ];

        outlet::create($data);

        return back()->with('message_delete', 'Data outlet Sudah dihapus');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
        ];

        $datas = outlet::findOrFail($id);
        $datas->update($data);
        return back()->with('message_delete', 'Data outlet Sudah dihapus');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = outlet::findOrFail($id);
        $data->delete();
        return back()->with('message_delete','Data outlet Sudah dihapus');
    }
}
