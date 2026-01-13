<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artifact extends Model
{
    protected $fillable = ["name", "type", "power_level", "description"];
    protected $with = ["originRealm", "hero"];

    public function originRealm() {
        return $this->belongsTo(Realm::class);
    }
    public function hero() {
        return $this->belongsToMany(Artifact::class)->withTimestamps();
    }
}
