<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function containings(){
        return $this->belongsToMany(Containing::class, 'containing_item')
            ->withPivot('qty_affect');
    }

    public function movements(){
        return $this->belongsToMany(Movement::class, 'item_movement')
            ->withPivot('operation');
    }
}
