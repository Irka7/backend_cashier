<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['absensis'] = Absensi::orderBy('created_at', 'DESC')->get();
        $statusOptions = Absensi::getStatusOptions();
        return view('absensi.index', compact('statusOptions'), ['title' => 'Absensi Kerja'])->with($data);
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
        $data = new Absensi();
        $data->namaKaryawan = $request->namaKaryawan;
        $data->tanggalMasuk = now();
        $data->waktuMasuk = Carbon::now()->timezone('Asia/Jakarta');
        $data->status = $request->status;
        $data->waktuKeluar = Carbon::now()->startOfDay();
        $data->save();
        return redirect('absensi')->with('success', 'Data Absensi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAbsensiRequest $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        $data = $absensi->delete();
        return redirect('absensi')->with('success', 'Data Absensi berhasil dihapus!');
    }
}
