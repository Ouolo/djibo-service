<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temoignage extends Model
{
    use HasFactory;

    protected $table = 'temoignages';

    protected $fillable = [
        'nom_client',
        'role',
        'localisation',
        'type', // 'text', 'image', 'video'
        'contenu', // texte du témoignage
        'media', // chemin vers image/video
        'avant', // situation avant
        'apres', // situation après
        'publie',
        'ordre'
    ];

    protected $casts = [
        'publie' => 'boolean',
        'ordre' => 'integer',
    ];

    /**
     * Scopes
     */
    public function scopePublie($query)
    {
        return $query->where('publie', true);
    }

    public function scopeOrdre($query)
    {
        return $query->orderBy('ordre', 'asc')->orderBy('created_at', 'desc');
    }

    /**
     * Accessors
     */
    public function getMediaUrlAttribute()
    {
        if (!$this->media) {
            return null;
        }

        if (str_starts_with($this->media, 'assets/') || str_starts_with($this->media, 'http')) {
            return $this->media;
        }

        return 'storage/' . $this->media;
    }

    public function getImageUrlAttribute()
    {
        if ($this->type === 'image') {
            return $this->media_url;
        }
        return null;
    }

    public function getVideoUrlAttribute()
    {
        if ($this->type === 'video') {
            return $this->media_url;
        }
        return null;
    }

    public function getTypeDisplayAttribute()
    {
        $types = [
            'text' => '📝 Texte',
            'image' => '🖼️ Image',
            'video' => '🎬 Vidéo'
        ];
        return $types[$this->type] ?? $this->type;
    }
}
