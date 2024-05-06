<?php

namespace App\View\Components\admin;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class aside extends Component
{
    /**
     * Aside variables.
     *
     */
    private $pages, $subpages, $posts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->pages = DB::table('pages')->orderBy('ranking')->get();
        $this->subpages = DB::table('subpages')->orderBy('ranking')->get();
        $this->posts = DB::table('posts')->orderBy('ranking')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.aside', [
            'pages' => $this->pages,
            'subpages' => $this->subpages,
            'posts' => $this->posts,
        ]);
    }
}
