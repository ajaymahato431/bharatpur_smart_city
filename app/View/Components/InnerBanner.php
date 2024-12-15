<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InnerBanner extends Component
{

    public $bannerImage;
    public $pageTitle;
    public $breadcrumbs;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($bannerImage = 'assets/images/banner/banner2.jpg', $pageTitle = 'Page Title', $breadcrumbs = [])
    {
        $this->bannerImage = $bannerImage;
        $this->pageTitle = $pageTitle;
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inner-banner');
    }
}
