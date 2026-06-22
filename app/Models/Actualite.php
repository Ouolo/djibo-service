<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Actualite extends Model
{
    protected $table = 'actualites';

    protected $fillable = [
        'titre',
        'slug',
        'extrait',
        'contenu',
        'image',
        'date_publication',
        'publie',
        'ordre',
    ];

    protected $casts = [
        'publie' => 'boolean',
        'date_publication' => 'date',
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
            if (empty($model->date_publication)) {
                $model->date_publication = now();
            }
        });
    }

    /**
     * Scope: only published articles.
     */
    public function scopePublie($query)
    {
        return $query->where('publie', true)->orderBy('date_publication', 'desc');
    }

    /**
     * Formatted date for display.
     */
    public function getDateFormatteeAttribute(): string
    {
        if (!$this->date_publication)
            return '';

        $mois = [
            1 => 'Janvier',
            2 => 'Février',
            3 => 'Mars',
            4 => 'Avril',
            5 => 'Mai',
            6 => 'Juin',
            7 => 'Juillet',
            8 => 'Août',
            9 => 'Septembre',
            10 => 'Octobre',
            11 => 'Novembre',
            12 => 'Décembre',
        ];

        return $this->date_publication->day . ' ' .
            $mois[$this->date_publication->month] . ' ' .
            $this->date_publication->year;
    }
}
