<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BidangAjar;
use App\Models\CalonMentor;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;


class mentorController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (session('success')) {
                Alert::success(session('success'));
            }

            if (session('error')) {
                Alert::error(session('error'));
            }

            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('mentor.dashboard');
    }


    public function calon_mentor()
    {
        // $count = DB::table('hospitals')->count();
        $calon_mentors = CalonMentor::orderBy('created_at')->get();
        $page = 'Data Calon Mentor';
        return view('admin.calon_mentor.data_calon_mentor', compact('calon_mentors', 'page'));
    }
    public function data_mentor()
    {
        // $count = DB::table('hospitals')->count();
        $mentors = Mentor::orderBy('created_at')->get();
        $page = 'Data Mentor';
        return view('admin.mentor.mengelolaakun', compact('mentors', 'page'));
    }
    public function detail_mentor($id)
    {
        // $count = DB::table('hospitals')->count();
        try {
            $mentors = Mentor::findOrFail($id);
            $bidang = BidangAjar::orderBy('bidang')->where('id_mentor', $mentors->id)->get();
            $page = 'Data Mentor | ' . $mentors->nama;
            return view('admin.mentor.detail_mentor', compact('mentors', 'page', 'bidang'));
        } catch (\Throwable $th) {
            toast('Error! Mentor ID tidak ditemukan', 'error', 'top-right');
            return redirect()->back();
        }
    }
    public function detail_calon_mentor($id)
    {
        // $count = DB::table('hospitals')->count();
        try {
            $calon_mentors = CalonMentor::findOrFail($id);
            $bidang = BidangAjar::orderBy('bidang')->where('id_mentor', $calon_mentors->id)->get();
            $page = 'Data Calon Mentor | ' . $calon_mentors->nama;
            return view('admin.calon_mentor.detail_calon_mentor', compact('calon_mentors', 'page', 'bidang'));
        } catch (\Throwable $th) {
            toast('Error! Calon Mentor ID tidak ditemukan', 'error', 'top-right');
            return redirect()->back();
        }
    }

    public function terima_mentor($id)
    {
        $calon_mentors = CalonMentor::find($id);
        DB::transaction(function () use ($calon_mentors) {

            $mentor = new Mentor();
            $mentor->id = $calon_mentors['id'];
            $mentor->nama = $calon_mentors['nama'];
            $mentor->email = $calon_mentors['email'];
            $mentor->password = Hash::make('123456');
            $mentor->tgl_lahir = $calon_mentors['tgl_lahir'];
            $mentor->tahun_ngajar = $calon_mentors['tahun_ngajar'];
            $mentor->deskripsi = $calon_mentors['deskripsi'];
            $mentor->gambar = $calon_mentors['gambar'];
            $mentor->save();

            $calon_mentors->delete();
        });

        $details = [
            'title' => 'Status Akun Mentor ' . $calon_mentors->nama,
            'dear' => 'Dear, ' . $calon_mentors->nama,
            'status' => 'Telah diterima',
            'credential_title' => 'Account Credentials',
            'email' => $calon_mentors->email,
            'password' => '123456',
            'info_login' => 'Lakukan penggantian password setelah melakukan login untuk menjaga keamanan.',
            'body' => 'Pengajuan akun anda berhasil dibuat dan sudah setujui oleh administrator. Silakan gunakan credentials berikut untuk melakukan login.'
        ];
        Mail::to($calon_mentors->email)->send(new \App\Mail\NotifTerimaMentor($details));

        return redirect('admin/calon-mentor')->with('success', 'Informasi penerimaan akun berhasil dikirim melalui email');
    }

    public function tolak_mentor($id)
    {
        $calon_mentors = CalonMentor::find($id);
        $calon_mentors->update([
            'status' => 'ditolak',
        ]);
        $details = [
            'title' => 'Status Akun Mentor ' . $calon_mentors->nama,
            'dear' => 'Dear, ' . $calon_mentors->nama,
            'status' => 'Ditolak',
            'credential_title' => '',
            'email' => '',
            'password' => '',
            'info_login' => '',
            'body' => 'Pengajuan akun mentor anda saat ini telah ditolak oleh admin. Silakan hubungi administrator Estudir untuk informasi lebih lanjut.'
        ];
        Mail::to($calon_mentors->email)->send(new \App\Mail\NotifMailMentor($details));

        return redirect('admin/calon-mentor')->with('success', 'Informasi penolakan berhasil dikirim melalui email');
    }

    public function hapus_mentor($id)
    {
        $mentor = Mentor::find($id);
        BidangAjar::where('id_mentor', '=', $mentor->id)->get()->first()->delete();
        $mentor->delete();
        alert()->success('Berhasil', 'Berhasil menghapus akun mentor');
        return redirect('admin/mentor');
    }

    public function banned_mentor($id)
    {
        $mentor = Mentor::find($id);
        $mentor->update([
            'status' => 'Banned',
        ]);
        alert()->success('Berhasil', 'Berhasil banned akun mentor');
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}