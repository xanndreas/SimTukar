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
        $news = NewsPage::with('user', 'organization', 'tags')->orderBy('id','desc')->get();
        $popular = NewsPage::with('user', 'organization', 'tags')->orderByDesc('views')->limit(6)->get();
        $tags = Tag::all();
        $organization = Organization::all();
        return view('landing.home.index',compact('news','popular','organization','tags', 'corousel'));
    }

}
