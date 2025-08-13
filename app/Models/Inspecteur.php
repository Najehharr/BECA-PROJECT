<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Inspecteur extends Authenticatable
{
    // Specify the table name if it's not the plural form "inspecteurs"
    protected $table = 'inspecteur';

    // Allow mass assignment for these fields
    protected $fillable = [
        'nom',
        'mission',
        'email',
        'motpasse'
    ];

    // Disable timestamps if your table doesn't have created_at and updated_at
    public $timestamps = false;

    public function getAuthIdentifierName()
    {
        return 'email';
    }

    public function getAuthPassword()
{
    return $this->motpasse;
}
}
