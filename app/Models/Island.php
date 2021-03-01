<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Island extends Model
{
    use HasFactory;

    protected $table ='islands';

    protected $fillable = ['island_name'];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'island_name' => 'required|string|unique:islands|max:191',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function fisherman()
    {
        return $this->hasMany(Fisherman::class);
    }
}
