<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * @method static where(string $string, string $string1 , mixed $type)
 * @method static orderBy(string $string, string $string1)
 */
class Article extends Model
{

    use HasFactory;

//    protected $connection = 'data';
    protected $table = 'articles';
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $hidden = ['category_id', 'redacteur_id', 'updated_at', 'created_at'];

    protected $appends = ['categorie', 'redacteur'];


    public function category(): BelongsTo
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function redacteur(): BelongsTo
    {
        return $this->belongsTo('App\Models\Redacteur');
    }

    public function getCategorieAttribute(): String
    {
        return $this->category()->value('libelle');
    }

    public function getRedacteurAttribute(): String
    {
        $prenom = $this->redacteur()->value('prenom');
        $nom = $this->redacteur()->value('nom');
        return $prenom . ' ' .  $nom;
    }
}
