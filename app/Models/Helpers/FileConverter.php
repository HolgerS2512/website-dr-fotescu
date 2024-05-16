<?php

namespace App\Models\Helpers;

use Illuminate\Database\Eloquent\Model;

class FileConverter extends Model
{
    public string $fileName;
    public string $saveUrl;
    public string $extension;

    public function __construct(public $image, public $uploadLocation)
    {
        $this->setAttributes();
    }

    public function setAttributes()
    {
        $this->setExtension();

        $this->setFileName();

        $this->setSaveUrl();
    }

    public function setExtension()
    {
        $this->extension = strtolower($this->image->getClientOriginalExtension());
    }

    public function setFileName()
    {
        $generate = hexdec(uniqid());

        $this->fileName = $generate . '.' . $this->extension;
    }

    public function setSaveUrl()
    {
        $this->saveUrl = $this->uploadLocation . $this->fileName;
    }

    public function move()
    {
        $this->image->move($this->uploadLocation, $this->fileName);
    }
}
