<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = [""];
    protected $with = ["realm", "artifact"];

    public function realm() {
        return $this->belongsTo(Realm::class);
    }
    public function artifact() {
        return $this->belongsToMany(Artifact::class)->withTimestamps();
    }
}
