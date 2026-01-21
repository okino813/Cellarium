<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_movements')
            ->withPivot('operation');
    }
}
