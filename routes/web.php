<?php

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Credentials;
use Illuminate\Support\Facades\Route;

Route::get('/package-test', function () {
    return new Credentials(
        config('laravel-dspace7-client.dspace_api_url'),
        config('laravel-dspace7-client.dspace_api_user'),
        config('laravel-dspace7-client.dspace_api_pass')
    );
    // return response()->json([
    //     "dspace_api_user"=>config('laravel-dspace7-client.dspace_api_user'),
    //     "dspace_api_pass"=>config('laravel-dspace7-client.dspace_api_pass'),
    //     "dspace_api_url"=>config('laravel-dspace7-client.dspace_api_url')
    // ],200);
});