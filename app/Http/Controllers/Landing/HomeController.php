<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\NewsPage;
use App\Models\Organization;
use App\Models\ProfilePage;
use App\Models\ProfileType;
use App\Models\Tag;
use App\Models\Umkm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $top1news = $this->getPopularNews(1)->first();
        $recent = $this->getNewestNews(4);
        $weeks = $this->getPopularWeeksNews(5);
        $topnews = $this->getPopularNews(6);
        $news = NewsPage::with('user', 'organization', 'category', 'tags')->get();

        // for sidebar
        $popular = $this->getPopularNews(4);
        $category = $this->getCategoriesCount();
        $tags = Tag::all();

        return view('landing.home.index',compact('popular','tags', 'category', 'top1news', 'topnews', 'recent', 'weeks', 'news'));
    }

}
