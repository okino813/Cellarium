<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $fillable = ['id','name', 'firestation_id'];
    //
    public function containings(){
        return $this->hasMany(Containing::class);
    }


    public function firestation(){
        return $this->belongsTo(Firestation::class);
    }
}
