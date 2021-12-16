<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table ='books'; //use name table in database
    //insert data to column 
    protected $fillable  =[ 
        'nama',
        'jenis_buku',
        'deskripsi',
        'penerbit',
    ];
}
