<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\PermintaanAjar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class PermintaanController extends Controller
{
  public function __construct()
  {
    toast('Silakan login terlebih dahulu untuk melanjutkan!', 'error', 'top-right');
    $this->middleware('auth');
  }

  public function permintaan_ajar(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'jadwal' => 'required',
      'durasi' => 'required',
    ]);

    if ($validator->fails()) {
      toast('Masukan jadwal & durasi mentoring!', 'error', 'top-right');
      return redirect()->back();
    }

    $permintaan = new PermintaanAjar();
    $permintaan->jadwal = $request->jadwal;
    $permintaan->id_pelajar = Auth::id();
    $permintaan->id_bidang = $request->id_bidang;
    $permintaan->durasi = $request->durasi;
    $permintaan->save();

    alert()->success('Permintaan Berhasil', 'Silakan tunggu konfirmasi dari mentor');
    return redirect()->back();
  }
}