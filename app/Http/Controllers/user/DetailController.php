<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DetailController extends Controller
{
    public function detailMentor($id)
    {   
        $detailMentor = DB::table('mentors')->where('id', $id)->get();
        return view('user/detailMentor', compact('detailMentor'));
    }
}
