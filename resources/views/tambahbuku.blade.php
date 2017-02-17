@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Buku</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/tambahbuku') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="judul"class="col-md-4 control-label">Judul</label>
                          <div class="col-md-6">
                            <input class="form-control" type="text" name="judul" value="{{ old('judul') }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="penerbit"class="col-md-4 control-label">Penerbit</label>
                          <div class="col-md-6">
                            <input class="form-control" type="text" name="penerbit" value="{{ old('penerbit') }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="tahun_terbit"class="col-md-4 control-label">Tahun terbit</label>
                          <div class="col-md-6">
                            <input class="form-control" type="number" name="tahun_terbit" value="{{ old('tahun_terbit') }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="jumlah_stok"class="col-md-4 control-label">Jumlah stok</label>
                          <div class="col-md-6">
                            <input class="form-control" type="number" name="jumlah_stok" value="{{ old('jumlah_stok') }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="pengarang"class="col-md-4 control-label">pengarang</label>
                          <div class="col-md-6">
                            Nama pengarang pisahkan dengan koma (,) Contoh : john,alex
                            <input class="form-control" type="text" name="pengarang" value="{{ old('pengarang') }}">
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Tambah Buku
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
