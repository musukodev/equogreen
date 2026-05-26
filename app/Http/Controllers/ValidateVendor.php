<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VendorApprovedMail;

class ValidateVendor extends Controller
{
    public function approveVendor($id)
    {
        $vendor = Vendor::findOrFail($id);

        $vendor->status = 'approved';
        $vendor->save();

        $username = Str::slug($vendor->nama_perusahaan, '-');
        $existingUser = User::where('username', $username)->first();

        if (!$existingUser) {

            User::create([
                'username' => $username,
                'id_vendor' => $vendor->id_vendor,
                'password' => Hash::make('123'),
                'role' => 'vendor',


            ]);
        }

        return redirect()
            ->route('procurement-validasi-vendor')
            ->with('success', 'Vendor berhasil divalidasi dan akun berhasil dibuat.');
    }

    public function rejectVendor($id)
    {
        $vendor = Vendor::findOrFail($id);

        $vendor->delete();

        return redirect()
            ->route('procurement-validasi-vendor')
            ->with('success', 'Vendor berhasil ditolak.');
    }
}
