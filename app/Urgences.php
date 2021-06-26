<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urgences extends Model
{
    protected $fillable = [
        'dateAdmission', 'motifAdmission', 'dateSortieUrgence', 'motifSoriteUrgence', 'patient_id', 'dateSortieHopital', 'motifSortieHopital', 'dateDece', 'motifDece'
    ];

    public function patient(){
        return $this->belongsTo('App\Patients');
    }
}
