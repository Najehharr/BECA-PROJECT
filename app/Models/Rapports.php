<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Rapports extends Model
{
    use HasFactory;

    protected $table = 'rapports';

    public $timestamps = false;

    protected $fillable = ['rapport', 'date'];
}
