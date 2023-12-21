<?php

namespace App\Http\Controllers;

use Exception;
use PDOException;
use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Menu::get();
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
    public function store(StoreMenuRequest $request)
    {
        try {
            $data = Menu::create($request->all());
            return response()->json(['status' => true, 'message' => 'success', 'data' => $data]);
        }catch (Exception | PDOException $e){
            return response()->json(['status' => false, 'message' => 'gagal menampilkan data']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMenuRequest $request, Menu $menu)
    {
        try {
            $data = $menu->update($request->all());
            return response()->json(['status' => true, 'message' => 'success', 'data' => $data]);
        }catch (Exception | PDOException $e){
            return response()->json([`status` => false, 'message' => 'gagal menampilkan data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        try {
            $data = $menu->delete();
            return response()->json(['status' => true, 'message' => 'success', 'data' => $data]);
        }catch (Exception | PDOException $e){
            return response()->json([`status` => false, 'message' => 'gagal menampilkan data']);
        }
    }
}
