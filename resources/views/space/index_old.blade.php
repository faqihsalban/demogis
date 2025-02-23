@extends('layouts.app')

@section('style-css')
    <link href="https://cdn.datatables.net/v/bs5/dt-2.2.2/r-3.0.4/sc-2.4.3/datatables.min.css" rel="stylesheet" integrity="sha384-vS+JqMqguo5BMCYqcHUVro8LmAH68MXGG7i8L97YF0HqJQEfZrkxtCFc8EB77xf1" crossorigin="anonymous">

@endsection

{{-- Untuk view index space  ini hampir sama dengan view index centrepoint dimana kita memuat cdn datatable
css dan js yang membedakannya ada pada ajax server side di bagian push('javascript') yaitu pada route

--}}
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Lists Space') }}</div>
                    <div class="card-body">
                        <a href="{{ route('space.create') }}" class="btn btn-info btn-sm float-end mb-2">Tambah Data</a>
                        <a href="{{ route('space.create-polygon') }}" class="btn btn-info btn-sm float-end mb-2">Tambah Data Polygon</a>

                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table" id="dataSpaces">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kategori</th>
                                    <th>Nama Layer</th>
                                    <th>Opsi</th>
                                </tr>
                            <tbody></tbody>
                            </thead>
                        </table>
                        <form action="" method="POST" id="deleteForm">
                            @csrf
                            @method("DELETE")
                            <input type="submit" value="Hapus" style="display: none">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script src="https://cdn.datatables.net/v/bs5/dt-2.2.2/r-3.0.4/sc-2.4.3/datatables.min.js" integrity="sha384-Nrdv/UNxhNUfSo3mSAKWiEoH4EPX/Bz1q1wWqvGHVhU7nVhlamMOc4NSZxwj9/3n" crossorigin="anonymous"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}
    <script>
        $(function() {
            $('#dataSpaces').DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "bInfo" : true,
                // Route untuk menampilkan data space
                "ajax": '{{ route('data-space') }}',
                "columns": [
                    {   "data": 'id', },
                    {   "data": 'category' },
                    {   "data": 'name' },
                    {   "data": "action", }
                ]
            })
        })
    </script>
@endpush
