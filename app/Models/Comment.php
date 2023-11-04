<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
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

    // Relation one - many (inverse) (comment-user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation one - many (inverse) (comment-article)
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
