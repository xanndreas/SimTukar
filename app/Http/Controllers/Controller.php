<?php

namespace App\Http\Controllers;

use App\Models\NewsPage;
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

    public function getCategoriesCount(){
        $results = [];
        $categories = NewsPage::with('category')->get();

        foreach ($categories as $index => $value){
            if(isset($results[$value->category->name])){
                $results[$value->category->name]['count'] += 1;
            } else {
                $results[$value->category->name] = [
                    'name' => $value->category->name,
                    'slug' => $value->category->slug,
                    'count' => 1,
                ];
            }

        }

        return $results;
    }
}
