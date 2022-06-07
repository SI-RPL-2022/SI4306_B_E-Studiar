<?php

namespace App\Http\Controllers\mentor;

use App\Http\Controllers\Controller;
use App\Models\BidangAjar;
use App\Models\JadwalAjar;
use App\Models\Pembayaran;
use App\Models\PermintaanAjar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
// use Illuminate\Support\Str;

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

    public function jadwal_ajar()
    {
        $jadwal = JadwalAjar::join('users', 'users.id', '=', 'jadwal_ajars.id_pelajar')->join('pembayarans', 'pembayarans.id_user', '=', 'jadwal_ajars.id_pelajar')->where('jadwal_ajars.id_mentor', '=', Auth()->user()->id)->get(['jadwal_ajars.id AS id_jadwal', 'jadwal_ajars.*', 'users.*', 'pembayarans.status AS status_bayar', 'pembayarans.tgl_bayar AS tgl_bayar']);
        return view('mentor/jadwal_ajar', compact('jadwal'));
    }

    public function detail_jadwal_ajar($id)
    {
        $jadwal = JadwalAjar::join('users', 'users.id', '=', 'jadwal_ajars.id_pelajar')->join('pembayarans', 'pembayarans.id_user', '=', 'jadwal_ajars.id_pelajar')->where('jadwal_ajars.id_mentor', '=', Auth()->user()->id)->where('jadwal_ajars.id', '=', $id)->get(['jadwal_ajars.id AS id_jadwal', 'jadwal_ajars.*', 'users.*', 'pembayarans.status AS status_bayar', 'pembayarans.tgl_bayar AS tgl_bayar'])->first();
        return view('mentor/detail_jadwal_ajar', compact('jadwal'));
    }

    public function jadwal_ajar_calendar()
    {
        $events = [];
        $data = JadwalAjar::where('id_mentor', '=', Auth()->user()->id)->get();

        // dd(Str::random(12));
        if ($data->count()) {
            foreach ($data as $key => $value) {
                $user = User::find($value->id_pelajar);
                $events[] = Calendar::event(
                    $user->nama,
                    false,
                    new \DateTime($value->jadwal),
                    new \DateTime($value->jadwal . ' +' .  $value->durasi . ' hour'),
                    $value->id,
                    [
                        'url' => 'http://localhost:8000/mentor/jadwal-ajar/' . $value->id
                    ]
                );
            }
        }
        // dd($events);
        $calendar = Calendar::addEvents($events);
        return view('mentor/jadwal_ajar_calendar', compact('calendar'));
    }

    public function update_jadwal_ajar($id, Request $request)
    {
        $jadwal_ajar = JadwalAjar::find($id);
        $jadwal_ajar->update([
            'status' => $request->status,
            'note' => $request->note,
        ]);

        alert()->success('Update Berhasil', 'Berhasil update jadwal ajar');
        return redirect('mentor/jadwal-ajar');
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

            $bidang = BidangAjar::find($permintaan_ajar['id_bidang']);

            $total_bayar = (int)$jadwal_ajar->durasi * (int)$bidang->tarif;

            $pembayaran = new Pembayaran();
            $pembayaran->id = generateNoTransaksi();
            $pembayaran->id_mentor = $jadwal_ajar->id_mentor;
            $pembayaran->id_user = $permintaan_ajar['id_pelajar'];
            $pembayaran->total_bayar = $total_bayar;
            $pembayaran->save();

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