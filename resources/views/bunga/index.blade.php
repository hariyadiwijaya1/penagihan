@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card my-3">
            <div class="card-header">Tabel Bunga</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Suku Bunga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                            <tr>
                                <td>{{ 1 }}</td>
                                <td>{{ $bunga->suku_bunga }}</td>

                                <td>
                                    <a href="{{route('bunga.edit', $bunga->id)}}" type="btn" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                {{-- <td>{{ $pinjaman->angsuran()->select('angsuran_keberapa') }}</td> --}}
                            </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection



