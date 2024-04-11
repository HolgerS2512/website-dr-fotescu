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
     * Get the attributes that should be cast.
     *
     * @return array<bool>
     */
    protected $casts = [
        'subpages' => 'boolean',
        'created_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'subpages'
    ];

    /**
     * Get a subpage collection for this page.
     * 
     * @return Collection|null
     */
    public function getSubpagesAttribute()
    {
        return $this->subpages()->orderBy('ranking')->get();
    }

    /**
     * Get the subpages for this page.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subpages(): HasMany
    {
        return $this->hasMany(Subpage::class);
    }

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
