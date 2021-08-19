<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\NewsPage;
use App\Models\Tag;
use Illuminate\Support\Str;

class NewsController extends Controller {

    public function index() {

        return view('landing.news.index',compact('news','popular','profileType','organization','tags'));

    }

    public function show($news){
        $slug = Str::slug($news, '-');
        $news = NewsPage::with('tags', 'category', 'organization', 'user')->where('slug', $slug)->first();
        abort_if(!$news,404);

        $comments = $this->loadComments($news->id);
        $popular = $this->getPopularNews(4);
        $category = $this->getCategoriesCount();
        $tags = Tag::all();
        $breadcrumb = [
            "News" => route('landing.news.index'),
            isset($news->category->name) ? $news->category->name : "Category" => isset($news->category->name) ? route('landing.category.show', $news->category->name) : "javascript:void(0);",
            "Current News" => route('landing.news.show', $news->slug)
        ];

        return view('landing.news.show', compact('news', 'breadcrumb', 'popular', 'category', 'tags', 'comments'));
    }

    private function loadComments($id){
        return Comment::where('berita_id', $id)->orderByDesc('created_at')->get();
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