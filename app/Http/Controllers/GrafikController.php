<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Stock;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrafikController extends Controller
{
    public function index(Request $request)
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now();

        $data['menus'] = Menu::select('menus.id', 'menus.menu_name', DB::raw('COUNT(detail_transactions.id) as transaction_count'), DB::raw('SUM(detail_transactions.jumlah) as total_jumlah'))
                        ->leftJoin('detail_transactions', 'menus.id', '=', 'detail_transactions.menu_id')
                        ->leftJoin('transactions', 'detail_transactions.transaksi_id', '=', 'transactions.id')
                        ->whereBetween('transactions.tanggal', [$startDate, $endDate])
                        ->groupBy('menus.id', 'menus.menu_name')
                        ->orderByDesc('transaction_count')
                        ->limit(5)
                        ->get();
        $stok = Stock::get();
        $menu = Menu::get();
        $data['count_menu'] = $menu->count();
        $data['totalStok'] = $stok->sum('stock');
        // $transaksi = Transaction::whereBetween('tanggal', [$startDate, $endDate])
        //             ->select(DB::raw('DATE(tanggal) as date'), DB::raw('SUM(total_harga) as total'))
        //             ->groupBy('date')
        //             ->get();

        $transaksi = Transaction::whereBetween('tanggal', [$startDate, $endDate])->sum('total_harga');
        $data['totalPendapatanRupiah'] = "Rp " . number_format($transaksi, 0, ',', '.');

        return view('templates.home', [ 'title' => 'Dashboard'], compact('startDate', 'endDate'))->with($data);
    }

    public function store(Request $request)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $request->input('start_date'))->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $request->input('end_date'))->endOfDay();

        $data['menus'] = Menu::select('menus.id', 'menus.menu_name', DB::raw('COUNT(detail_transactions.id) as transaction_count'))
        ->leftJoin('detail_transactions', 'menus.id', '=', 'detail_transactions.menu_id')
        ->leftJoin('transactions', 'detail_transactions.transaksi_id', '=', 'transactions.id')
        ->whereBetween('transactions.tanggal', [$startDate, $endDate])
        ->groupBy('menus.id', 'menus.menu_name')
        ->orderByDesc('transaction_count')
        ->limit(5)
        ->get();

        $transaksi = Transaction::whereBetween('tanggal', [$startDate, $endDate])->sum('total_harga');
        $data['totalPendapatanRupiah'] = "Rp " . number_format($transaksi, 0, ',', '.');

        return view('grafik.data')->with($data);
    }
}
