<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Buku;
use App\Pengarang;
use App\Pinjam;
use App\Permintaan;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $buku=buku::all();
      $pengarang=Pengarang::all();
      if (Auth::user()->jabatan=="admin") {
        $pinjam=Pinjam::all();
        $permintaan=Permintaan::all();
        $user=User::all();
      }else{
        $pinjam=Pinjam::where('id_user',Auth::user()->id)->get();
        $permintaan=Permintaan::where('id_user',Auth::user()->id)->get();
        $user='anggota';
      }
      return view('home',[
        'bukus'=>$buku,
        'pengarangs'=>$pengarang,
        'pinjams'=>$pinjam,
        'permintaans'=>$permintaan,
        'users'=>$user
      ]);
    }
}
