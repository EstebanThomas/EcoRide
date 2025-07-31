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
        'credits',
        'suspendu',
        'role_id',
    ];

    public function covoiturages()
    {
        return $this->hasMany(Covoiturage::class, 'utilisateur_id');
    }

    public function voitures()
    {
        return $this->hasMany(Voiture::class, 'utilisateur_id');
    }

    public function preferences()
    {
        return $this->hasOne(Preferences::class, 'utilisateur_id');
    }

    public function avis()
    {
        return $this->hasMany(Avis::class, 'utilisateur_id');
    }

        public function roles()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }
}
