<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traitements extends Model
{
    protected $fillable = [
        'user_id', 'medicament_id', 'maladie_id', 'dossier_patient_id'
    ];

    public function dossierPatient(){
        return $this->belongsTo('App\DossierPatients');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function medicament(){
        return $this->belongsTo('App\Medicaments');
    }

    public function maladie(){
        return $this->belongsTo('App\Maladies');
    }
}
