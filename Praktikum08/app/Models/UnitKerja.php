<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    // kolong yg wajib diisi
    protected $fillable = ["kode", "nama"]; 
}
