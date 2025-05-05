<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Voiture extends Model
{
    public $timestamps = false; //delete values 'update_at' and 'created_at' use as default by laravel when push from's data into database

    use HasFactory;

    protected $table = 'voiture'; //Name of the table into mySQL

    protected $primaryKey = 'voiture_id'; //Name Of the Primary Key

    protected $fillable = [
        'modele',
        'immatriculation',
        'date_premiere_immatriculation',
        'couleur',
        'energie',
        'utilisateur_id',
        'marque_id',
    ];

    //Get foreign key 'utilisateur_id'
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateurs::class, 'utilisateur_id');
    }
}