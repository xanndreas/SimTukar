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
        $news = NewsPage::with('user', 'organization', 'tags', 'created_by')->orderBy('id','desc')->get();
        $popular = NewsPage::with('created_by')->orderByDesc('views')->limit(6)->get();
        $tags = Tag::all();
        $organization = Organization::all();
        return view('landing.home.index',compact('news','popular','organization','tags'));
    }

    public function tags($i)
    {
        $news = NewsPage::with('organization', 'tags', 'created_by')->orderBy('id','desc')->get();
        $tags = Tag::all();
        $profileType = $this->getProfileTypes();
        $organization = Organization::all();
        $popular = NewsPage::with('created_by')->orderByDesc('views')->limit(6)->get();
        return view('landing.tags.index',compact('news','popular','profileType','organization','tags'));
    }

    public function show($i){
        $newsPage = NewsPage::with('user','organization','tags','created_by')->where('id',$i)->get();
        $popular = NewsPage::with('created_by')->orderByDesc('views')->limit(6)->get();
        $tags = Tag::all();
        $profileType = $this->getProfileTypes();
        $organization = Organization::all();
        $comments = Comment::with('news_page','user')->where('berita_id',$i)->get();
        return view('landing.single-news.index', compact('organization','popular','newsPage','tags','comments','profileType'));
    }

    public function profile($i){
        $profileType = $this->getProfileTypes();
        $profile = ProfilePage::with('profile_type')->where('profile_type_id',$i)->get();
        $type = ProfileType::where('id',$i)->get();
        $organization = Organization::all();
        return view('landing.profile.index', compact('profile','organization','type','profileType'));
    }

    public function umkm(){
        $profileType = $this->getProfileTypes();
        $umkm = Umkm::all()->load('contact_detail');
        $organization = Organization::all();
        return view('landing.informasi-publik.umkm', compact('umkm','organization','profileType'));
    }

    public function umkm_detail($i){
        $profileType = $this->getProfileTypes();
        $umkm = Umkm::with('contact_detail')->where('id',$i)->get();
        $organization = Organization::all();
        return view('landing.informasi-publik.umkm_detail', compact('umkm','organization','profileType'));
    }

    public function organization($i){
        $profileType = $this->getProfileTypes();
        $organization = Organization::all();
        $organizationDesc = Organization::all()->where('id',$i);
        $news = NewsPage::with('organization', 'tags', 'created_by')->where('organization_id',$i)->get();
//        dd($news);
        return view('landing.informasi-publik.organization', compact('organization','profileType','news','organizationDesc'));
    }
    public function layanan(){
        $profileType = $this->getProfileTypes();
        $organization = Organization::all();
        return view('landing.layanan.index', compact('organization','profileType'));
    }
}
