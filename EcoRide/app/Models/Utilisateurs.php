<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Utilisateurs extends Authenticatable
{
    public $timestamps = false; //delete values 'update_at' and 'created_at' use as default by laravel when push from's data into database

    use HasFactory;

    protected $table = 'utilisateurs';//Name of the table

    protected $tableVoiture = 'voiture';

    protected $primaryKey = 'utilisateur_id'; //Name Of the Primary Key

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
        'modele',
        'immatriculation',
        'datePremiereImmatriculation',
        'couleur',
        'energie',
    ];
}
