<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fisherman extends Model
{
    use HasFactory;

    protected $table ='fishermans';

    protected $fillable = ['island_id','first_name','last_name'];

    public function island()
    {
        return $this->belongsTo(Island::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
