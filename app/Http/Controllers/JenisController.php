<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Http\Requests\StoreJenisRequest;
use App\Http\Requests\UpdateJenisRequest;
use Exception;
use PDOException;

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
}
