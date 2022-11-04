{{-- untuk menghubungkan ke template utama (app.blade) ditambahkan title biar data dinamis--}}
@extends('layouts.app', compact('title'))

{{-- buat nampilin content --}}
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Peminjam</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table border" id="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Peminjam</th>
                                    <th>Nominal Pinjaman</th>
                                    <th>Bunga Pinjaman</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tenor</th>
                                    <th>Status</th>
                                    <th>Info</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection

{{-- implementasi css --}}
@push('styles')

<link rel="stylesheet" href="{{asset('assets')}}/vendor/datatables/dataTables.bootstrap4.min.css">

@endpush

{{-- implementasi JS --}}
@push('scripts')

<script src="{{asset('assets')}}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    // ini jquery
    $(function () {
        // menginisialisasi data table dengan serverside yajra
        let table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            //untuk mengakses route
            ajax: "{{route('pinjaman.index')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    /* mengatur supaya textnya ditengah */ classname: 'dt-body-center'
                },
                {
                    data: 'user_id',
                    name: 'user.name'
                },
                {
                    data: 'total_pinjaman',
                    name: 'total_pinjaman'
                },
                {
                    data: 'angsuran_bunga',
                    name: 'angsuran_bunga'
                },
                {
                    data: 'tanggal_pinjam',
                    name: 'tanggal_pinjam'
                },
                {
                    data: 'tenor',
                    name: 'tenor'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'details',
                    name: 'details'
                },
                {
                    data: 'action',
                    name: 'action'
                }

            ]
        })
    })

</script>

@endpush
