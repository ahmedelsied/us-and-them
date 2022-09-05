<?php
Route::group(['prefix' => 'blog', 'namespace' => 'Blog','middleware' => 'auth:sanctum'], static function () {
    Route::get('articles','GetArticlesController');
    Route::get('success-stories','GetSuccessStoriesController');
});