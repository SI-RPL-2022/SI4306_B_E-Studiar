<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\BidangAjar;
use App\Models\Feedback;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
    public function detailMentor($id)
    {
        // $detailMentor = DB::table('mentors')->where('id', $id)->get();
        $detailMentor = Mentor::find($id);
        $bidang = BidangAjar::orderBy('bidang')->where('id_mentor', $detailMentor->id)->first();

        $feedback = Feedback::where('id_mentor', '=', $detailMentor->id)->get();
        $jumlahRating = DB::table('feedback')->where('id_mentor', '=', $detailMentor->id)->sum('rating');
        $totalRating = DB::table('feedback')->where('id_mentor', '=', $detailMentor->id)->count();
        $ratingMedian = 0;

        if ($jumlahRating > 0) {
            $ratingMedian = $jumlahRating / $totalRating;
        }

        return view('user/detailMentor', compact('detailMentor', 'bidang', 'feedback', 'ratingMedian', 'totalRating'));
    }
}