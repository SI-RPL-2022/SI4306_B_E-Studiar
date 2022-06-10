<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

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
    public function index()
    {
        // $chart_options = [
        //     'chart_title' => 'Transactions by dates',
        //     'report_type' => 'group_by_date',
        //     'model' => 'App\Models\Pembayaran',
        //     'group_by_field' => 'created_at',
        //     'group_by_period' => 'day',
        //     'aggregate_function' => 'sum',
        //     'aggregate_field' => 'amount',
        //     'chart_type' => 'line',
        // ];

        $chart_options = [
            'chart_title' => 'Bidang Ajar',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\BidangAjar',
            'group_by_field' => 'bidang',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            // 'filter_period' => 'month', // show users only registered this month
        ];
        $chart1 = new LaravelChart($chart_options);
        // dd($chart1);

        $chart_options = [
            'chart_title' => 'Pendapatan',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Pembayaran',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'total_bayar',
            'chart_type' => 'line',
        ];

        $pendapatan = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Metode Bayar',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Pembayaran',
            'group_by_field' => 'metode_bayar',
            // 'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            // 'filter_days' => 30, // show only last 30 days
        ];

        $chart3 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Pendapatan',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Pembayaran',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'total_bayar',
            'chart_type' => 'line',
        ];

        // $pendapatan = new LaravelChart($chart_options);

        return view('admin.index', compact('chart1', 'pendapatan', 'chart3'));
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
        return redirect('/admin/pembayaran');
    }

    public function tolak_pembayaran($id)
    {
        $bayar = Pembayaran::find($id);
        $bayar->update([
            'status' => 'Ditolak',
        ]);
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