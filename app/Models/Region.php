<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ["name"];

    public function realms() {
        return $this->hasMany(Realm::class);
    }

    public function creature() {
        return $this->hasMany(Creature::class);
    }

}
