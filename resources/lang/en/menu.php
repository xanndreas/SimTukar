<?php

// dynamically load profile type from models
// profile model
$about = \App\Models\ProfileType::all();
$aboutMenu = [];

// organization model
$organization = \App\Models\Organization::all();
$organizationMenu = [];

// cast the thing to some arr :)
// about
if ($about !== null){
    foreach ($about as $index => $item) {
        $aboutMenu[$item->name] = [
            "route" => strtolower('landing.about.show'),
            "slug" => strtolower('landing.about.show'),
            "params" => strtolower($item->name)
        ];
    }
}

// organization
if ($organization !== null){
    foreach ($organization as $index => $item) {
        $organizationMenu[$item->name] = [
            "route" => strtolower('landing.organization.show'),
            "slug" => strtolower('landing.organization.show'),
            "params" => strtolower($item->name)
        ];
    }
}


return [
    "Home" => [
        "route" => "landing.home.index",
        "slug" => "landing.home.index"
    ],
    "About" => [
        "route" => "landing.about.index",
        "slug" => "landing.about.index",
        "submenu" => isset($aboutMenu) ? $aboutMenu : []
    ],
    "UMKM" => [
        "route" => "landing.umkm.index",
        "slug" => "landing.umkm.index",
    ],
    "Organization" => [
        "route" => "landing.organization.index",
        "slug" => "landing.organization.index",
        "submenu" => isset($organizationMenu) ? $organizationMenu : []
    ],
    "News" => [
        "route" => "landing.news.index",
        "slug" => "landing.news.index",
    ],
    "Contact" => [
        "route" => "landing.contact.index",
        "slug" => "landing.contact.index",
    ],

];