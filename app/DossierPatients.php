<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DossierPatients extends Model
{
    protected $fillable = [
        'observation', 'dateDebut', 'dateFin', 'patient_id', 'analyseBacteriologique', 'analyseChimique'
    ];

    public function patients(){
        return $this->belongsTo('App\Patients');
    }

    public function imageDossier(){
        return $this->hasMany('App\ImageDossiers', 'dossier_patient_id');
    }

    public function users(){
        return $this->belongsToMany('App\User', 'traitements', 'dossier_patient_id', 'user_id');
    }
}
