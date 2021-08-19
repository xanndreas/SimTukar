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

        return view('landing.news.index',compact('news','popular','profileType','organization','tags'));

    }

    public function show($news){
        $slug = Str::slug($news, '-');
        $news = NewsPage::with('tags', 'category', 'organization', 'user')->where('slug', $slug)->first();
//        abort_if(!$news,404);

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
        if ($validator->failed()){
            Alert::error('Failed', 'Check captcha');
        } else {
            $comment = Comment::create($request->all());
        }
        return redirect()->route('landing.news.show');

    }

    public function edit(Comment $comment)
    {
        $comment->load('berita');

        echo json_encode($comment);
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $update = $comment->update($request->all());
        if ($update){
            return redirect()->route('landing.news.show');
        }else {
            return 0;
        }

    }

    public function destroy(){

    }
}