<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Covoiturage extends Model
{
    public $timestamps = false; //delete values 'update_at' and 'created_at' use as default by laravel when push from's data into database

    use HasFactory;

    protected $table = 'covoiturage'; //Name of the table

    protected $primaryKey = 'covoiturage_id'; //Name Of the Primary Key

    protected $casts = ['participants' => 'array',];

    protected $fillable = [
        'date_depart',
        'heure_depart',
        'lieu_depart',
        'date_arrivee',
        'heure_arrivee',
        'lieu_arrivee',
        'statut',
        'nb_place',
        'prix_personne',
        'participants',
        'utilisateur_id',
        'voiture_id',
        'preferences_id',
    ];

        //Get foreign key 'utilisateur_id'
        public function utilisateur()
        {
            return $this->belongsTo(Utilisateurs::class, 'utilisateur_id');
        }
    
        //Get foreign key 'voiture_id'
        public function voiture()
        {
            return $this->belongsTo(Voiture::class, 'voiture_id');
        }

        //Get foreign key 'voiture_id'
        public function preferences()
        {
            return $this->belongsTo(Preferences::class, 'preferences_id');
        }

        public function participantsList()
        {
            return $this->belongsToMany(Utilisateurs::class, 'utilisateurs', 'utilisateur_id')
                ->whereIn('utilisateur_id', json_decode($this->participants ?? '[]', true));
        }

                //Get foreign key 'voiture_id'
        public function avis()
        {
            return $this->hasMany(Avis::class, 'covoiturage_id');
        }
}