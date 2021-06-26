<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageDossiers extends Model
{
    protected $fillable = [
        'radio', 'scanner', 'dossier_patient_id', 'interpretation'
    ];

    public function dossierPatient(){
        return $this->belongsTo('App\DossierPatients');
    }
}
