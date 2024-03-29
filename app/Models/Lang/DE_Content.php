<?php

namespace App\Models\Lang;

use App\Models\Content;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class DE_Content extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'de_contents';

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
    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}
