@extends('layouts.master')

@section('title')
    Edit User
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Edit User</li>
@endsection


@section('content')
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!-- form start -->
                    <form action="{{ route('user.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="url" value="{{ $item->url }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukan Nama User" value="{{ $item->name }}" readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Masukan Nama User" value="{{ $item->email }}" readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                            <div class="form-group">
                                <label>Roles</label>
                                <select class="form-control" name="roles">
                                    <option value="{{ $item->roles }}">{{ $item->roles }}</option>
                                    <option disabled>-------</option>
                                    <option value="pelanggan">pelanggan</option>
                                    <option value="kurir">kurir</option>
                                    <option value="admin">admin</option>
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

@push('script')
    {{-- <script>
        let table;

        $(function() {
            table = $('.table').DataTable({
                processing: true,
                paging: true,
                autoWidth: true,
                serverSide: true,
                responsive: false,
                ajax: {
                    url: '',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'nama',
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
    </script> --}}
@endpush
