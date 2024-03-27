<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $guarded = [
];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function services() {
        return $this->belongsToMany(Service::class);
    }

    public function sponsors() {
        return $this->belongsToMany(Sponsor::class);
    }

    public function views()
    {
         return $this->hasMany(View::class);
    }

    public function contacts()
    {
         return $this->hasMany(Contact::class);
    }

}
