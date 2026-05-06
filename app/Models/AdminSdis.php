<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSdis extends Model
{
    use HasFactory;
    protected $table = 'adminsdis';
    protected $fillable = ['password', 'email', 'firstname', 'lastname'];

    public function firestation(){
        return $this->belongsTo(Firestation::class);
    }

}
