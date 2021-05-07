<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * @method static first()
 * @method static where(string $string, string $string1 , mixed $type)
 */
class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function articles(): HasMany
    {
        return $this->hasMany('App\Models\Article');
    }
}
