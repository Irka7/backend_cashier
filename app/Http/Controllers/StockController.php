<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Models\Menu;
use Exception;
use PDOException;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data['menus'] = Menu::get();
            $data['stocks'] = Stock::join('menus', 'stocks.menu_id', '=', 'menus.id')
                                     ->select('stocks.*', 'menus.id as idMenu', 'menus.menu_name')
                                     ->orderBy('created_at', 'DESC')
                                     ->get();
            return view('stock.index', ['title' => 'Stok'])->with($data);
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
    public function store(StoreStockRequest $request)
    {
        try {
            $data = Stock::create($request->all());
            // dd($data);
            return redirect('stok')->with('success', 'Data Stok Berhasil ditambahkan!');
        }catch (Exception | PDOException $e) {
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockRequest $request, Stock $stock, $id)
    {
        try {
            // $data = $stock->update($request->all());
            Stock::find($id)->update($request->all());
            return redirect('stok')->with('success', 'Data Stok berhasil diubah!');
        }catch (Exception | PDOException $e) {

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        try {
            $data = $stock->delete();
            return redirect('stok')->with('success', 'Data Stok berhasil dihapus!');
        }catch (Exception | PDOException $e) {

        }

    }
}
