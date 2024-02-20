<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Repositories\Image\HeadImageInterface;
use App\Traits\ImageMethods\ConststructAttributesTrait;
use App\Traits\ImageMethods\Head\DestroyImageTrait;
use App\Traits\ImageMethods\Head\EditImageTrait;
use App\Traits\ImageMethods\Head\GetImageIndexTrait;
use App\Traits\ImageMethods\Head\SetImageRankingDownTrait;
use App\Traits\ImageMethods\Head\SetImageRankingUpTrait;
use App\Traits\ImageMethods\Head\SetImageVisibleTrait;
use App\Traits\ImageMethods\Head\StoreImageTrait;
use App\Traits\ImageMethods\Head\UpdateImageTrait;

/**
 * Contains trait image methods.
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
final class BlogHeadController extends Controller implements HeadImageInterface
{
    use ConststructAttributesTrait;
    use GetImageIndexTrait;
    use StoreImageTrait;
    use EditImageTrait;
    use UpdateImageTrait;
    use SetImageVisibleTrait;
    use SetImageRankingUpTrait;
    use SetImageRankingDownTrait;
    use DestroyImageTrait;

    /**
     * Stores the associated ID for page blog.
     *
     * @var int $pageID
     */
    public int $pageID = 3;
}
