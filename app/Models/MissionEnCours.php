<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionEnCours extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'missions_en_cours';

    public $timestamps = false;

    protected $fillable = ['missions','client','lieu','utilisateurs','status', 'datedebut','datefin','duree','jours','accepte'];
}

