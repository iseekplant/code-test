<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeForEmail($query, $email)
    {
        return $query->where('contact_email', 'like', '%' . $email . '%');
    }
}
