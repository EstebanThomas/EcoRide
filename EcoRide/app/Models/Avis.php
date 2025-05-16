<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Avis extends Model
{
    public $timestamps = false; //delete values 'update_at' and 'created_at' use as default by laravel when push from's data into database

    use HasFactory;

    protected $table = 'avis'; //Name of the table

    protected $primaryKey = 'avis_id'; //Name Of the Primary Key

    protected $fillable = [
        'commentaire',
        'note',
        'statut',
        'good_trip',
        'covoiturage_id',
        'utilisateur_id',

    ];

    //Get foreign key 'utilisateur_id'
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateurs::class, 'utilisateur_id');
    }

    //Get foreign key 'covoiturage_id'
    public function covoiturage()
    {
        return $this->belongsTo(Covoiturage::class, 'covoiturage_id');
    }
}