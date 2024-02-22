<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentList extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Return the page for the images
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo 
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
