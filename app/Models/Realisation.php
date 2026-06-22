<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Realisation extends Model
{
    protected $table = 'realisations';

    protected $fillable = [
        'titre',
        'slug',
        'localisation',
        'impact',
        'description',
        'image',
        'date_projet',
        'actif',
        'ordre',
    ];

    protected $casts = [
        'actif'       => 'boolean',
        'date_projet' => 'date',
        'ordre'       => 'integer',
    ];

    /**
     * Auto-generate slug from titre before saving.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->titre);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('titre')) {
                $model->slug = Str::slug($model->titre);
            }
        });
    }

    /**
     * Scope: only active realisations, ordered.
     */
    public function scopeActif($query)
    {
        return $query->where('actif', true)->orderBy('ordre')->orderByDesc('date_projet');
    }
}
