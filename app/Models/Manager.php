<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Manager extends Model
{
    use HasFactory;

    public function managerKind() {
        return $this->belongsTo('App\Models\Kind', 'kind_id', 'id');
    }

    public function managerAnimals() {
        return $this->hasMany('App\Models\Animal', 'manager_id', 'id');
    }

}
