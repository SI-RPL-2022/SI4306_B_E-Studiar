<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\JadwalAjar;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profile($id)
    {
        $jadwal = JadwalAjar::join('pembayarans', 'pembayarans.id_mentor', '=', 'jadwal_ajars.id_mentor')->where('jadwal_ajars.id_pelajar', $id)->orderBy('jadwal', 'ASC')->get(['jadwal_ajars.*', 'pembayarans.id as id_bayar']);
        return view('user/profile', compact('jadwal'));
    }

    public function detail_history($userId, $transaksiId)
    {

        $detail = Pembayaran::join('users', 'pembayarans.id_user', '=', 'users.id')->join('mentors', 'mentors.id', '=', 'pembayarans.id_mentor')->join('jadwal_ajars', 'jadwal_ajars.id_mentor', '=', 'mentors.id')->where('pembayarans.id', $transaksiId)->get(['users.*', 'pembayarans.*', 'pembayarans.id AS id_pembayaran', 'mentors.nama as nama_mentor', 'mentors.email AS email_mentor', 'jadwal_ajars.jadwal as jadwal_ajar', 'jadwal_ajars.link as jadwal_link', 'jadwal_ajars.status as jadwal_status', 'jadwal_ajars.durasi as jadwal_durasi'])->first();

        $jadwal = JadwalAjar::join('pembayarans', 'pembayarans.id_mentor', '=', 'jadwal_ajars.id_mentor')->where('jadwal_ajars.id_pelajar', $userId)->orderBy('jadwal', 'ASC')->get(['jadwal_ajars.*', 'pembayarans.id as id_bayar']);
        return view('user/profile', compact('jadwal', 'detail'));
    }

    public function bayar_transaksi($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'metode_bayar' => 'required',
        ]);

        if ($validator->fails()) {
            toast('Pilih metode pembayaran untuk melanjutkan!', 'error', 'top-right');
            return redirect()->back();
        }

        $pembayaran = Pembayaran::find($id);
        $pembayaran->update([
            'metode_bayar' => $request->metode_bayar,
        ]);

        return view('user/bayar_transaksi', compact('pembayaran'));
    }

    public function upload_bukti_bayar($id, Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'bukti' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     toast('Upload bukti pembayaran!', 'error', 'top-right');
        //     return view('user/bayar_transaksi', compact('pembayaran'));
        // }
        // dd('');
        $pembayaran = Pembayaran::find($id);
        $imgName = $request->gambar;
        if ($request->gambar) {
            $imgName = $pembayaran->id_user . '-' .  time() . '-' . $request->gambar->getClientOriginalName();
        }

        $request->gambar->move(public_path('img/bukti_bayar/'), $imgName);

        $pembayaran->update([
            'status' => 'Menunggu Verifikasi',
            'bukti' => $imgName,
            'tgl_bayar' => date("d-m-Y H:i:s"),
        ]);

        alert()->success('Upload Bukti Berhasil', 'Bukti bayar anda akan dikonfirmasi oleh admin');
        return redirect('user/profile/' . $pembayaran->id_user);
    }
}