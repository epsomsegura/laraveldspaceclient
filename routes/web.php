<?php

use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateItemController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCommunitiesController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCommunityByHandleController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCommunityByNameController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCommunityByUUIDController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetItemByHandleController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;
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
});

Route::get('/package-test', function(Request $request){
    $item = (new GetItemByHandleController(new ItemRequests()))->handler($request);    
    return response()->json($item->toArray(),200);
});
Route::post('/package-test',function(Request $request){
    return (new CreateItemController(new CollectionRequests(),new ItemRequests()))->handler($request);
});