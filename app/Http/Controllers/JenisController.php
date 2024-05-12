<?php

namespace App\Http\Controllers;

use App\Exports\JenisExport;
use Exception;
use PDOException;
use App\Models\Jenis;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreJenisRequest;
use App\Http\Requests\UpdateJenisRequest;
use App\Imports\JenisImport;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data['jenis'] = Jenis::orderBy('created_at', 'DESC')->get();
            return view('jenis.index', ['title' => 'Jenis',])->with($data);
        }catch (Exception | PDOException $e) {
        }
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
    public function store(StoreJenisRequest $request)
    {
        try {
            $data = Jenis::create($request->all());
            return redirect('jenis')->with('success', 'Data Jenis Berhasil ditambahkan!');
        }catch (Exception | PDOException $e) {
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Jenis $jenis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jenis $jenis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJenisRequest $request, Jenis $jeni)
    {
        try {
            $data = $jeni->update($request->all());
            return redirect('jenis')->with('success', 'Data Jenis berhasil diubah!');
        }catch (Exception | PDOException $e) {
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis $jeni)
    {
        try {
            $data = $jeni->delete();
            return redirect('jenis')->with('success', 'Data Jenis berhasil dihapus!');
        }catch (Exception | PDOException $e) {
        }
    }

    public function exportData()
    {
        try {
            $date = date('Y-m-d');
            return Excel::download(new JenisExport, $date.'_Jenis.xlsx');
        }catch (Exception | PDOException $e) {
        }
    }

    public function importData()
    {
            Excel::import(new JenisImport, request()->file('import'));
            return redirect()->back()->with('success', 'Import Data Berhasil!');

    }

    public function cetakPDF()
    {
        $data['jenis'] = Jenis::get();
        return view('jenis.cetak', [ 'title' => 'Jenis' ])->with($data);
    }
}
