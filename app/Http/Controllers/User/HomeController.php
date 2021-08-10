<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\NewsPage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $news = NewsPage::all()->load('user', 'organization', 'tags', 'created_by');
//        var_dump($news);
        return view('user.home.index',compact('news'));
    }

    public function show(){
        return view('user.single-news.index');
    }
}
