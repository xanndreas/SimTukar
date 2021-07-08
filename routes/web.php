<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Profile Type
    Route::delete('profile-types/destroy', 'ProfileTypeController@massDestroy')->name('profile-types.massDestroy');
    Route::resource('profile-types', 'ProfileTypeController');

    // Profile Page
    Route::delete('profile-pages/destroy', 'ProfilePageController@massDestroy')->name('profile-pages.massDestroy');
    Route::post('profile-pages/media', 'ProfilePageController@storeMedia')->name('profile-pages.storeMedia');
    Route::post('profile-pages/ckmedia', 'ProfilePageController@storeCKEditorImages')->name('profile-pages.storeCKEditorImages');
    Route::resource('profile-pages', 'ProfilePageController');

    // Contact Icon
    Route::delete('contact-icons/destroy', 'ContactIconController@massDestroy')->name('contact-icons.massDestroy');
    Route::resource('contact-icons', 'ContactIconController');

    // Contact Detail
    Route::delete('contact-details/destroy', 'ContactDetailController@massDestroy')->name('contact-details.massDestroy');
    Route::resource('contact-details', 'ContactDetailController');

    // Umkm
    Route::delete('umkms/destroy', 'UmkmController@massDestroy')->name('umkms.massDestroy');
    Route::post('umkms/media', 'UmkmController@storeMedia')->name('umkms.storeMedia');
    Route::post('umkms/ckmedia', 'UmkmController@storeCKEditorImages')->name('umkms.storeCKEditorImages');
    Route::resource('umkms', 'UmkmController');

    // Organization
    Route::delete('organizations/destroy', 'OrganizationController@massDestroy')->name('organizations.massDestroy');
    Route::post('organizations/media', 'OrganizationController@storeMedia')->name('organizations.storeMedia');
    Route::post('organizations/ckmedia', 'OrganizationController@storeCKEditorImages')->name('organizations.storeCKEditorImages');
    Route::resource('organizations', 'OrganizationController');

    // Category
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoryController');

    // Tag
    Route::delete('tags/destroy', 'TagController@massDestroy')->name('tags.massDestroy');
    Route::resource('tags', 'TagController');

    // News Page
    Route::delete('news-pages/destroy', 'NewsPageController@massDestroy')->name('news-pages.massDestroy');
    Route::post('news-pages/media', 'NewsPageController@storeMedia')->name('news-pages.storeMedia');
    Route::post('news-pages/ckmedia', 'NewsPageController@storeCKEditorImages')->name('news-pages.storeCKEditorImages');
    Route::resource('news-pages', 'NewsPageController');

    // Comment
    Route::delete('comments/destroy', 'CommentController@massDestroy')->name('comments.massDestroy');
    Route::resource('comments', 'CommentController');

    // Agenda
    Route::delete('agendas/destroy', 'AgendaController@massDestroy')->name('agendas.massDestroy');
    Route::resource('agendas', 'AgendaController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
