<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
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
        'public' => 'boolean',
        'created_at' => 'datetime',
    ];

    /**
     * Called image for this instance
     * 
     * @return \App\Models\Image
     */
    public function image(): Image|null
    {
        return Image::all()->where('id', $this->image_id)->first();
    }

    /**
     * Get the content model for this instance.
     * 
     * @return \App\Models\Content|null
     */
    public function content(): Content|null
    {
        return Content::whereId($this->content_id)->get()->first();
    }

    /**
     * Get the url string for this title.
     * 
     * @return string
     */
    public function getUrl(): string
    {
        return preg_replace('/["\'., ( -)]+/', '-', mb_strtolower($this->de));
    }
}
