<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\BidangAjar;
use App\Models\Mentor;
use Illuminate\Http\Request;
use DB;

class DetailController extends Controller
{
    public function detailMentor($id)
    {
        // $detailMentor = DB::table('mentors')->where('id', $id)->get();
        $detailMentor = Mentor::find($id);
        $bidang = BidangAjar::orderBy('bidang')->where('id_mentor', $detailMentor->id)->first();
        return view('user/detailMentor', compact('detailMentor', 'bidang'));
    }
}