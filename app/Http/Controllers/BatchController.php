<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{
    /**
     * Display a listing of folder groups (by year).
     */
    public function indexGroups()
    {
        // Get distinct years from waktu_mulai
        $years = Batch::select(DB::raw('YEAR(waktu_mulai) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('equogreen-frontend.batch-list', compact('years'));
    }

    /**
     * Display a listing of batches for a specific year.
     */
    public function index($year)
    {
        $batches = Batch::whereYear('waktu_mulai', $year)
            ->orderBy('waktu_mulai', 'asc')
            ->get();

        return view('equogreen-frontend.batch_barang', compact('batches', 'year'));
    }

    /**
     * Store a newly created batch in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_date'   => 'required|date',
            'end_time'   => 'required',
        ]);

        $waktu_mulai = $request->start_date . ' ' . $request->start_time . ':00';
        $waktu_selesai = $request->end_date . ' ' . $request->end_time . ':00';

        // Get the current user's procurement ID
        // Note: based on the user model, we have `id_procurement`
        $id_procurement = Auth::user()->id_procurement;

        Batch::create([
            'id_procurement' => $id_procurement,
            'waktu_mulai'    => $waktu_mulai,
            'waktu_selesai'  => $waktu_selesai,
        ]);

        // Redirect back to the year of the newly created batch
        $year = date('Y', strtotime($request->start_date));
        return redirect()->route('procurement-batch_barang_by_year', ['year' => $year])
            ->with('success', 'Batch berhasil ditambahkan.');
    }

    /**
     * Remove the specified batch from storage.
     */
    public function destroy($id)
    {
        $batch = Batch::findOrFail($id);
        $year = date('Y', strtotime($batch->waktu_mulai));
        
        $batch->delete();

        return redirect()->route('procurement-batch_barang_by_year', ['year' => $year])
            ->with('success', 'Batch berhasil dihapus.');
    }
}
