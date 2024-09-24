<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutputTemporary extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false; // Disable timestamps for this model
}
