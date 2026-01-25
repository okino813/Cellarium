<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $fillable = ['firstname', 'comment'];
    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_movement')
            ->withPivot('operation');
    }
}
