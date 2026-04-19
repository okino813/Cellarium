<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $fillable = ['firstname', 'comment', 'created_at', 'updated_at'];
    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_movement')
            ->withPivot('operation');
    }
}
