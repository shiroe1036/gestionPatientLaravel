<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maladies extends Model
{
    protected $fillable = ['nomMaladie'];

    public function traitements(){
        return $this->hasMany('App\Traitements', 'maladie_id');
    }
}
