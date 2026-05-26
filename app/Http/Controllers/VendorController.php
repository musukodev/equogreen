<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $vendors = Vendor::where('status', 'pending')->get();

    return view('equogreen-frontend.validasi-vendor', compact('vendors'));
}
   
    public function create()
    {
 return view('equogreen-frontend.registrasi');
    }

    
    public function store(Request $request)
    {
         $request->validate([

            'nama_perusahaan' => 'required|string|max:255',
            'email_perusahaan' => 'required|email|max:255|unique:vendor',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
            'kategori_vendor' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'portofolio' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        
        ]);
        $data= $request->all();
        if ($request->hasFile('portofolio')) {
            $file = $request->file('portofolio');
            $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('portofolio', $filename, 'public');
            $data['portofolio'] = $filename;
        }
        Vendor::create($data);
return redirect()->route('registrasi')->with('success', 'Vendor berhasil didaftarkan,\!');
        
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
