<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produit extends Model
{
    protected $table = 'produits';

    protected $fillable = [
        'nom',
        'slug',
        'categorie',
        'en_vedette',
        'description_courte',
        'description',
        'avantages',
        'mode_emploi',
        'prix',
        'image',
        'actif',
        'ordre',
        'published_to_facebook',
        'published_at_facebook',
    ];

    protected $casts = [
        'en_vedette' => 'boolean',
        'actif'      => 'boolean',
        'avantages'  => 'array',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nom);
            }
        });
    }

    public function scopeActif($query)
    {
        return $query->where('actif', true)->orderBy('ordre', 'asc')->orderBy('created_at', 'desc');
    }
}
