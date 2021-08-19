<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\ProfilePage;
use App\Models\ProfileType;
use App\Models\Tag;
use Illuminate\Support\Str;

class AboutController extends Controller {

    public function show($about){
        $slug = Str::slug($about, '-');
        $profileType = ProfileType::where('slug', $slug)->first();
        $about = ProfilePage::with('profile_type')->where('profile_type_id', $profileType->id)->first();

        abort_if(!$about, 404);

        $popular = $this->getPopularNews(4);
        $category = $this->getCategoriesCount();
        $tags = Tag::all();

        $breadcrumb = [
            "Tentang" => 'javascript:void(0);',
            $about->profile_type->name => route('landing.about.show', $about->profile_type->slug)
        ];

        return view('landing.about.show', compact('about', 'popular', 'category', 'tags', 'breadcrumb'));
    }

}