<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Utilisateurs as Authenticatable;

class Utilisateurs extends Model
{
    public $timestamps = false; //delete values 'update_at' and 'created_at' use as default by laravel when push from's data into database

    use HasFactory;

    protected $fillable = [
        'pseudo',
        'email',
        'password',
        'nom',
        'prenom',
        'telephone',
        'adresse',
        'date_naissance',
        'photo',
    ];
}
