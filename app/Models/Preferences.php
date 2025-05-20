<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Preferences extends Model
{
    public $timestamps = false; //delete values 'update_at' and 'created_at' use as default by laravel when push from's data into database

    use HasFactory;

    protected $table = 'preferences'; //Name of the table

    protected $primaryKey = 'preferences_id'; //Name Of the Primary Key

    protected $fillable = [
        'fumeur',
        'animaux',
        'propres_preferences',
        'utilisateur_id',
    ];

    //Get foreign key 'utilisateur_id'
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateurs::class, 'utilisateur_id');
    }
}