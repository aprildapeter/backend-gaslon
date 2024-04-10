<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.transaksi.index');
    }

    public function data()
    {
        $transaksi = Transaction::with('user')->orderBy('id', 'desc')->get();

        return datatables()
            ->of($transaksi)
            ->addIndexColumn()
            // ->addColumn('img_url', function ($transaksi) {
            //     return '<img src="' . asset($transaksi->url) . '" alt="" width="75">';
            // })
            ->addColumn('total_price', function ($transaksi) {
                return 'Rp ' . format_uang($transaksi->total_price);
            })
            ->addColumn('shipping_price', function ($transaksi) {
                return 'Rp ' . format_uang($transaksi->shipping_price);
            })
            ->addColumn('aksi', function ($transaksi) {
                return '
            <div class="btn-group">
                <button type="button" onclick="showDetail(`' . route('transaksi.show', $transaksi->id) . '`)" class="btn btn-xs btn-warning "><i class="fa fa-eye"></i> Show</button>
                <a href="' . route('transaksi.edit', $transaksi->id) . '" class="btn btn-xs btn-info "><i class="fa fa-pencil"></i> Edit</a>
            </div>
            ';
            })
            ->rawColumns(['aksi', 'total_price', 'shipping_price'])
            ->make(true);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaksi_items = TransactionItem::with('transaksi','user','produk', 'produk.kategori')->where('transactions_id',$id)->get();

        return datatables()
            ->of($transaksi_items)
            ->addIndexColumn()
            ->addColumn('address', function ($transaksi_items) {
                return $transaksi_items->transaksi->address;
            })
            ->addColumn('detail_lokasi', function ($transaksi_items) {
                return $transaksi_items->transaksi->detail_lokasi;
            })
            ->addColumn('produk', function ($transaksi_items) {
                return $transaksi_items->produk->name;
            })
            ->addColumn('kategori', function ($transaksi_items) {
                return $transaksi_items->produk->kategori->name;
            })
            ->addColumn('time_pickup_delivery', function ($transaksi_items) {
                return tanggal_indonesia($transaksi_items->transaksi->time_pickup_delivery);
            })
            ->rawColumns(['produk','kategori','time_pickup_delivery','address','detail_lokasi'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaksi)
    {
        return view('pages.transaksi.edit',[
            'item' => $transaksi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaksi)
    {
        $data = $request->all();

        $transaksi->update($data);

        return redirect()->route('transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
