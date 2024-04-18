<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
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
        'slide' => 'boolean',
    ];

    /**
     * Return the page for the images
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo 
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Return alt text for this image.
     * 
     * @return string
     */
    public function getAlt(): string
    {
        $infos = Info::all()->firstOrFail();

        $alt = $this->title . '-' . __('messages.words.nav_title') . '-' . ($infos->city ? "$infos->city-" : '') . $this->ext;
        $alt = preg_replace('/[. ( -)]+/', '-', mb_strtolower($alt));

        return $alt;
    }
}
