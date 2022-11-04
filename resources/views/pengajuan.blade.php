@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="{{route('profil', auth()->user()->id)}}" class="btn btn-primary mb-3" >Kembali</a>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Tambah Data </a> --}}
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Basic Card Example</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('daftar.pinjaman') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Total Pinjaman</label>
                            <input type="number" name="total_pinjaman" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Pilih Jangka Waktu Pinjaman</label>
                            <select class="form-control" name="tenor" id="">
                                <option value="1">1</option>
                                <option value="3">3</option>
                                <option value="6">6</option>
                                <option value="9">9</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Ajukan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
