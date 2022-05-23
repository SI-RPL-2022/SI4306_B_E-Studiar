<?php

namespace App\Http\Controllers\mentor;

use App\Http\Controllers\Controller;
use App\Models\JadwalAjar;
use App\Models\PermintaanAjar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class mentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mentor/dashboard');
    }

    public function permintaan_ajar()
    {
        $permintaan_ajar = PermintaanAjar::join('users', 'permintaan_ajars.id_pelajar', '=', 'users.id')->join('bidang_ajars', 'bidang_ajars.id', '=', 'permintaan_ajars.id_bidang')->get(['permintaan_ajars.*', 'permintaan_ajars.id as id_permintaan', 'users.*', 'bidang_ajars.*']);

        $page = 'Permintaan Ajar';
        return view('mentor.permintaan_ajar', compact('permintaan_ajar', 'page'));
    }

    public function terima_permintaan_ajar($id, Request $request)
    {
        $permintaan_ajar = PermintaanAjar::find($id);

        DB::transaction(function () use ($permintaan_ajar, $request) {

            $jadwal_ajar = new JadwalAjar();
            $jadwal_ajar->id_pelajar = $permintaan_ajar['id_pelajar'];
            $jadwal_ajar->id_bidang = $permintaan_ajar['id_bidang'];
            $jadwal_ajar->durasi = $permintaan_ajar['durasi'];
            $jadwal_ajar->jadwal = $permintaan_ajar['jadwal'];
            $jadwal_ajar->link = $request->link;
            $jadwal_ajar->note = $request->note;
            $jadwal_ajar->id_mentor = Auth::id();

            $jadwal_ajar->save();

            $permintaan_ajar->delete();
        });
        alert()->success('Permintaan Berhasil', 'Berhasil menerima permintaan ajar');
        return redirect('mentor/permintaan-ajar');
    }

    public function tolak_permintaan_ajar($id)
    {
        $permintaan_ajar = PermintaanAjar::find($id);
        $permintaan_ajar->update([
            'status' => 'ditolak',
        ]);

        alert()->success('Permintaan Berhasil', 'Berhasil menerima menolak ajar');
        return redirect('mentor/permintaan-ajar');
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