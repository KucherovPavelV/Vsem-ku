<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'places';
    protected $guarded = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_places', 'place_id', 'user_id');
    }
}
