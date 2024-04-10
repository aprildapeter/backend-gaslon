@extends('layouts.master')

@section('title')
    Transaksi
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Transaksi</li>
@endsection


@section('content')
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table class="table table-stiped table-bordered text-center table-tansaksi">
                            <thead>
                                <th width="5%">No</th>
                                <th >Nama Pembeli</th>
                                <th>Payment</th>
                                <th>Total Harga</th>
                                <th>Total Ongkir</th>
                                <th>Status</th>
                                <th width="15%"><i class="fa fa-cog"></i></th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!-- ./box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row (main row) -->

    </section>
@endsection

@include('pages.transaksi.show')
@push('script')
    <script>
        let table, table2;

        $(function() {
            table = $('.table-tansaksi').DataTable({
                processing: true,
                paging: true,
                autoWidth: true,
                serverSide: true,
                responsive: false,
                ajax: {
                    url: '{{ route('transaksi.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'user.name',
                    },
                    {
                        data: 'payment',
                    },
                    {
                        data: 'total_price',
                    },
                    {
                        data: 'shipping_price',
                    },
                    {
                        data: 'status',
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]
            });
            table1 = $('.table-tansaksi-detail').DataTable({
                processing: true,
                bSort: false,
                dom: 'Brt',
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'user.name',
                    },
                    {
                        data: 'address',
                    },
                    {
                        data: 'detail_lokasi',
                    },
                    {
                        data: 'produk',
                    },
                    {
                        data: 'kategori',
                    },
                    {
                        data: 'time_pickup_delivery',
                    },
                ]
            })
            $('#modal-form').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                            url: $('#modal-form form').attr('action'),
                            type: 'post',
                            data: $('#modal-form form').serialize(),
                        })
                        // $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                        .done((response) => {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            alert('Tidak dapat menyimpan data');
                            return;
                        });
                }
            });
        });

        function showDetail(url) {
            $('#modal-detail').modal('show');

            table1.ajax.url(url);
            table1.ajax.reload();
        }

        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        }
    </script>
@endpush
