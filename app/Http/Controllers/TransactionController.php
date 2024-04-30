<?php

namespace App\Http\Controllers;

use Exception;
use PDOException;
use App\Models\Menu;
use App\Models\Kategori;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['kategoris'] = Kategori::with(['menu'])->get();
        // dd($data['kategoris']);

        return view('transaksi.index', ['title' => 'Transaksi'])->with($data);
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
    public function store(StoreTransactionRequest $request)
    {
        try {
            DB::beginTransaction();

            $last_id = Transaction::where('tanggal', date('Y-m-d'))->orderBy('created_at', 'desc')->select('id')->first();

            $last_id_value = isset($last_id->id) ? intval(substr($last_id->id, 8, 4)) : 0;
            $notrans = $last_id == null ? date('Ymd').'0001' : date('Ymd').sprintf('%04d', $last_id_value + 1);

            // dd($notrans);
            $insertTransaksi = Transaction::create([
                'id' => $notrans,
                'tanggal' => date('Y-m-d'),
                'total_harga' => $request->total,
                'pembayaran' => 'cash',
                'keterangan' => '',
            ]);
            // dd($insertTransaksi);
            if (!$insertTransaksi->exists) return 'error';

            foreach ($request->orderedList as $detail) {

                $insertDetailTransaksi = DetailTransaction::create([
                    'transaksi_id' => $notrans,
                    'menu_id' => $detail['menu_id'],
                    'jumlah' => $detail['qty'],
                    'subtotal' => $detail['harga'] * $detail['qty']
                ]);
            }
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Pemesanan Berhasil', 'notrans' => $notrans]);
        }catch (Exception | QueryException | PDOException $e) {
            return response()->json(['status' => false, 'message' => 'Pemesanan Gagal'.$e]);
            DB::rollBack();
        }
    }

    public function faktur($nofaktur)
    {
        // try {
            $data['transactions'] = Transaction::where('id', $nofaktur)->with(['detailTransaksi' => function
            ($query){
                $query->with('menu');
            }])->first();

            return view('cetak.faktur')->with($data);
        // }catch (Exception | QueryException | PDOException $e) {
        //     return response()->json(['status' => false, 'message' => 'Pemesanan Gagal']);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
