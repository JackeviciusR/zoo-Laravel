<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    public function animalManager() {
        return $this->belongsTo('App\Models\Manager', 'manager_id', 'id');
    }

    public function animalKind() {
        return $this->belongsTo('App\Models\Kind', 'kind_id', 'id');
    }

}
