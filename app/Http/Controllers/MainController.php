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
        $validator = Validator::make($request->all(), [
            'keyword' => 'required',
        ]);

        if ($validator->fails()) {
            toast('Masukan keyword pencarian!', 'error', 'top-right');
            return redirect()->back();
        }

        $keyword = $request->keyword;
        $price = '500000';
        $list_guru = Mentor::join('bidang_ajars as bidang', 'mentors.id', '=', 'bidang.id_mentor')->search($keyword)->get(['mentors.*', 'bidang.id AS id_bidang', 'bidang.*']);
        return view('pencarianguru',  compact('list_guru', 'keyword', 'price'));
    }
}