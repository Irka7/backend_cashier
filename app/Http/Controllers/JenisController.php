<?php

namespace App\Http\Controllers;

use Exception;
use PDOException;
use App\Models\Jenis;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\JenisRequest;
use App\Http\Requests\StoreJenisRequest;
use App\Http\Requests\UpdateJenisRequest;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Jenis::get();
            return response()->json(['status' => true, 'message' => 'success', 'data' => $data]);
        }catch (Exception | PDOException $e){
            return response()->json([`status` => false, 'message' => 'gagal menampilkan data']);
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
    public function store(JenisRequest $request)
    {
        try {
            $data = Jenis::create($request->all());

            DB::commit();
            return response()->json(['status' => true, 'message' => ' input data success', 'data' => $data]);
        }catch (Exception | PDOException $e){
            return response()->json(["status" => false, 'message' => 'gagal menambahkan data']);
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
    public function update(JenisRequest $request, Jenis $jeni)
    {
        try {

            $data = $jeni->update($request->all());

            return response()->json(['status' => true, 'message' => 'update data success', 'data' => $data]);
        }catch (Exception | PDOException $e){
            return response()->json([`status` => false, 'message' => 'gagal mengubah data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis $jeni)
    {
        try {
            $data = $jeni->delete();
            return response()->json(['status' => true, 'message' => 'delete data success', 'data' => $data]);
        }catch (Exception | PDOException $e){
            return response()->json([`status` => false, 'message' => 'gagal menghapus data']);
        }
    }
}
