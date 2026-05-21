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

        $existingUser = User::where('email', $vendor->email_perusahaan)->first();

        if (!$existingUser) {

            User::create([
                'name' => $vendor->nama_perusahaan, 
                'vendor_id' => $vendor->id, 
                'email' => $vendor->email_perusahaan, 
                'email_verified_at' => now(),
                'password' => Hash::make('123'),
                'role' => 'vendor',
                'remember_token' => Str::random(10),


            ]);
        }
        Mail::to($vendor->email_perusahaan)->send(new VendorApprovedMail($vendor));

        return redirect()
            ->route('procurement-validasi-vendor')
            ->with('success', 'Vendor berhasil divalidasi dan akun berhasil dibuat.');
    }

    public function rejectVendor($id)
    {
        $vendor = Vendor::findOrFail($id);

        $vendor->status = 'rejected';
        $vendor->save();

        return redirect()
            ->route('procurement-validasi-vendor')
            ->with('success', 'Vendor berhasil ditolak.');
    }
}
