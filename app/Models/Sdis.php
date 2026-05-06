<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sdis extends Model
{
    use HasFactory;
    protected $fillable = ["name", "departement"];
    protected $table = 'sdis';

    public function firestation(){
        return $this->belongsTo(Firestation::class);
    }
}
