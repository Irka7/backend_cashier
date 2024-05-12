<?php

namespace App\Http\Controllers;

use Exception;
use PDOException;
use App\Models\Customer;
use App\Exports\PelangganExport;
use App\Imports\PelangganImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data['customers'] = Customer::orderBy('created_at', 'DESC')->get();
            return view('pelanggan.index', ['title' => 'Pelanggan'])->with($data);
        }catch (Exception | QueryException | PDOException $e) {
            return response()->json(['status' => false, 'message' => 'Menampilkan Data Gagal'.$e]);
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
    public function store(StoreCustomerRequest $request)
    {
        try {
            $data = Customer::create($request->all());
            return redirect('pelanggan')->with('success', 'Data Pelanggan berhasil ditambahkan!');
        }catch (Exception | QueryException | PDOException $e) {
            return response()->json(['status' => false, 'message' => 'Gagal Menambahkan Data'.$e]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer, $id)
    {
        try {
            Customer::find($id)->update($request->all());
            return redirect('pelanggan')->with('success', 'Data Pelanggan berhasil diubah!');
        }catch (Exception | QueryException | PDOException $e) {
            return response()->json(['status' => false, 'message' => 'Gagal Mengubah Data'.$e]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer, $id)
    {
        try {
            Customer::where('id', $id)->delete();
            return redirect('pelanggan')->with('success', 'Data Pelanggan berhasil dihapus!');
        }catch (Exception | QueryException | PDOException $e) {
            return response()->json(['status' => false, 'message' => 'Gagal Menghapus Data'.$e]);
        }
    }

    public function exportData()
    {
        try {
            $date = date('Y-m-d');
            return Excel::download(new PelangganExport, $date.'_Pelanggan.xlsx');
        }catch (Exception | PDOException $e) {
        }
    }

    public function importData()
    {
        Excel::import(new PelangganImport, request()->file('import'));
        return redirect()->back()->with('success', 'Import Data Berhasil!');
    }

    public function cetakPDF()
    {
        $data['customer'] = Customer::get();
        return view('pelanggan.cetak', [ 'title' => 'Pelanggan' ])->with($data);
    }
}
