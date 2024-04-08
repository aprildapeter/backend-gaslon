@extends('layouts.master')

@section('title')
    Produk
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Produk</li>
@endsection


@section('content')
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <a href="{{ route('produk.create') }}" class="button btn btn-success btn-xs"><i
                                class="fa fa-plus-circle"> </i> Tambah Kategori
                        </a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table class="table table-stiped table-bordered text-center ">
                            <thead>
                                <th width="5%">No</th>
                                <th>Nama Produk</th>
                                <th>Nama Kategori</th>
                                <th>Deskripsi</th>
                                <th>Hargas</th>
                                <th>Image</th>
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

@push('script')
    <script>
        let table;

        $(function() {
            table = $('.table').DataTable({
                processing: true,
                paging: true,
                autoWidth: true,
                serverSide: true,
                responsive: false,
                ajax: {
                    url: '{{ route('produk.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'kategori.name',
                    },
                    {
                        data: 'description',
                    },
                    {
                        data: 'price',
                    },
                    {
                        data: 'img_url',
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]
            });
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
