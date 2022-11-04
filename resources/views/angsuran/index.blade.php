{{-- untuk menghubungkan ke template utama (app.blade) ditambahkan title biar data dinamis--}}
@extends('layouts.app', compact('title'))

{{-- buat nampilin content --}}
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Tambah Data </a> --}}
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="float-right">
                            {{-- form untuk melakukan proses import --}}
                            <?php $url = url()->current() ?>
                                <a href="{{route('angsuran.export',substr($url, strrpos($url, '/') + 1))}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Export </a>
                                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                    class="fas fa-download fa-sm text-white-50"></i> Import </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border" id="data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Angsuran</th>
                                        <th>Nominal Angsuran</th>
                                        <th>Tanggal Angsuran</th>
                                        <th>Bukti Transaksi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail_angsuran as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>Ke-{{ $item->angsuran_keberapa }}</td>
                                        <td>{{ $item->total }}</td>
                                        <td>{{ $item->jatuh_tempo }}</td>
                                        <td>
                                        <img alt="belum upload" src="/storage/{{ $item->bukti_transaksi }}" class="img-fluid" width="100">
                                        </td>
                                        {{-- <td>{{ $item->bukti_transaksi }}</td> --}}
                                        <td>{!!  $item->status == 0 ?
                                        '
                                        <form action="'.route('update.angsuran', $item->id).'" method="POST">
                                            '.csrf_field().'
                                        <input name="status" type="hidden" value="1">
                                        <button type="submit" class="btn btn-primary btn-sm" >Lunas</button></form>'
                                        :
                                        '
                                        <form action="'.route('update.angsuran', $item->id).'" method="POST">
                                            '.csrf_field().'
                                        <input name="status" type="hidden" value="0">
                                        <button type="submit" class="btn btn-danger btn-sm" >Belum</button></form>'
                                         !!}</td>



                                    </tr>

                                    @endforeach


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


@endpush
