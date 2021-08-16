<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\NewsPage;
use App\Models\Organization;
use App\Models\Tag;

class NewsController extends Controller {

    public function index() {
        $news = NewsPage::with('user', 'organization', 'tags', 'created_by')->orderBy('id','desc')->get();
        $popular = NewsPage::with('created_by')->orderByDesc('views')->limit(6)->get();
        $tags = Tag::all();
        $profileType = $this->getProfileTypes();
        $organization = Organization::all();
        return view('landing.home.index',compact('news','popular','profileType','organization','tags'));

    }

    public function show($news){
        $newsPage = NewsPage::with('user','organization','tags','created_by')->where('id',$i)->get();
        $popular = NewsPage::with('created_by')->orderByDesc('views')->limit(6)->get();
        $tags = Tag::all();
        $profileType = $this->getProfileTypes();
        $organization = Organization::all();
        $comments = Comment::with('news_page','user')->where('berita_id',$i)->get();
        return view('landing.single-news.index', compact('organization','popular','newsPage','tags','comments','profileType'));
    }

    public function create(){

    }

    public function store(){

    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}