<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Kategori;
use Exception;
use PDOException;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\select;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data['kategoris'] = Kategori::get();
            $data['menus'] = Menu::join('kategoris', 'menus.kategori_id', '=', 'kategoris.id')
                                    ->select('menus.*', 'kategoris.id as idKategori', 'kategoris.name')
                                    ->orderBy('created_at', 'DESC')
                                    ->get();
            return view('menu.index', ['title' => 'Menu'])->with($data);
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
    public function store(StoreMenuRequest $request)
    {
        // try {
            $image = $request->file('image');
        $filename = date('Y-m-d'). $image->getClientOriginalName();
        $path = 'image/'. $filename;
        Storage::disk('public')->put($path, file_get_contents($image));

        $data['menu_name'] = $request->menu_name;
        $data['price'] = $request->price;
        $data['description'] = $request->description;
        $data['image'] = $filename;
        $data['kategori_id'] = $request->kategori_id;
        // dd($data);


        Menu::create($data);
        return redirect('menu')->with('success', 'Data Menu berhasil ditambahkan!');
        // }catch (Exception | PDOException $e) {
        // }
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
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        // cek apabila ada file gambar baru yang dikirimkan
        if ($request->file('image')) {
            if($request->old_image) {
            // apabila ada data gambar lama maka gambar akan dihapus dari folder storage
            Storage::disk('public')->delete('image/'.$request->old_image);
            }

            $image = $request->file('image');
            $filename = date('Y-m-d') . $image->getClientOriginalName();
            $path = 'image/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($image));

            $data['image'] = $filename;
        }

        $data['menu_name'] = $request->menu_name;
        $data['price'] = $request->price;
        $data['description'] = $request->description;
        $data['image'] = $filename;
        $data['kategori_id'] = $request->kategori_id;

        $menu->update($data);
        return redirect('menu')->with('success', 'Data menu berhasil di ubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        if ($menu->image) {
            Storage::disk('public')->delete('image/' . $menu->image);
        }

        $menu->delete();
        return redirect('menu')->with('success', 'Data Menu berhasil dihapus!');
    }
}
