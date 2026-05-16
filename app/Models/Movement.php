<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $fillable = ['user_id', 'comment', 'created_at', 'updated_at'];
    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_movement')
            ->withPivot('operation');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
