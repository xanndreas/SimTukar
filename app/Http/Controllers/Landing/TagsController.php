<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\NewsPage;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagsController extends Controller{

    public function index() {

    }

    public function show($any){
        $slug = Str::slug($any, '-');
        $news = NewsPage::with('tags', 'category', 'organization', 'user')->get();
        abort_if(!$news,404);

        $popular = $this->getPopularNews(4);
        $category = $this->getCategoriesCount();
        $tags = Tag::all();
        $tag = Tag::where('slug',$slug)->pluck('name');
        $breadcrumb = [
            "Tag" => 'javascript:void(0);'
        ];

        $title = '#'.$tag[0];

        return view('landing.tags.show', compact('news', 'breadcrumb','slug', 'popular', 'category', 'tags','title'));
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