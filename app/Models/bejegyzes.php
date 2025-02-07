<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bejegyzes extends Model
{
    protected $table = "bejegyzesek";
    protected $fillable = ["gyakorlat", "ismetlesszam"];
}
