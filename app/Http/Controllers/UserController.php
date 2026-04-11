<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data user',
            'menuadminuser' => 'active',
            'user' => User::orderBy('jabatan', 'asc')->get(),
        );

        return view('admin/user/index', $data);
    }

    public function create()
    {
        $data = array(
            'title' => 'Tambah Data user',
            'menuadminuser' => 'active',
        );

        return view('admin/user/create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users,email',
            'jabatan' => 'required',
            'password' => 'required|confirmed|min:8',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah ada',
            'jabatan.required' => 'Jabatan harus di pilih',
            'password.required' => 'password tidak boleh kosong',
            'password.confirmed' => 'password konfirmasi tidak sama',
            'password.min' => 'password minimal 8 karakter',
        ]);

        $user = new User;
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->jabatan = $request->jabatan;
        $user->password = Hash::make($request->password);
        $user->is_tugas = false;
        $user->save();

        return redirect()->route('user')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = array(
            'title' => 'Edit Data user',
            'menuadminuser' => 'active',
            'user' => User::findOrFail($id),
        );

        return view('admin/user/edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'jabatan' => 'required',
            'password' => 'nullable|confirmed|min:8',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah ada',
            'jabatan.required' => 'Jabatan harus di pilih',
            'password.confirmed' => 'password konfirmasi tidak sama',
            'password.min' => 'password minimal 8 karakter',    
        ]);



        $user = User::findOrFail($id);
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->jabatan = $request->jabatan;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('user')->with('success', 'Data berhasil di ubah');
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user')->with('success', 'Data berhasil di hapus');
    }

    public function excel() {
        $filename = now()->format('d-m-y_h.i.s');
        return Excel::download(new UserExport, 'DataUser_'.$filename.'.xlsx');
    }

    public function pdf() {
        $filename = now()->format('d-m-y_h.i.s');
        $data = array(
            'user' => User::get(),
        );
        
        $pdf = Pdf::loadView('admin/user/pdf', $data);
    return $pdf->download('DataUser_'.$filename.'.pdf');
    }
}