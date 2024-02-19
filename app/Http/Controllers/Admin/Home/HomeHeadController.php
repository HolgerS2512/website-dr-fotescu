<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Traits\HeadControllerRepository;

class HomeHeadController extends Controller
{
    use HeadControllerRepository;

    /**
     * Stores the associated ID for the respective page.
     *
     * @var int $page
     */
    public int $pageId = 1;
}
