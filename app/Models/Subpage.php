<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subpage extends Model
{
    use HasFactory;

    /**
     * Return the page for this subpages
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo 
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

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

    /**
     * Get the contents for this page.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany 
     */
    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }
}
