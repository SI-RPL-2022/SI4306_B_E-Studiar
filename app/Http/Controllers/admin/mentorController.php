<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BidangAjar;
use App\Models\CalonMentor;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        //
    }


    public function calon_mentor()
    {
        // $count = DB::table('hospitals')->count();
        $calon_mentors = CalonMentor::orderBy('created_at')->get();
        $page = 'Data Calon Mentor';
        return view('admin.calon_mentor.data_calon_mentor', compact('calon_mentors', 'page'));
    }

    public function detail_calon_mentor($id)
    {
        // $count = DB::table('hospitals')->count();
        $calon_mentors = CalonMentor::find($id);
        $bidang = BidangAjar::orderBy('bidang')->where('id_mentor', $calon_mentors->id)->get();
        $page = 'Data Calon Mentor | ' . $calon_mentors->nama;
        return view('admin.calon_mentor.detail_calon_mentor', compact('calon_mentors', 'page', 'bidang'));
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

        return redirect('admin/calon-mentor')->with('success', 'Berhasil acc akun mentor ' . $calon_mentors['nama']);
    }

    public function tolak_mentor($id)
    {
        $calon_mentors = CalonMentor::find($id);
        $calon_mentors->update([
            'status' => 'ditolak',
        ]);

        return redirect('admin/calon-mentor')->with('success', 'Berhasil menolak akun mentor ' . $calon_mentors->nama);;
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