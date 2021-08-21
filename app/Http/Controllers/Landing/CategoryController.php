<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\NewsPage;
use App\Models\Tag;
use Illuminate\Support\Str;

class CategoryController extends Controller {

    public function index() {

    }

    public function show($category){
        $slug = Str::slug($category, '-');
        $news = NewsPage::with('tags', 'category', 'organization', 'user')->get();
        abort_if(!$news,404);

        $popular = $this->getPopularNews(4);
        $category = $this->getCategoriesCount();
        $tags = Tag::all();
        $cat = Category::where('slug',$slug)->pluck('name');
        $breadcrumb = [
            "Category" => 'javascript:void(0);'
        ];

        $title = $cat[0];

        return view('landing.category.show', compact('news', 'breadcrumb','slug', 'popular', 'category', 'tags','title'));

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