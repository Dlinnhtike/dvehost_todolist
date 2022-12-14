<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $table = "record";
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
