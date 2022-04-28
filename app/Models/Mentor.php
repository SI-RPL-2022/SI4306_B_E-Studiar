<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Nicolaslopezj\Searchable\SearchableTrait;


class Mentor extends Authenticatable
{
    use HasFactory;
    use SearchableTrait;
    protected $table = 'mentors';
    protected $guarded = [];
    use HasFactory;

    public function getAuthPassword()
    {
        return $this->password;
    }

    protected $searchable = [
        'columns' => [
            'mentors.nama' => 5,
            'bidang_ajars.nama_kelas' => 5,
            'bidang_ajars.bidang' => 5,
        ],
        'joins' => [
            'bidang_ajars' => ['mentors.id', 'bidang_ajars.id_mentor']
        ],
        'groupBy' => 'mentors.id'
    ];
}