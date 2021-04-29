<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
    use HasFactory;

    public function kindManagers() {
        return $this->hasMany('App\Models\Manager', 'kind_id', 'id');
    }

    public function kindAnimals() {
        return $this->hasMany('App\Models\Animal', 'kind_id', 'id');
    }

}
