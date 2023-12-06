<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Article extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Les attributs qui peuvent être assignés massivement.
     *
     * @var array<string>
     */
    protected $fillable = ['titre', 'contenu', 'categorie', 'image','imageUrl', 'user_id','is_published'];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'user_id' => 'integer',
        // Ajoutez d'autres casts ici si nécessaire, par exemple:
        // 'published_at' => 'datetime',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }


  
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}