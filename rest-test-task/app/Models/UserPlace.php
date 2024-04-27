<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlace extends Model
{
    use HasFactory;
    protected $table = 'user_places';
    protected $guarded = false;

    public function places()
    {
        return $this->belongsTo(Place::class, 'place_id', 'id', 'user_places');
    }
}
