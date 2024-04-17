<?php

namespace App\Models;

use App\Models\Lang\DE_Content;
use App\Models\Lang\DE_List;
use App\Models\Lang\EN_Content;
use App\Models\Lang\EN_List;
use App\Models\Lang\RU_Content;
use App\Models\Lang\RU_List;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Content extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Return the page for the content
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo 
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Get the translation for this content.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function de(): HasMany
    {
        return $this->hasMany(DE_Content::class);
    }

    /**
     * Get the translation for this content.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function en(): HasMany
    {
        return $this->hasMany(EN_Content::class);
    }

    /**
     * Get the translation for this content.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ru(): HasMany
    {
        return $this->hasMany(RU_Content::class);
    }

    /**
     * Get the translation for this content list.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deList(): HasMany
    {
        return $this->hasMany(DE_List::class);
    }

    /**
     * Get the translation for this content list.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enList(): HasMany
    {
        return $this->hasMany(EN_List::class);
    }

    /**
     * Get the translation for this content list.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ruList(): HasMany
    {
        return $this->hasMany(RU_List::class);
    }

    /**
     * Called image for this instance
     * 
     * @return \App\Models\Image
     */
    public function image()
    {
        return Image::all()->where('id', $this->image_id)->first();
    }
}
