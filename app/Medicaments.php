<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicaments extends Model
{
    protected $fillable = ['nomMedicament'];


    public function traitements(){
        return $this->hasMany('App\Traitements', 'medicament_id');
    }
}
