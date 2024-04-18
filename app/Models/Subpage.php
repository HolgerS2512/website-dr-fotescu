<?php

namespace App\Models;

use App\Traits\WebpageModelMethods;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subpage extends Model
{
    use WebpageModelMethods;

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
}
