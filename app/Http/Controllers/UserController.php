<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PDOException;

class UserController extends Controller
{
    public function index() {
        try {
            $data['roles'] = Roles::get();
            $data['users'] = User::orderBy('created_at', 'DESC')->get();
            return view('user.index', ['title' => 'Users'])->with($data);
        }catch (Exception | PDOException $e) {
        }
    }

    public function store(Request $request) {
        try {
            $data = $request->all();
            // dd($data);
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            if ($user)

            return redirect('user')->with('success', 'Data User berhasil ditambahkan!');
        }catch (Exception | PDOException $e) {
        }
    }

    public function update(Request $request, User $user)
    {
        try {
            $data = $user->update($request->all());
            return redirect('user')->with('success', 'Data User Berhasil diubah!');
        }catch (Exception | PDOException $e) {
        }
    }

    public function destroy(User $user)
    {
        try {
            $data = $user->delete();
            return redirect('user')->with('success', 'Data User berhasil dihapus!');
        }catch (Exception | PDOException $e ) {
        }
    }
}
