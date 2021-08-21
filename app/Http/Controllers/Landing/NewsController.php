<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\NewsPage;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller {

    public function index() {
        $news = NewsPage::with('tags', 'category', 'organization', 'user')->get();

        $popular = $this->getPopularNews(4);
        $tags = Tag::all();
        $category = $this->getCategoriesCount();

        $breadcrumb = [
            "Berita" => 'javascript:void(0);'
        ];

        $title = 'Berita';

        return view('landing.news.index',compact('news','popular','tags','category', 'breadcrumb', 'title'));

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

        return view('landing.news.show', compact('news', 'breadcrumb','slug', 'popular', 'category', 'tags', 'comments'));
    }

    private function loadComments($id){
        return Comment::where('berita_id', $id)->orderByDesc('created_at')->get();
    }

    public function create(){

    }

    public function store(StoreCommentRequest $request)
    {
        $validator = Validator::make($request->all(),[
            recaptchaFieldName() => recaptchaRuleName()]);
        if ($validator->fails()){
            return redirect()->back()->with('failed','Captcha harus divalidasi!');
        } else {
            Comment::create($request->all());
            return redirect()->back()->with('success','Terimakasih atas komentar Anda!');
        }
    }

    public function edit(Comment $comment)
    {
        $comment->load('berita');

        echo json_encode($comment);
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $validator = Validator::make($request->all(),[
            recaptchaFieldName() => recaptchaRuleName()]);
        if ($validator->fails()){
            return redirect()->back()->with('failed','Captcha harus divalidasi!');
        } else {
            $comment->update($request->all());
            return redirect()->back()->with('success','Report akan segera diproses!');
        }

    }

    public function destroy(){

    }
}