<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Umkm;
use Illuminate\Support\Str;

class UmkmController extends Controller{

    public function show($umkm){
        $slug = Str::slug($umkm, '-');
        $umkm = Umkm::with('contact_detail')->where('slug', $slug)->first();
        abort_if(!$umkm, 404);

        $popular = $this->getPopularNews(4);
        $category = $this->getCategoriesCount();
        $tags = Tag::all();

        $breadcrumb = [
            "Tentang" => 'javascript:void(0);',
            $umkm->name => route('landing.umkm.show', $umkm->slug)
        ];

        return view('landing.umkm.show', compact('umkm', 'popular', 'category', 'tags', 'breadcrumb'));

    }


}