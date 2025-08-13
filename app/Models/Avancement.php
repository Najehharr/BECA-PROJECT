<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avancement extends Model
{
    use HasFactory;

    protected $table = 'avancement';
    public $timestamps = false;

    protected $fillable = ['pourcentage', 'jours'];
}

