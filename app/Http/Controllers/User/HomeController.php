<?php

namespace App\Http\Controllers\User;

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
    public function __construct()
    {
    }

    public function index()
    {
        $news = NewsPage::with('user', 'organization', 'tags', 'created_by')->orderBy('id','desc')->get();
        $profileType = $this->getProfileTypes();
        $organization = Organization::all();
        return view('user.home.index',compact('news','profileType','organization'));
    }

    public function show($i){
        $newsPage = NewsPage::with('user','organization','tags','created_by')->where('id',$i)->get();
        $tags = Tag::all();
        $profileType = $this->getProfileTypes();
        $organization = Organization::all();
        $comments = Comment::with('news_page','user')->where('berita_id',$i)->get();
        return view('user.single-news.index', compact('organization','newsPage','tags','comments','profileType'));
    }

    public function profile($i){
        $profileType = $this->getProfileTypes();
        $profile = ProfilePage::with('profile_type')->where('profile_type_id',$i)->get();
        $type = ProfileType::where('id',$i)->get();
        $organization = Organization::all();
        return view('user.profile.index', compact('profile','organization','type','profileType'));
    }

    public function umkm(){
        $profileType = $this->getProfileTypes();
        $umkm = Umkm::all()->load('contact_detail');
        $organization = Organization::all();
        return view('user.informasi-publik.umkm', compact('umkm','organization','profileType'));
    }

    public function organization(){
        $profileType = $this->getProfileTypes();
        $organization = Organization::all();
        return view('user.informasi-publik.organization', compact('organization','profileType'));
    }
}
