<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'format';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Called image for this instance
     * 
     * @return string $url
     */
    public function image(): string
    {
        return "img/formats/$this->name.jpg";
    }
}
