<?php

use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateBundleController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateCollectionController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateCommunityController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateCommunityWithParentController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateItemController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\DeleteBundleController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\DeleteCollectionController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\DeleteCommunityController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\DeleteItemController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetBundlesByItemController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCollectionByHandleController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCollectionByNameController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCollectionByUUIDController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCollectionsByCommunityController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCollectionsController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCommunitiesController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCommunitiesIsParentController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCommunitiesWhereParentController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCommunityByHandleController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCommunityByNameController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCommunityByUUIDController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetItemByHandleController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetItemByNameController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetItemByUUIDController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetItemsByCollectionController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetItemsController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\UpdateCollectionController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\UpdateCommunityController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\UpdateItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(["prefix" => "communities"], function () {
    Route::get("", function (Request $request) {
        if ($request->has('handle')) {
            return response()->json(((new GetCommunityByHandleController)->handler($request->handle))->toArray(), 200);
        }
        if ($request->has('name')) {
            return response()->json(((new GetCommunityByNameController)->handler($request->name))->toArray(), 200);
        }
        if ($request->has('isParent') && $request->isParent == TRUE) {
            return response()->json((new GetCommunitiesIsParentController)->handler($request->page), 200);
        }
        if ($request->has('communityParentName')) {
            return response()->json((new GetCommunitiesWhereParentController)->handler($request->communityParentName,$request->page), 200);
        }
        return response()->json((new GetCommunitiesController)->handler($request->page), 200);
    });
    Route::post("", function (Request $request) {
        if ($request->has('communityParentName')) {
            return response()->json(((new CreateCommunityWithParentController)->handler($request->communityParentName,$request->community))->toArray(), 200);
        }
        return response()->json(((new CreateCommunityController)->handler($request->community))->toArray(), 200);
    });
    Route::get("{uuid}", function (string $uuid) {
        return response()->json(((new GetCommunityByUUIDController)->handler($uuid))->toArray(), 200);
    });
    Route::put("{uuid}", function (Request $request, string $uuid) {
        return response()->json(((new UpdateCommunityController)->handler($request->community, $uuid))->toArray(), 200);
    });
    Route::delete("{uuid}", function (string $uuid) {
        return response()->json(["message" => (new DeleteCommunityController)->handler($uuid)], 200);
    });
});





Route::group(["prefix" => "collections"], function () {
    Route::get("", function (Request $request) {
        if ($request->has('communityName')) {
            return response()->json((new GetCollectionsByCommunityController)->handler($request->communityName,$request->page), 200);
        }
        if ($request->has('handle')) {
            return response()->json(((new GetCollectionByHandleController)->handler($request->handle))->toArray(), 200);
        }
        if ($request->has('name')) {
            return response()->json(((new GetCollectionByNameController)->handler($request->name))->toArray(), 200);
        }
        return response()->json((new GetCollectionsController)->handler($request->page), 200);
    });
    Route::get("{uuid}", function (Request $request, string $uuid) {
        return response()->json(((new GetCollectionByUUIDController)->handler($uuid))->toArray(), 200);
    });
    Route::post("", function (Request $request) {
        return response()->json(((new CreateCollectionController)->handler($request->collection,$request->communityName))->toArray(), 200);
    });
    Route::put("{uuid}", function (Request $request, string $uuid) {
        return response()->json(((new UpdateCollectionController)->handler($request->collection, $uuid))->toArray(), 200);
    });
    Route::delete("{uuid}", function (string $uuid) {
        return response()->json(["message" => (new DeleteCollectionController)->handler($uuid)], 200);
    });
});





Route::group(["prefix" => "items"], function () {
    Route::get("", function (Request $request) {
        if ($request->has('collectionName')) {
            return response()->json((new GetItemsByCollectionController)->handler($request->collectionName,$request->page), 200);
        }
        if ($request->has('handle')) {
            return response()->json(((new GetItemByHandleController)->handler($request->handle))->toArray(), 200);
        }
        if ($request->has('name')) {
            return response()->json(((new GetItemByNameController)->handler($request->name))->toArray(), 200);
        }
        return response()->json((new GetItemsController)->handler($request->page), 200);
    });
    Route::get("{uuid}", function (string $uuid) {
        return response()->json(((new GetItemByUUIDController)->handler($uuid))->toArray(), 200);
    });
    Route::post("", function (Request $request) {
        return response()->json(((new CreateItemController)->handler($request->item,$request->collectionName))->toArray(), 200);
    });
    Route::put("{uuid}", function (Request $request, string $uuid) {
        return response()->json(((new UpdateItemController)->handler($request->item, $uuid))->toArray(), 200);
    });
    Route::delete("{uuid}", function (string $uuid) {
        return response()->json(["message" => (new DeleteItemController)->handler($uuid)], 200);
    });
});





Route::group(["prefix" => "bundles"], function () {
    Route::get("", function (Request $request) {
        if ($request->has('itemHandle')) {
            return response()->json((new GetBundlesByItemController())->handler($request->itemHandle,$request->page), 200);
        }
        return response()->json(["message"=>"Get all bundles is unsupported, add itemHandle param to request."],200);
    });
    Route::get("{uuid}", function (string $uuid) {
        return response()->json(((new GetItemByUUIDController)->handler($uuid))->toArray(), 200);
    });
    Route::post("", function (Request $request) {
        return response()->json(((new CreateBundleController)->handler($request->bundle,$request->itemHandle))->toArray(), 200);
    });
    Route::delete("{uuid}", function (string $uuid) {
        return response()->json(["message" => (new DeleteBundleController)->handler($uuid)], 200);
    });
});