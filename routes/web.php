<?php

use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCredentialsController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Repository\CredentialsJsonOutput;
use Illuminate\Support\Facades\Route;

Route::get('/package-test', (new GetCredentialsController(new CredentialsJsonOutput()))::class);