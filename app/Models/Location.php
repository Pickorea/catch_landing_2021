<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table ='locations';

    protected $fillable = ['location_name'];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'location_name' => 'required|string|unique:locations|max:191',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function trip()
    {
        return $this->hasOne(Trip::class);
    }
}
