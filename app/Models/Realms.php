<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realms extends Model
{
    protected $fillable = ["name", "ruler", "alignment"];
    
    public function Region() {
        return $this->belongsTo(Region::class);
    }
}
