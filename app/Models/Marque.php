<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Marque extends Model
{
    public $timestamps = false; //delete values 'update_at' and 'created_at' use as default by laravel when push from's data into database

    use HasFactory;

    protected $table = 'Marque'; //Name of the table

    protected $primaryKey = 'marque_id'; //Name Of the Primary Key

    protected $fillable = [
        'libelle',
    ];
}