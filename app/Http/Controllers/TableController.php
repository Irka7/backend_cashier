<?php

namespace App\Http\Controllers;

use Exception;
use PDOException;
use App\Models\Table;
use App\Exports\MejaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use App\Imports\MejaImport;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // try {
            $data['tables'] = Table::orderBy('created_at', 'DESC');
            return view('meja.index', ['title' => 'Meja'])->with($data);
        // }catch (Exception | PDOException $e) {
        // }
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
    public function store(StoreTableRequest $request)
    {
        // try {
            $data = Table::create($request->all());
            return redirect('meja')->with('success', 'Data Meja berhasil ditambah!');
        // }catch (Exception | PDOException $e) {
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Table $table)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTableRequest $request, Table $table, $id)
    {
        try {
            Table::find($id)->update($request->all());
            return redirect('meja')->with('success', 'Data Meja berhasil diubah!');
        }catch (Exception | PDOException $e) {
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table, $id)
    {
        try {
            Table::where('id',$id)->delete();
            return redirect('meja')->with('success', 'Data Meja berhasil dihapus!');
        }catch (Exception | PDOException $e) {
        }
    }

    public function exportData()
    {
        try {
            $date = date('Y-m-d');
            return Excel::download(new MejaExport, $date.'_Meja.xlsx');
        }catch (Exception | PDOException $e) {
        }
    }

    public function importData()
    {
            Excel::import(new MejaImport, request()->file('import'));
            return redirect()->back()->with('success', 'Import Data Berhasil!');

    }

    public function cetakPDF()
    {
        $data['table'] = Table::get();
        return view('meja.cetak', [ 'title' => 'Meja' ])->with($data);
    }
}
