<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $table = 'absence';
    public $timestamps = false;

    protected $fillable = ['pourcentage', 'jours', 'total_abs', 'nb_abs'];
}