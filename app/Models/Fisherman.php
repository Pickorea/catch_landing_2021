<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fisherman extends Model
{
    use HasFactory;

    protected $table ='fishermans';

    protected $fillable = ['island_id','first_name','last_name'];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required|string|unique:fishermans|max:191',
        'last_name' => 'required|string|unique:fishermans|max:191',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function island()
    {
        return $this->belongsTo(Island::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
