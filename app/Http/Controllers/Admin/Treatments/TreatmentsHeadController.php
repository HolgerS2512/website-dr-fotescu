<?php

namespace App\Http\Controllers\Admin\Treatments;

use App\Http\Controllers\Controller;
use App\Traits\HeadControllerRepository;
use Illuminate\Http\Request;

class TreatmentsHeadController extends Controller
{
    use HeadControllerRepository;

    /**
     * Stores the associated ID for the respective page.
     *
     * @var int $pageID
     */
    public int $pageID = 2;
}
