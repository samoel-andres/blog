<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
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

    // Relation one - many (inverse) (article-user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation one - many (article-comment)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relation one - many (inverse) (article-category)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * use slug instead of id
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
