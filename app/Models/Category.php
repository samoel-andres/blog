<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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

    // Relation one - many (category-article)
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // use slug instead of id
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
