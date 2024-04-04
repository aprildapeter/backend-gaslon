<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.kategori.index');
    }

    public function data()
    {
        $kategori = ProductCategory::orderBy('id', 'desc')->get();

        return datatables()
            ->of($kategori)
            ->addIndexColumn()
            ->addColumn('img_url', function ($kategori) {
                return '<img src="' . asset($kategori->img_url) . '" alt="" width="75">';
            })
            ->addColumn('aksi', function ($kategori) {
                return '
            <div class="btn-group">
                <a href="' . route('kategori.edit', $kategori->id) . '" class="btn btn-xs btn-info "><i class="fa fa-pencil"></i> Edit</a>
                <button onclick="deleteData(`' . route('kategori.destroy', $kategori->id) . '`)" class="btn btn-xs btn-danger "><i class="fa fa-trash"></i> Hapus</button>
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
        return view('pages.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->all();
        $photo = $request->file('img_url');
        $originalName = $photo->getClientOriginalName();
        // $data['img_url'] = $photo->storeAs('img/kategori',$originalName, 'public');
        // Move the file to the public directory
        $photo->move(public_path('img/kategori'), $originalName);

        // Now you can use the path to the file
        $data['img_url'] = 'img/kategori/' . $originalName;

        ProductCategory::create($data);

        return redirect()->route('kategori.index');
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
    public function edit(ProductCategory $kategori)
    {
        return view('pages.kategori.edit',[
            'item' => $kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $kategori)
    {
        $data = $request->all();
        if ($request->file('img_url')) {
            $photo = $request->file('img_url');
            $originalName = $photo->getClientOriginalName();
            // Move the file to the public directory
            $photo->move(public_path('img/kategori'), $originalName);

            // Now you can use the path to the file
            $data['img_url'] = 'img/kategori/' . $originalName;
        }

        $kategori->update($data);
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index');
    }
}
