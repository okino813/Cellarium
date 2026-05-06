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

    public function containings(): HasMany{
        return $this->hasMany(Containing::class);
    }


    public function items(): HasMany{
        return $this->hasMany(Item::class);
    }

    public function adminsdis(): HasMany{
        return $this->hasMany(AdminSdis::class);
    }

    public function sdis(): HasMany{
        return $this->hasMany(Sdis::class);
    }
}
