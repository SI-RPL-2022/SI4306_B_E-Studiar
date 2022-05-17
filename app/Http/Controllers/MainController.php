<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function index()
    {
        ///
    }

    public function pencarian_guru()
    {
        $list_guru = Mentor::join('bidang_ajars', 'mentors.id', '=', 'bidang_ajars.id_mentor')->get(['mentors.*', 'bidang_ajars.id AS id_bidang', 'bidang_ajars.*']);
        return view('pencarianguru',  compact('list_guru'));
    }

    public function filter_guru(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'keyword' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     toast('Masukan keyword pencarian!', 'error', 'top-right');
        //     return redirect()->back();
        // }

        $min_year = $request->min_year;
        $max_year = $request->max_year;
        $price_from = (int)$request->price_from;
        $price_to = $request->price_to;

        $keyword = $request->keyword;
        $price = '';

        if ((int) $min_year > (int)$max_year) {
            toast('Max tahun harus lebih besar dari min tahun', 'error', 'top-right');
            return redirect('/pencarianguru');
        }

        if ((int) $price_from > (int)$price_to) {
            toast('Tarif minimal harus lebih kecil dari tarif maksimal', 'error', 'top-right');
            return redirect('/pencarianguru');
        }

        if ((int)$price_to < 1 or !$price_to) {
            if ((int)$max_year > 0) {
                $list_guru = Mentor::join('bidang_ajars as bidang', 'mentors.id', '=', 'bidang.id_mentor')->search($keyword)->whereBetween('tahun_ngajar', [$min_year, $max_year])->get(['mentors.*', 'bidang.id AS id_bidang', 'bidang.*']);
            } else {
                $list_guru = Mentor::join('bidang_ajars as bidang', 'mentors.id', '=', 'bidang.id_mentor')->search($keyword)->get(['mentors.*', 'bidang.id AS id_bidang', 'bidang.*']);
            }
        } else {
            $price = rupiah($price_from) . ' - ' . rupiah($price_to);
            if ((int)$max_year > 0) {
                $list_guru = Mentor::join('bidang_ajars as bidang', 'mentors.id', '=', 'bidang.id_mentor')->search($keyword)->whereBetween('tarif', [$price_from, $price_to])->whereBetween('tahun_ngajar', [$min_year, $max_year])->get(['mentors.*', 'bidang.id AS id_bidang', 'bidang.*']);
            } else {
                $list_guru = Mentor::join('bidang_ajars as bidang', 'mentors.id', '=', 'bidang.id_mentor')->search($keyword)->whereBetween('tarif', [$price_from, $price_to])->get(['mentors.*', 'bidang.id AS id_bidang', 'bidang.*']);
            }
        }

        $data_guru = Mentor::join('bidang_ajars as bidang', 'mentors.id', '=', 'bidang.id_mentor')->get(['mentors.*', 'bidang.id AS id_bidang', 'bidang.*']);

        return view('pencarianguru',  compact('list_guru', 'keyword', 'price', 'price_from', 'price_to', 'min_year', 'max_year', 'data_guru', 'calon_mentors'));
    }
}
