<?php

use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateItemController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCollectionByNameController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetItemByHandleController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/package-test', function(Request $request){
    $item = (new GetItemByHandleController(new ItemRequests()))->handler($request);    
    return response()->json($item->toArray(),200);
});
Route::post('/package-test',function(Request $request){
    return (new CreateItemController(new CollectionRequests(),new ItemRequests()))->handler($request);
});