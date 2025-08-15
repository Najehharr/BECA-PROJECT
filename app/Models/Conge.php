<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    use HasFactory;

    protected $table = 'conges';
    protected $primaryKey = 'id';
    public $timestamps = false; // disable if your table has no created_at/updated_at

    protected $fillable = [
        'nom_inspecteur',
        'duree_conge',
        'matricule',
        'date_debut',
        'statut'
    ];
}
