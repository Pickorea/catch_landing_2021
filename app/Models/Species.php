<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    use HasFactory;

    protected $table = 'species';

    protected $fillable = ['species_name'];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'species_name' => 'required|string|unique:species|max:191',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'species_trip')->withPivot('weight');
    }
}
