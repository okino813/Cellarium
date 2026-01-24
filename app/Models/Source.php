<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $fillable = ['name', 'firestation_id'];
    //
    public function items(){
        return $this->belongsToMany(Item::class, 'containing_item')
            ->withPivot('qty_affect');
    }

    public function containings(){
        return $this->hasMany(Containing::class);
    }


    public function firestation(){
        return $this->belongsTo(Firestation::class);
    }
}
