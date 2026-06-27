<?php

namespace App\Livewire\Procurement;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Vendor - Equogreen')]
class VendorController extends Component
{

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
        $data = $request->all();
        if ($request->hasFile('portofolio')) {
            $file = $request->file('portofolio');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('portofolio', $filename, 'public');
            $data['portofolio'] = $filename;
        }
        Vendor::create($data);
        return redirect()->route('registrasi')->with('success', 'Vendor berhasil didaftarkan,\!');
    }
    public function render()
    {
        $vendors = Vendor::where('status', 'pending')->get();

        return view('livewire.procurement.validasi-vendor', compact('vendors'))
            ->layoutData([
                'headerTitle' => 'Validasi Pendaftaran Vendor',
                'headerDescription' => 'Periksa dan setujui akses vendor baru'
            ]);
    }
}
