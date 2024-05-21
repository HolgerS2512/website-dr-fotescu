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
use PhpParser\ErrorHandler\Collecting;

class Content extends Model
{
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<bool>
     */
    protected $casts = [
        'layout' => 'boolean',
    ];

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
    public function image(): Image|null
    {
        return Image::where('id', $this->image_id)->first();
    }

    /**
     * Called image for special format
     * 
     * @return string
     */
    public function getFormatSrc(): string
    {
        return asset("assets/img/formats/$this->format.jpg");
    }

    /**
     * Called post collection for this instance
     * 
     * @return Collection<App\Models\Post>|null
     */
    public function publicPosts()
    {
        return $this->showPosts()->where('public', true);
    }

    /**
     * Called all posts collection for this instance
     * 
     * @return Collection<App\Models\Post>|null
     */
    public function showPosts()
    {
        return Post::all()->sortBy('ranking');
    }

    /**
     * Find the post for this instance
     * 
     * @return \App\Models\Post|null
     */
    public function findPost()
    {
        return Post::where('content_id', $this->id)->firstOrFail();
    }

    /**
     * Get ranking for new instance
     * 
     * @return void
     */
    public function setRanking()
    {
        $counter = Content::where('page_id', $this->page_id);
        if ($this->subpage_id) {
            $counter = $counter->where('subpage_id', $this->subpage_id);
        }
        return $this->ranking = $counter->count() + 1;
    }
}
