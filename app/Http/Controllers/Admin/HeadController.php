<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Admin\DbDataRepository;
use App\Repositories\Admin\HeadInterface;
use App\Traits\PageHeadMethods\DestroyImageTrait;
use App\Traits\PageHeadMethods\EditImageTrait;
use App\Traits\PageHeadMethods\GetImageIndexTrait;
use App\Traits\PageHeadMethods\SetImageRankingDownTrait;
use App\Traits\PageHeadMethods\SetImageRankingUpTrait;
use App\Traits\PageHeadMethods\SetImageVisibleTrait;
use App\Traits\PageHeadMethods\StoreImageTrait;
use App\Traits\PageHeadMethods\UpdateImageTrait;

/**
 * Contains this methods and variables.
 * 
 * @var \App\Models\Page $page
 * @var \App\Models\Image $images,
 * @var \App\Models\Publish $publishes
 * @method construct
 * @method index
 * @method store(Request $request)
 * @method edit($id)
 * @method update(Request $request, $id)
 * @method visible(Request $request)
 * @method up(Request $request, $id)
 * @method down(Request $request, $id)
 * @method destroy($id)
 * 
 */
final class HeadController extends Controller implements HeadInterface
{
    use GetImageIndexTrait;
    use StoreImageTrait;
    use EditImageTrait;
    use UpdateImageTrait;
    use SetImageVisibleTrait;
    use SetImageRankingUpTrait;
    use SetImageRankingDownTrait;
    use DestroyImageTrait;

    /**
     * Saves the associated db data for the respective variable.
     *
     * @var \App\Models\Page $page,
     * @var \App\Models\Image $images,
     * @var \App\Models\Publish $publishes
     */
    public $page, $images, $publishes;

    /**
     * Store db data in this variables $page, $images, $publishes.
     * 
     * @method __construct()
     *
     * @param \App\Repositories\Admin\DbDataRepository $AdminData
     * @var   \App\Models\Page $page,
     * @var   \App\Models\Image $images,
     * @var   \App\Models\Publish $publishes
     */
    public function __construct(DbDataRepository $dbData)
    {
        try {
            $this->page = $dbData->page;
            $this->images = $dbData->images;
            $this->publishes = $dbData->publishes;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
