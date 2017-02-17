<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Permintaan;
use App\Pinjam;
use App\Buku;
use App\Pengarang;
class BukuController extends Controller
{
    //fungsi fungsi peminjaman buku
    public function accpinjam($id)
    {
      $permintaan=Permintaan::find($id);
      $update_stok_buku=Buku::find($permintaan->id_buku);
      if($update_stok_buku->jumlah_stok>0){
      $update_stok_buku->jumlah_stok=$update_stok_buku->jumlah_stok-1;
      $update_stok_buku->save();
      }else{
      return redirect('home');
      }

      $pinjam=new Pinjam;
      $pinjam->id_buku=$permintaan->id_buku;
      $pinjam->id_user=$permintaan->id_user;
      $pinjam->tgl_pinjam=date('Y-m-d');
      $tujuh_hari=mktime(0,0,0,date("n"),date("j")+7,date("Y"));
      $pinjam->tgl_kembali=date('Y-m-d',$tujuh_hari);
      $pinjam->save();
      Permintaan::destroy($id);
      return redirect('home');
    }
    public function pinjam($id)
    {
      //input data peminjaman
      $permintaan=new Permintaan;
      $permintaan->id_buku=$id;
      $permintaan->id_user=Auth::user()->id;
      $permintaan->save();
      return redirect('home');
    }
    public function pinjamselesai($id)
    {
      //Penambahan jumlah stok buku
      $pinjam=Pinjam::find($id);
      $update_stok_buku=Buku::find($pinjam->id_buku);
      $update_stok_buku->jumlah_stok=$update_stok_buku->jumlah_stok+1;
      $update_stok_buku->save();
      //pengembalian buku
      Pinjam::destroy($id);
      return redirect('home');
    }

    //fungsi fungsi alter buku
    public function tambahbuku()
    {
      return view('tambahbuku');
    }
    public function simpanbuku(Request $request)
    {
      $this->validate($request,[
        'judul'=>'required|max:100',
        'penerbit'=>'required|max:50',
        'tahun_terbit'=>'required|min:4|max:4',
        'jumlah_stok'=>'required|max:3',
        'pengarang'=>'required',
      ]);
      $simpan=new Buku;
      $simpan->judul=$request->judul;
      $simpan->penerbit=$request->penerbit;
      $simpan->tahun_terbit=$request->tahun_terbit;
      $simpan->jumlah_stok=$request->jumlah_stok;
      $simpan->save();
      $id_buku=$simpan->id;
      $pengarang=explode(',',$request->pengarang);
      for ($i=0; $i < count($pengarang); $i++) {
        $simpanpengarang=new Pengarang;
        $simpanpengarang->id_buku=$id_buku;
        $simpanpengarang->nama_pengarang=$pengarang[$i];
        $simpanpengarang->save();
      }
      return "berhasil";
    }
    public function caribuku(Request $request)
    {
      $buku=Buku::where('judul','like',"%$request->judul%")->get();
      $pengarang=Pengarang::all();
      return view('cari',[
        'bukus'=>$buku,
        'pengarangs'=>$pengarang,
      ]);
    }
}
