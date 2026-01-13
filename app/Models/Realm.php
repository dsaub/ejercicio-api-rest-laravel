<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realm extends Model
{
    protected $fillable = ["name", "ruler", "alignment"];
    protected $with = ["region"];
    
    public function region() {
        return $this->belongsTo(Region::class);
    }

    public function hero() {
        return $this->hasMany(Hero::class);
    }

    public function artifact() {
        return $this->hasMany(Artifact::class);
    }
}
