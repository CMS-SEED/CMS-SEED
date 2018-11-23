<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Response\ResourceResponse;
use Cms_Framework_Seed\Theme\ThemeAndViews;
use Cms_Framework_Seed\User\Traits\RoutesAndGuards;
use Cms_Framework_Seed\User\Traits\UserPages;

class ResourceController extends BaseController
{
    use RoutesAndGuards, ThemeAndViews, UserPages;

    /**
     * Initialize public controller.
     *
     * @return null
     */
    public function __construct()
    {
        if (!empty(app('auth')->getDefaultDriver())) {
            $this->middleware('auth:'.app('auth')->getDefaultDriver());
            $this->middleware('role:'.$this->getGuardRoute());
            $this->middleware('active');
        }

        $this->response = app(ResourceResponse::class);
        $this->setTheme();
    }

    /**
     * Show dashboard for each user.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return $this->response->setMetaTitle(__('app.dashboard'))
            ->view('home')
            ->output();
    }
}
