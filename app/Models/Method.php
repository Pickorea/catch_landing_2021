<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;

    protected $table ='methods';

    protected $fillable = ['method_name'];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'method_name' => 'required|string|unique:methods|max:191',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
