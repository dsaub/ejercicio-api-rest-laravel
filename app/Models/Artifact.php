<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artifact extends Model
{
    protected $fillable = ["name", "type", "power_level", "description", "origin_realm_id"];
    protected $with = ["originRealm"];

    public function originRealm() {
        return $this->belongsTo(Realm::class);
    }
    public function heroes() {
        return $this->belongsToMany(Hero::class)->withTimestamps();
    }
}
