<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.produk.index');
    }

    public function data()
    {
        $produk = Product::with('kategori')->orderBy('id', 'desc')->get();

        return datatables()
            ->of($produk)
            ->addIndexColumn()
            ->addColumn('img_url', function ($produk) {
                return '<img src="' . asset($produk->url) . '" alt="" width="75">';
            })
            ->addColumn('aksi', function ($produk) {
                return '
            <div class="btn-group">
                <a href="' . route('produk.edit', $produk->id) . '" class="btn btn-xs btn-info "><i class="fa fa-pencil"></i> Edit</a>
                <button onclick="deleteData(`' . route('produk.destroy', $produk->id) . '`)" class="btn btn-xs btn-danger "><i class="fa fa-trash"></i> Hapus</button>
            </div>
            ';
            })
            ->rawColumns(['aksi','img_url'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = ProductCategory::all();
        return view('pages.produk.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $photo = $request->file('url');
        $originalName = $photo->getClientOriginalName();
        // Move the file to the public directory
        $photo->move(public_path('img/produk'), $originalName);

        // Now you can use the path to the file
        $data['url'] = 'img/produk/' . $originalName;

        Product::create($data);

        return redirect()->route('produk.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $produk)
    {
        $kategori = ProductCategory::all();
        return view('pages.produk.edit',[
            'item' => $produk,
            'kategori' => $kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $produk)
    {
        $data = $request->all();
        if ($request->file('url')) {
            $photo = $request->file('url');
            $originalName = $photo->getClientOriginalName();
            // Move the file to the public directory
            $photo->move(public_path('img/kategori'), $originalName);

            // Now you can use the path to the file
            $data['url'] = 'img/kategori/' . $originalName;
        }

        $produk->update($data);
        return redirect()->route('produk.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $produk)
    {
        $produk->delete();

        return redirect()->route('kategori.index');
    }
}
