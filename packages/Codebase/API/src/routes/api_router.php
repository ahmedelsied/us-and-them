<?php

require __DIR__.'/data.routes.php';
require __DIR__.'/actions.routes.php';


Route::group(['prefix' => 'domains', 'namespace' => 'Domains'], static function () {
    require __DIR__.'/domains/auth.routes.php';
    require __DIR__.'/domains/clients.routes.php';
    require __DIR__.'/domains/workouts.routes.php';
    require __DIR__.'/domains/blog.routes.php';
    require __DIR__.'/domains/diets.routes.php';
});
