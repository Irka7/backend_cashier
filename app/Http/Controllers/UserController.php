<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use PDOException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = User::get();
            return response()->json(['status' => true, 'message' => 'success', 'data' => $data]);
        }catch (Exception | PDOException $e) {
            return response()->json(['status' => false, 'message' => 'gagal tampilkan data']);
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
    public function store(Request $request)
    {
        try {
            $data = User::create($request->all());
            return response()->json(['status' => true, 'message' => 'input success', 'data' => $data]);
        }catch (Exception | PDOException $e) {
            return response()->json(['status' => false, 'message' => 'gagal input data']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $data = $user->update($request->all());
            return response()->json(['status' => true, 'message' => 'success', 'data' => $data]);
        }catch (Exception | PDOException $e){
            return response()->json(['status' => true, 'message' => 'gagal mengubah data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $data = $user->delete();
            return response()->json(['status' => true, 'message' => 'success', 'data' => $data]);
        }catch (Exception | PDOException $e){
            return response()->json(['status' => false, 'message' => 'gagal menampilkan data']);
        }
    }
}
