<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;


class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $filter = null)
    {
        // dd($chartType);
        // $filterData = $request->filter == '*';

        $chart_options = [
            'chart_title' => 'Bidang Ajar',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\BidangAjar',
            'group_by_field' => 'bidang',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            // 'filter_period' => 'month', // show users only registered this month
        ];
        if ($filter != null and $request->filter != '*' and $filter != 'filterPendapatan') {
            $chart_options['filter_days'] = (int)$request->filter;
        }
        $chart1 = new LaravelChart($chart_options);
        // dd($chart1);

        $chart_options = [
            'chart_title' => 'Pendapatan',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Pembayaran',
            'group_by_field' => 'created_at',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'total_bayar',
            'chart_type' => 'line',
        ];
        if ($request->filterPendapatan != null and $filter == 'filterPendapatan') {
            $chart_options['group_by_period'] = $request->filterPendapatan;
        } else {
            $chart_options['group_by_period'] = 'day';
        }
        $pendapatan = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Metode Bayar',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Pembayaran',
            'group_by_field' => 'metode_bayar',
            // 'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
        ];
        if ($filter != null and $request->filter != '*' and $filter != 'filterPendapatan') {
            $chart_options['filter_days'] = (int)$request->filter;
        }
        $chart3 = new LaravelChart($chart_options);

        $total_mentor = DB::table('mentors')->count();
        $total_murid = DB::table('users')->count();
        $total_pendapatan = DB::table('pembayarans')->where('status', 'Terverifikasi')->sum('total_bayar');
        $total_transaksi = DB::table('pembayarans')->where('status', 'Terverifikasi')->count();

        if ($filter == 'filter' and $request->filter != '*') {
            $total_mentor = DB::table('mentors')->where('created_at', '>', now()->subDays((int)$request->filter)->endOfDay())->count();
            $total_murid = DB::table('users')->where('created_at', '>', now()->subDays((int)$request->filter)->endOfDay())->count();
            $total_pendapatan = DB::table('pembayarans')->where('status', 'Terverifikasi')->where('created_at', '>', now()->subDays((int)$request->filter)->endOfDay())->sum('total_bayar');
            $total_transaksi = DB::table('pembayarans')->where('status', 'Terverifikasi')->where('created_at', '>', now()->subDays((int)$request->filter)->endOfDay())->count();
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

        $transaksi = Pembayaran::all();

        return view('admin.index', compact('chart1', 'pendapatan', 'chart3', 'total_transaksi', 'total_pendapatan', 'total_murid', 'total_mentor', 'filter', 'filterPendapatan', 'transaksi'));
        
    }

    public function data_pembayaran()
    {
        $pembayaran = Pembayaran::join('users', 'users.id', '=', 'pembayarans.id_user')->where('pembayarans.status', 'Menunggu Verifikasi')->get(['pembayarans.*', 'users.nama as nama_user']);
        return view('admin.pembayaran', compact('pembayaran'));
    }

    public function terima_pembayaran($id)
    {
        $bayar = Pembayaran::find($id);
        $bayar->update([
            'status' => 'Terverifikasi',
        ]);

        alert()->success('Verifikasi Berhasil', 'Berhasil memverifikasi transaksi pembayaran');
        return redirect('/admin/pembayaran');
    }

    public function tolak_pembayaran($id)
    {
        $bayar = Pembayaran::find($id);
        $bayar->update([
            'status' => 'Ditolak',
        ]);
        alert()->success('Verifikasi Berhasil', 'Berhasil menolak transaksi pembayaran');
        return redirect('/admin/pembayaran');
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