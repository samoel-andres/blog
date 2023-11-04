<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * Propiedades que no queremos que se asignen masivamente.
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    // Relation one - one (inverse) (profile-user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
