<?php

// dynamically load profile type from models
// profile model
$profile = \App\Models\ProfileType::all();
$profileMenu = [];

// organization model
$organization = \App\Models\Organization::all();
$organizationMenu = [];

// cast the thing to some arr :)
// profile
if ($profile !== null){
    foreach ($profile as $index => $item) {
        $profileMenu[$item->name] = [
            "route" => strtolower('landing.profile.show'),
            "slug" => strtolower('landing.profile.show'),
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
    "Profile" => [
        "route" => "landing.profile.index",
        "slug" => "landing.profile.index",
        "submenu" => isset($profileMenu) ? $profileMenu : []
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