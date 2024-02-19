<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use App\Traits\HeadControllerRepository;

class TeamHeadController extends Controller
{
    use HeadControllerRepository;

    /**
     * Stores the associated ID for the respective page.
     *
     * @var int $page
     */
    public int $pageId = 5;
}
