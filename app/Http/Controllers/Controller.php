<?php

namespace App\Http\Controllers;

use App\Models\NewsPage;
use App\Models\ProfileType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getPopularNews($amount){
        return NewsPage::orderBy('views')->take($amount)->get()->load('user', 'organization', 'category', 'tags');
    }

    public function getNewestNews($amount){
        return NewsPage::orderBy('created_at')->take($amount)->get()->load('user', 'organization', 'category', 'tags');
    }

    public function getPaginatorNews($perPage){
        return NewsPage::paginate($perPage);
    }
}
