<?php

namespace App\Models\Lang;

use App\Models\Image;
use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DE_List extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'de_lists';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Return the page for the getImages
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo 
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
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

    /**
     * Called image for this instance
     * 
     * @return \App\Models\Image
     */
    public function itemImage($item)
    {
        return Image::all()->where('title', $item)->first();
    }
}
