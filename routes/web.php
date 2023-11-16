<?php

use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateCollectionController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateCommunityController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateItemController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\DeleteCollectionController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\DeleteCommunityController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCollectionByHandleController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCollectionByNameController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCollectionByUUIDController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCollectionsController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCommunitiesController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCommunityByHandleController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCommunityByNameController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCommunityByUUIDController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetItemByHandleController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\UpdateCollectionController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\UpdateCommunityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(["prefix"=>"communities"],function(){
    Route::get("",function(Request $request){
        if($request->has('handle')){
            $community = (new GetCommunityByHandleController(new CommunityRequests()))->handler($request);
            return response()->json($community->toArray(),200);
        }
        if($request->has('name')){
            $community = (new GetCommunityByNameController(new CommunityRequests()))->handler($request);
            return response()->json($community->toArray(),200);
        }
        $communities = (new GetCommunitiesController(new CommunityRequests()))->handler($request);
        foreach($communities as $key => $community){ $communities[$key] = $community->toArray(); }
        return response()->json($communities,200);
    });
    Route::get("{uuid}",function(Request $request,string $uuid){
        $community = (new GetCommunityByUUIDController(new CommunityRequests))->handler($request,$uuid);
        return response()->json($community->toArray(),200);
    });
    Route::post("",function(Request $request){
        $community = (new CreateCommunityController(new CommunityRequests()))->handler($request);
        return response()->json($community->toArray(),200);
    });
    Route::put("{uuid}",function(Request $request,string $uuid){
        $community = (new UpdateCommunityController(new CommunityRequests))->handler($request,$uuid);
        return response()->json($community->toArray(),200);
    });
    Route::delete("{uuid}",function(Request $request,string $uuid){
        $response = (new DeleteCommunityController(new CommunityRequests))->handler($uuid);
        return response()->json(["message" => $response],200);
    });
});




Route::group(["prefix"=>"collections"],function(){
    Route::get("",function(Request $request){
        if($request->has('handle')){
            $collection = (new GetCollectionByHandleController(new CollectionRequests()))->handler($request);
            return response()->json($collection->toArray(),200);
        }
        if($request->has('name')){
            $collection = (new GetCollectionByNameController(new CollectionRequests()))->handler($request);
            return response()->json($collection->toArray(),200);
        }
        $collections = (new GetCollectionsController(new CollectionRequests()))->handler($request);
        foreach($collections as $key => $collection){ $collections[$key] = $collection->toArray(); }
        return response()->json($collections,200);
    });
    Route::get("{uuid}",function(Request $request,string $uuid){
        $collection = (new GetCollectionByUUIDController(new CollectionRequests))->handler($request,$uuid);
        return response()->json($collection->toArray(),200);
    });
    Route::post("",function(Request $request){
        $collection = (new CreateCollectionController(new CollectionRequests(),new CommunityRequests()))->handler($request);
        return response()->json($collection->toArray(),200);
    });
    Route::put("{uuid}",function(Request $request,string $uuid){
        $community = (new UpdateCollectionController(new CollectionRequests))->handler($request,$uuid);
        return response()->json($community->toArray(),200);
    });
    Route::delete("{uuid}",function(Request $request,string $uuid){
        $response = (new DeleteCollectionController(new CollectionRequests))->handler($uuid);
        return response()->json(["message" => $response],200);
    });
});







Route::get('/package-test', function(Request $request){
    $item = (new GetItemByHandleController(new ItemRequests()))->handler($request);    
    return response()->json($item->toArray(),200);
});
Route::post('/package-test',function(Request $request){
    return (new CreateItemController(new CollectionRequests(),new ItemRequests()))->handler($request);
});