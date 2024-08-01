<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public $timestamps = false;
	protected $table = 'songs';
	protected $fillable = ['name', 'singer'];
}
