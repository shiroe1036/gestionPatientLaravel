<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'tel',
        'email',
        'adresse',
        'typePatient',
        'age',
        'cin',
        'etatPatient',
        'user_id'
    ];

    public function urgence(){
        return $this->hasOne('App\Urgences', 'patient_id');
    }

    public function dossiers(){
        return $this->hasMany('App\DossierPatients', 'patient_id')->orderBy('id', 'desc');
    }

    public function traitements(){
        return $this->hasMany('App\Traitements')->dossiers();
    }
}
