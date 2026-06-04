<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view("produk.index", compact("produks"));
    }

    public function create()
    {
        return view("produk.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        Produk::create([
            'name' => $request->nama,
            'description' => $request->deskripsi,
            'active' => 1
        ]);

        return redirect()->route("produk.index");
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view("produk.edit", compact("produk"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update([
            'name' => $request->nama,
            'description' => $request->deskripsi,
        ]);

        return redirect()->route("produk.index");
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route("produk.index");
    }
}