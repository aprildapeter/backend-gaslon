@extends('layouts.master')

@section('title')
    Edit Produk
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Edit Produk</li>
@endsection


@section('content')
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!-- form start -->
                    <form action="{{ route('transaksi.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="box-body">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="{{ $item->status }}">{{ $item->status }}</option>
                                    <option disabled>-------</option>
                                    <option value="pending">pending</option>
                                    <option value="success">success</option>
                                    <option value="progress">progress</option>
                                    <option value="canceled">canceled</option>
                                    <option value="failed">failed</option>
                                    <option value="shipping">shipping</option>
                                    <option value="shipped">shipped</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row (main row) -->

    </section>
@endsection

