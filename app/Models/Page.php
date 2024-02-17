<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the images for this page.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
    /**
     * Get the publish for this page.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany 
     */
    public function publishes(): HasMany
    {
        return $this->hasMany(Publish::class);
    }
}
