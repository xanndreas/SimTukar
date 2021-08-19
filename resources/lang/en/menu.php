<?php

// dynamically load profile type from models
// profile model
$about = \App\Models\ProfileType::all();
$aboutMenu = [];

// organization model
$organization = \App\Models\Organization::all();
$organizationMenu = [];

// umkm model
$umkm = \App\Models\Umkm::all();
$umkmMenu = [];

// cast the thing to some arr :)
// about
if ($about !== null){
    foreach ($about as $index => $item) {
        $aboutMenu[$item->name] = [
            "route" => strtolower('landing.about.show'),
            "slug" => strtolower('landing.about.show'),
            "params" => strtolower($item->slug)
        ];
    }
}

// organization
if ($organization !== null){
    foreach ($organization as $index => $item) {
        $organizationMenu[$item->name] = [
            "route" => strtolower('landing.organization.show'),
            "slug" => strtolower('landing.organization.show'),
            "params" => strtolower($item->slug)
        ];
    }
}

// organization
if ($umkm !== null){
    foreach ($umkm as $index => $item) {
        $umkmMenu[$item->name] = [
            "route" => strtolower('landing.umkm.show'),
            "slug" => strtolower('landing.umkm.show'),
            "params" => strtolower($item->slug)
        ];
    }
}


return [
    "Beranda" => [
        "route" => "landing.home.index",
        "slug" => "landing.home.index"
    ],
    "Tentang" => [
        "route" => "landing.about.show",
        "slug" => "landing.about.show",
        "submenu" => isset($aboutMenu) ? $aboutMenu : []
    ],
    "UMKM" => [
        "route" => "landing.umkm.show",
        "slug" => "landing.umkm.show",
        "submenu" => isset($umkmMenu) ? $umkmMenu : []
    ],
    "Organisasi" => [
        "route" => "landing.organization.show",
        "slug" => "landing.organization.show",
        "submenu" => isset($organizationMenu) ? $organizationMenu : []
    ],
    "Berita" => [
        "route" => "landing.news.index",
        "slug" => "landing.news.index",
    ],
    "Kontak" => [
        "route" => "landing.contact.index",
        "slug" => "landing.contact.index",
    ],

];