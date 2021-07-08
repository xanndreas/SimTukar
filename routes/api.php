<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Profile Type
    Route::apiResource('profile-types', 'ProfileTypeApiController');

    // Profile Page
    Route::post('profile-pages/media', 'ProfilePageApiController@storeMedia')->name('profile-pages.storeMedia');
    Route::apiResource('profile-pages', 'ProfilePageApiController');

    // Contact Icon
    Route::apiResource('contact-icons', 'ContactIconApiController');

    // Contact Detail
    Route::apiResource('contact-details', 'ContactDetailApiController');

    // Umkm
    Route::post('umkms/media', 'UmkmApiController@storeMedia')->name('umkms.storeMedia');
    Route::apiResource('umkms', 'UmkmApiController');

    // Organization
    Route::post('organizations/media', 'OrganizationApiController@storeMedia')->name('organizations.storeMedia');
    Route::apiResource('organizations', 'OrganizationApiController');

    // Category
    Route::apiResource('categories', 'CategoryApiController');

    // Tag
    Route::apiResource('tags', 'TagApiController');

    // News Page
    Route::post('news-pages/media', 'NewsPageApiController@storeMedia')->name('news-pages.storeMedia');
    Route::apiResource('news-pages', 'NewsPageApiController');

    // Comment
    Route::apiResource('comments', 'CommentApiController');

    // Agenda
    Route::apiResource('agendas', 'AgendaApiController');
});
