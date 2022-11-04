@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('pinjaman.baru')}}" class="btn btn-primary mb-3" >Ajukan</a>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ 'You are logged in!' . auth()->user()->name }}
                    {{-- foreach berfungsi untuk looping data dari controller --}}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Total Pinjaman</th>
                                <th>Tenor</th>
                                <th>Saldo Pinjaman</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pinjaman as $item)
                            <tr>
                                <td>{{  $loop->iteration}}</td>
                                <td>{{  $item->total_pinjaman}}</td>
                                <td>{{  $item->tenor}}</td>
                                <td>{{  $item->saldo_pinjaman }}</td>
                                <td>{!!  $item->status == 1 ? '<button class="btn btn-primary" disabled>Diterima</button>' : ' <button class="btn btn-danger" disabled>Ditolak</button>
                                </form>' !!}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card my-3">
                <div class="card-header">Tabel Angsuran</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Angsuran ke</th>
                                <th>Nominal Angsuran</th>
                                <th>Jatuh Tempo</th>    
                                <th>Bukti Pembayaran</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($angsuran as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->angsuran_keberapa }}</td>
                                    <td>{{ $data->total }}</td>
                                    <td>{{ $data->jatuh_tempo}}</td>
                                    <td>
                                        <form action="{{ route('upload.file', $data->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="bukti_transaksi">
                                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                        </form>
                                        <img alt="belum upload" src="/storage/{{ $data->bukti_transaksi }}" class="img-fluid" width="100">
                                    </td>
                                    <td>{!! $data->status == 1 ? '<button class="btn btn-primary" disabled>Sudah Bayar</button>' : ' <button class="btn btn-danger" disabled>Belum Bayar</button>
                                    ' !!}</td>
                                    {{-- <td>{{ $pinjaman->angsuran()->select('angsuran_keberapa') }}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
