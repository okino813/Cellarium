<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public function firestations(){
        return $this->belongsTo(Firestation::class);
    }
}
