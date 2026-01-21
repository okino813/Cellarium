<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Firestation extends Model
{
    use HasFactory;
    protected $table = 'firestations';
    protected $fillable = ['city', 'postal_code', 'code'];

    public function admins(): HasMany
    {
        return $this->hasMany(Admin::class);
    }

    public function sources(): HasMany{
        return $this->hasMany(Source::class);
    }
}
