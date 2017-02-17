@extends('layouts.app')

@section('content')
<!-- tampilan buku buku -->
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
@if(Auth::user()->jabatan!='admin')
                  <th>Pinjam</th>
@endif
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
                        @if(Auth::user()->jabatan!='admin')
                        <td>
                          @if($buku->jumlah_stok<1)
                        Buku habis
                          @else
                        <a href="/pinjam/{{ $buku->id }}"class="btn btn-primary">Request Peminjaman</a>
                          @endif
                        @endif
                        </td>
                </tr>
                @endforeach
              </table>
            </div>
        </div>
    </div>
<!-- end tampilan buku buku -->
</div>
<!--konten untuk admin -->

@if(Auth::user()->jabatan=='admin')
  <div class="row">
      <div class="col-md-10">
        <div class="panel panel-default">
          <div class="panel-heading">Permintaan Peminjaman</div>
            <div class="panel-body">
              <table class="table">
                <tr>
                  <th>no</th>
                  <th>Judul Buku</th>
                  <th>Nama anggota</th>
                  <th>Alamat</th>
                  <th>Pinjamkan Buku</th>
                </tr>
                @foreach($permintaans as $permintaan)
                <tr>
                  <td>{{ $permintaan->id }}</td>
                  @foreach($bukus as $buku)
                    @if($buku->id==$permintaan->id_buku)
                      <td>{{ $buku->judul }}</td>
                    @endif
                  @endforeach
                  @foreach($users as $user)
                    @if($user->id==$permintaan->id_user)
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->alamat }}</td>
                    @endif
                  @endforeach
                  <td><a href="accpinjam/{{ $permintaan->id }}"class="btn btn-primary">Pinjamkan buku</a></td>
                </tr>
                @endforeach
              </table>
            </div>
        </div>
      </div>
  </div>
  <div class="row">
      <div class="col-md-10">
        <div class="panel panel-default">
          <div class="panel-heading">Peminjaman</div>
            <div class="panel-body">
              <table class="table">
                <tr>
                  <th>no</th>
                  <th>Judul Buku</th>
                  <th>Nama anggota</th>
                  <th>Alamat</th>
                  <th>Tanggal Pinjam</th>
                  <th>Tanggal Kembali</th>
                  <th>Durasi</th>
                  <th>Denda</th>
                  <th>Buku Kembali</th>
                </tr>
                @foreach($pinjams as $pinjam)
                <tr>
                  <td>{{ $pinjam->id }}</td>
                  @foreach($bukus as $buku)
                    @if($buku->id==$pinjam->id_buku)
                      <td>{{ $buku->judul }}</td>
                    @endif
                  @endforeach
                  @foreach($users as $user)
                    @if($user->id==$pinjam->id_user)
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->alamat }}</td>
                    @endif
                  @endforeach
                  <td>{{ $pinjam->tgl_pinjam }}</td>
                  <td>{{ $pinjam->tgl_kembali }}</td>
                  <?php $selisih=((strtotime($pinjam->tgl_kembali)-strtotime(date('Y-m-d')))/(60*60*24));
                  if ($selisih<1) {$denda=abs(500*$selisih);$selisih="Durasi Habis";}else{$denda=0;} ?>
                  <td>{{ $selisih }} hari lagi</td>
                  <!--Validasi denda-->
                  <td>Rp.{{ $denda }}</td>
                  <td><a href="kembalibuku/{{ $pinjam->id }}"class="btn btn-primary">kembalikan buku</a></td>
                </tr>
                @endforeach
              </table>
            </div>
        </div>
      </div>
  </div>
</div>
<!-- end konten admin -->
@else
<!--konten untuk anggota -->
<!-- tampilan peminjaman buku -->
  <div class="row">
      <div class="col-md-10">
          <div class="panel panel-default">
              <div class="panel-heading">Permintaan anda</div>
              <div class="panel-body">
                <table class="table">
                  <tr>
                    <th>No</th>
                    <th>judul</th>
                    <th>tahun terbit</th>
                    <th>penerbit</th>
                    <th>pengarang</th>
                  </tr>
                    @foreach($permintaans as $permintaan)
                  <tr>
                      <td>{{ $permintaan->id }}</td>
                      @foreach($bukus as $buku)
                        @if($buku->id==$permintaan->id_buku)
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
                        @endif
                      @endforeach
                  </tr>
                    @endforeach
                </table>
              </div>
            </div>
          </div>
      </div>
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Pinjaman anda</div>
                <div class="panel-body">
                  <table class="table">
                    <tr>
                      <th>No</th>
                      <th>judul</th>
                      <th>tahun terbit</th>
                      <th>penerbit</th>
                      <th>pengarang</th>
                      <th>tanggal pinjam</th>
                      <th>tanggal kembali</th>
                      <th>Durasi</th>
                      <th>Denda</th>
                    </tr>
                      @foreach($pinjams as $pinjam)
                    <tr>
                        <td>{{ $pinjam->id }}</td>
                        @foreach($bukus as $buku)
                          @if($buku->id==$pinjam->id_buku)
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
                          @endif
                        @endforeach
                        <td>{{ $pinjam->tgl_pinjam }}</td>
                        <td>{{ $pinjam->tgl_kembali }}</td>
                        <?php $selisih=((strtotime($pinjam->tgl_kembali)-strtotime(date('Y-m-d')))/(60*60*24));
                        if ($selisih<1) {$denda=abs(500*$selisih);$selisih="Durasi Habis Segera kembalikan buku";}else{$denda=0;} ?>
                        <td>{{ $selisih }} hari lagi</td>
                        <!--Validasi denda-->
                        <td>Rp.{{ $denda }}</td>
                    </tr>
                      @endforeach
                  </table>
                </div>
            </div>
        </div>
    </div>
<!-- end tampilan peminjaman buku -->
<!--konten untuk anggota -->
@endif
@endsection
