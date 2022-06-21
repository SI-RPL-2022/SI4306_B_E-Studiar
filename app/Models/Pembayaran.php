<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mentor;
use App\Models\User;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayarans';
    protected $guarded = [];

    public function mentors()
    {
        return $this->belongsTo(Mentor::class, 'id_mentor', 'id');
    }
    
    public function users()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}