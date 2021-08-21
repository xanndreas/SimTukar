<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Tag;
use Illuminate\Support\Str;

class OrganizationController extends Controller {

    public function index() {

    }

    public function show($org){
        $slug = Str::slug($org, '-');
        $organization = Organization::all()->where('slug', $slug)->first();
        abort_if(!$organization, 404);
        $popular = $this->getPopularNews(4);
        $category = $this->getCategoriesCount();
        $tags = Tag::all();

        $breadcrumb = [
            "Organisasi" => 'javascript:void(0);',
            $organization->name => route('landing.organization.show', $organization->slug)
        ];

        return view('landing.organization.show', compact('organization', 'popular', 'category', 'tags', 'breadcrumb'));
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