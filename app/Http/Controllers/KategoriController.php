<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KategoriExport;
use App\Imports\KategoriImport;
use Exception;
use PDOException;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data['kategoris'] = Kategori::orderBy('created_at', 'DESC')->get();
            return view('kategori.index', [ 'title' => 'Kategori' ])->with($data);
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
    public function store(StoreKategoriRequest $request)
    {
        try {
            $data = Kategori::create($request->all());
            return redirect('kategori')->with('success', 'Data Kategori Berhasil ditambahkan!');
        }catch (Exception | PDOException $e) {
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        try {
            $data = $kategori->update($request->all());
            return redirect('kategori')->with('success', 'Data Kategori berhasil diubah!');
        }catch (Exception | PDOException $e) {
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        try {
            $data = $kategori->delete();
            return redirect('kategori')->with('success', 'Data Kategori berhasil dihapus!');
        }catch (Exception | PDOException $e) {
        }
    }

    public function exportData()
    {
        try {
            $date = date('Y-m-d');
            return Excel::download(new KategoriExport, $date.'_Kategori.xlsx');
        }catch (Exception | PDOException $e) {
        }
    }

    public function importData()
    {
            Excel::import(new KategoriImport, request()->file('import'));
            return redirect()->back()->with('success', 'Import Data Berhasil!');

    }

    public function cetakPDF()
    {
        $data['kategoris'] = Kategori::get();
        return view('kategori.cetak', [ 'title' => 'Kategori' ])->with($data);
    }
}
