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
            'kategori_vendor' => 'required|string|in:atk,elektronik,furniture,cleaning,supplier umum',
            'penanggung_jawab' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'portofolio' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ], [
            'nama_perusahaan.required' => 'Nama perusahaan wajib diisi.',
            'email_perusahaan.required' => 'Email perusahaan wajib diisi.',
            'email_perusahaan.email' => 'Format email perusahaan tidak valid.',
            'email_perusahaan.unique' => 'Email perusahaan ini sudah terdaftar di sistem.',
            'no_hp.required' => 'Nomor handphone perusahaan wajib diisi.',
            'alamat.required' => 'Alamat perusahaan wajib diisi.',
            'kategori_vendor.required' => 'Kategori vendor wajib diisi.',
            'kategori_vendor.in' => 'Kategori vendor yang dipilih tidak valid.',
            'penanggung_jawab.required' => 'Nama penanggung jawab wajib diisi.',
            'deskripsi.required' => 'Deskripsi perusahaan wajib diisi.',
            'provinsi.required' => 'Provinsi wajib diisi.',
            'kota.required' => 'Kota/Kabupaten wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'kode_pos.required' => 'Kode pos wajib diisi.',
            'portofolio.mimes' => 'Berkas portofolio harus berupa file berformat PDF, DOC, atau DOCX.',
            'portofolio.max' => 'Ukuran berkas portofolio tidak boleh lebih dari 2 MB (2048 KB).',
        ]);
        $data = $request->all();
        if (isset($data['no_hp'])) {
            $data['no_hp'] = \App\Models\User::normalizePhone($data['no_hp']);
        }
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
