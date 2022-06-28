<?php

namespace App\Http\Controllers\mentor;

use App\Http\Controllers\Controller;
use App\Models\BidangAjar;
use App\Models\Feedback;
use App\Models\JadwalAjar;
use App\Models\Mentor;
use App\Models\Pembayaran;
use App\Models\PermintaanAjar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Response;

// use Illuminate\Support\Str;

class mentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('mentor/dashboard');
    // }
    public function index(Request $request, $filter = null)
    {
        // dd($chartType);
        // $filterData = $request->filter == '*';

        $chart_options = [
            'chart_title' => 'Rating Bedasarkan Feedback',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Feedback',
            'group_by_field' => 'rating',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            'where_raw' => 'id_mentor = ' . auth()->user()->id
        ];
        $chart1 = new LaravelChart($chart_options);
        // dd($chart1);

        $chart_options = [
            'chart_title' => 'Hasil Pendapatan',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Pembayaran',
            'group_by_field' => 'created_at',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'total_bayar',
            'chart_type' => 'line',
            'where_raw' => 'id_mentor = ' . auth()->user()->id . ' and status = "Terverifikasi"'
        ];
        if ($request->filterPendapatan != null and $filter == 'filterdata') {
            $chart_options['group_by_period'] = $request->filterPendapatan;
        } else {
            $chart_options['group_by_period'] = 'day';
        }
        $pendapatan = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Total Permintaan',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\JadwalAjar',
            'group_by_field' => 'created_at',
            'aggregate_function' => 'count',
            // 'aggregate_field' => 'total_bayar',
            'chart_type' => 'line',
            'where_raw' => 'id_mentor = ' . auth()->user()->id
        ];
        if ($request->filterPendapatan != null and $filter == 'filterdata') {
            $chart_options['group_by_period'] = $request->filterPendapatan;
        } else {
            $chart_options['group_by_period'] = 'day';
        }
        $permintaanChart = new LaravelChart($chart_options);
        // dd($pendapatan);

        $chart_options = [
            'chart_title' => 'Metode Bayar',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Pembayaran',
            'group_by_field' => 'metode_bayar',
            // 'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
        ];
        if ($filter != null and $request->filter != '*' and $filter != 'filterdata') {
            $chart_options['filter_days'] = (int)$request->filter;
        }
        $chart3 = new LaravelChart($chart_options);

        // $feedback = DB::table('feedback')->where('id_mentor', '=', auth()->user()->id)->get();


        $userPermintaan = DB::table('jadwal_ajars')->join('users', 'users.id', '=', 'jadwal_ajars.id_pelajar')->where('jadwal_ajars.id_mentor', '=', auth()->user()->id)->select('users.nama', DB::raw('count(jadwal_ajars.id_pelajar) as total, jadwal_ajars.id_pelajar, sum(jadwal_ajars.durasi) as totalDurasi'))->groupBy('jadwal_ajars.id_pelajar')->orderBy('total', 'desc')->limit(5)->get();

        $userPalingPermintaan = [
            'chart_title' => 'User Paling Banyak Melakukan Permintaan',
            'data' => $userPermintaan,
        ];
        $total_pendapatan = DB::table('pembayarans')->where('id_mentor', auth()->user()->id)->where('status', 'Terverifikasi')->sum('total_bayar');
        $total_mentoring_dilakukan = DB::table('jadwal_ajars')->where('id_mentor', auth()->user()->id)->where('status', 'Done')->count();
        $total_permintaan = DB::table('jadwal_ajars')->where('id_mentor', auth()->user()->id)->count();

        if ($filter == 'filter' and $request->filter != '*') {
            $total_mentoring_dilakukan = DB::table('jadwal_ajars')->where('id_mentor', auth()->user()->id)->where('status', 'Done')->where('created_at', '>', now()->subDays((int)$request->filter)->endOfDay())->count();
            $total_pendapatan = DB::table('pembayarans')->where('id_mentor', auth()->user()->id)->where('status', 'Terverifikasi')->where('created_at', '>', now()->subDays((int)$request->filter)->endOfDay())->sum('total_bayar');
            $total_permintaan = DB::table('jadwal_ajars')->where('id_mentor', auth()->user()->id)->where('created_at', '>', now()->subDays((int)$request->filter)->endOfDay())->count();
        }

        $filterValue = 0;
        if ((int)$request->filter <= 30) {
            $filterValue = $request->filter . ' hari terakhir';
        }
        if ((int)$request->filter > 30) {
            $filterValue = (int)$request->filter / 30 . ' bulan terakhir';
        }
        if ((int)$request->filter == '*') {
            $filterValue = 'Semua Waktu';
        }

        $filterPendapatan = null;
        if ($request->filterPendapatan == 'month') $filterPendapatan = 'Perbulan';
        if ($request->filterPendapatan == 'day') $filterPendapatan = 'Perhari';
        if ($request->filterPendapatan == 'year') $filterPendapatan = 'Pertahun';

        $filter = is_numeric($request->filter) ? $filterValue : null;
        return view('mentor.dashboard', compact('chart1', 'pendapatan', 'chart3', 'total_pendapatan', 'total_mentoring_dilakukan', 'total_permintaan', 'filter', 'filterPendapatan', 'userPalingPermintaan', 'permintaanChart'));
    }


    public function jadwal_ajar()
    {
        $jadwal = Pembayaran::join('users', 'users.id', '=', 'pembayarans.id_user')->join('jadwal_ajars', 'jadwal_ajars.id_pelajar', '=', 'pembayarans.id_user')->where('jadwal_ajars.id_mentor', '=', Auth()->user()->id)->get(['jadwal_ajars.id AS id_jadwal', 'jadwal_ajars.*', 'users.*', 'pembayarans.status AS status_bayar', 'pembayarans.tgl_bayar AS tgl_bayar']);
        // $jadwal = Pembayaran::join('users', 'users.id', '=', 'pembayarans.id_user')->where('pembayarans.id_mentor', '=', Auth()->user()->id)->join('jadwal_ajars', 'jadwal_ajars.id_pelajar', '=', 'users.id')->get();
        $jadwal = $jadwal->unique('id_jadwal');
        // dd($jadwal);
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
        $permintaan_ajar = PermintaanAjar::join('users', 'permintaan_ajars.id_pelajar', '=', 'users.id')->join('bidang_ajars', 'bidang_ajars.id', '=', 'permintaan_ajars.id_bidang')->where('bidang_ajars.id_mentor', '=', auth()->user()->id)->get(['permintaan_ajars.*', 'permintaan_ajars.id as id_permintaan', 'users.*', 'bidang_ajars.*']);

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
            $pembayaran->id_jadwal = $jadwal_ajar->id;
            $pembayaran->id_user = $permintaan_ajar['id_pelajar'];
            $pembayaran->total_bayar = $total_bayar;
            $pembayaran->save();

            $permintaan_ajar->delete();
        });
        alert()->success('Permintaan Berhasil', 'Berhasil menerima permintaan ajar');
        return redirect('mentor/permintaan-ajar');
    }

    public function tolak_permintaan_ajar($id, Request $request)
    {
        $permintaan_ajar = PermintaanAjar::find($id);
        $permintaan_ajar->update([
            'status' => 'ditolak',
            'note' => $request->note,
        ]);

        alert()->success('Permintaan Berhasil', 'Berhasil menerima menolak ajar');
        return redirect('mentor/permintaan-ajar');
    }

    public function update_password(Request $request)
    {
        $mentor = Mentor::find(auth()->user()->id);
        $mentor->update([
            'password' => Hash::make($request->password),
        ]);
        toast('Berhasil mengubah password', 'success', 'top-right');
        return redirect()->back();
    }

    public function update_kelas(Request $request, $id)
    {
        $mentor = BidangAjar::where('id_mentor', '=', auth()->user()->id)->where('id', '=', $id)->get()->first()->first();
        $mentor->update([
            'bidang' => $request->bidang,
            'nama_kelas' => $request->nama_kelas,
            'tarif' => $request->tarif,
            'deskripsi' => $request->deskripsi,
        ]);
        toast('Berhasil mengubah kelas', 'success', 'top-right');
        return redirect()->back();
    }

    public function show_feedback()
    {
        $feedback = Feedback::all();
        return view('mentor/feedback', compact('feedback'));
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
        $mentor = Mentor::find($id);
        $bidang = BidangAjar::where('id_mentor', '=', auth()->user()->id)->get();
        return view('mentor/profile', compact('bidang', 'mentor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $imgName = $request->image;

        if ($request->image) {
            $imgName = $request->image->getClientOriginalName() . '-' . time()
                . '.' . $request->image->extension();
            $mentor = Mentor::find($id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'tgl_lahir' => $request->tgl_lahir,
                'tahun_ngajar' => $request->tahun_ngajar,
                'deskripsi' => $request->deskripsi,
                'gambar' => $imgName,
            ]);

            if ($mentor) {
                $request->image->move(public_path('img/mentor/'), $imgName);
            }
        } else {
            Mentor::find($id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'tgl_lahir' => $request->tgl_lahir,
                'tahun_ngajar' => $request->tahun_ngajar,
                'deskripsi' => $request->deskripsi,
            ]);
        }

        toast('Berhasil mengubah profile anda', 'success', 'top-right');
        return redirect()->back();
    }

    public function check_old_password(Request $request)
    {
        $data = ['message' => 'Called successfully.'];
        return Response::json($data);
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