<?php

namespace App\Models;

use App\Traits\WebpageModelMethods;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

class Page extends Model
{
    use WebpageModelMethods;

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
        'any_pages' => 'boolean',
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
    public function getSubpagesAttribute(): Collection|null
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
}
