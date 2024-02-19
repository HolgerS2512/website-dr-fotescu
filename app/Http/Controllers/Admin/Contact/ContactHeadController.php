<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Traits\HeadControllerRepository;
use Illuminate\Http\Request;

class ContactHeadController extends Controller
{
    use HeadControllerRepository;

    /**
     * Stores the associated ID for the respective page.
     *
     * @var int $pageID
     */
    public int $pageID = 7;
}
