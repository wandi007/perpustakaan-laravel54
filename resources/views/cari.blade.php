@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">
              <div class="row">
                <div class="col-md-8">
                Buku buku
                </div>
                <div class="col-md-4">
                <form method="post"action="{{ url('cari') }}">
                  {{ csrf_field() }}
                  <input type="text" name="judul" placeholder="cari buku">
                  <button type="submit"name="submit"class="btn btn-primary">cari</button>
                </form>
                </div>
              </div>
            </div>
            <div class="panel-body">
              <table class="table">
                <tr>
                  <th>No</th>
                  <th>judul</th>
                  <th>tahun terbit</th>
                  <th>penerbit</th>
                  <th>pengarang</th>
                  <th>jumlah stok</th>
                  <th>Pinjam</th>
                </tr>
                @foreach($bukus as $buku)
                <tr>
                        <td>{{ $buku->id }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->tahun_terbit }}</td>
                        <td>{{ $buku->penerbit }}</td>
                        <td>
                        @foreach($pengarangs as $pengarang)
                        @if($pengarang->id_buku==$buku->id)
                          {{ $pengarang->nama_pengarang }},
                        @endif
                        @endforeach
                        </td>
                        <td>{{ $buku->jumlah_stok }}</td>
                        <td>
                        @if($buku->jumlah_stok<1)
                        Buku habis
                        @else
                        <a href="/pinjam/{{ $buku->id }}"class="btn btn-primary">Request Peminjaman</a>
                        @endif
                        </td>
                </tr>
                @endforeach
              </table>
            </div>
        </div>
    </div>
  </div>
@endsection
