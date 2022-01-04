<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{

    use HasFactory;

    protected $fillable = ['name', 'description', 'status'];

    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
