<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Containing extends Model
{
    public function items(){
        return $this->belongsToMany(Item::class, 'containing_item')
            ->withPivot('qty_affect');
    }

    public function source(){
        return $this->belongsTo(Source::class);
    }

}
