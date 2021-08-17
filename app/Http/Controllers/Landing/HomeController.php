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
        $corousel = $this->getNewestNews(3);
        $popular = $this->getPopularNews(4);
        $category = $this->getCategoriesCount();
        $news = NewsPage::with('user', 'organization', 'tags')->orderBy('id','desc')->get();
        $tags = Tag::all();
        return view('landing.home.index',compact('news','popular','tags', 'corousel', 'category'));
    }

}
