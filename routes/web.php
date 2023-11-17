<?php

use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateCollectionController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateCommunityController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateCommunityWithParentController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateItemController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\DeleteCollectionController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\DeleteCommunityController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\DeleteItemController;
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
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\UpdateCollectionController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\UpdateCommunityController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\UpdateItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(["prefix" => "communities"], function () {
    Route::get("", function (Request $request) {
        if ($request->has('handle')) {
            $community = (new GetCommunityByHandleController(new CommunityRequests()))->handler($request);
            return response()->json($community->toArray(), 200);
        }
        if ($request->has('name')) {
            $community = (new GetCommunityByNameController(new CommunityRequests()))->handler($request);
            return response()->json($community->toArray(), 200);
        }
        if ($request->has('isParent') && $request->isParent == TRUE) {
            $communities = (new GetCommunitiesIsParentController(new CommunityRequests()))->handler($request);
            foreach ($communities as $key => $community) {
                $communities[$key] = $community->toArray();
            }
            return response()->json($communities, 200);
        }
        if ($request->has('communityParentName') && $request->communityParentName == TRUE) {
            $communities = (new GetCommunitiesWhereParentController(new CommunityRequests()))->handler($request);
            foreach ($communities as $key => $community) {
                $communities[$key] = $community->toArray();
            }
            return response()->json($communities, 200);
        }
        $communities = (new GetCommunitiesController(new CommunityRequests()))->handler($request);
        foreach ($communities as $key => $community) {
            $communities[$key] = $community->toArray();
        }
        return response()->json($communities, 200);
    });
    Route::post("", function (Request $request) {
        if ($request->has('communityParentName')) {
            $community = (new CreateCommunityWithParentController(new CommunityRequests()))->handler($request);
            return response()->json($community->toArray(), 200);
        }
        $community = (new CreateCommunityController(new CommunityRequests()))->handler($request);
        return response()->json($community->toArray(), 200);
    });
    Route::get("{uuid}", function (Request $request, string $uuid) {
        $community = (new GetCommunityByUUIDController(new CommunityRequests))->handler($request, $uuid);
        return response()->json($community->toArray(), 200);
    });
    Route::get("{uuid}/subcommunities", function (Request $request, string $uuid) {
        $community = (new GetCommunityByUUIDController(new CommunityRequests))->handler($request, $uuid);
        return response()->json($community->toArray(), 200);
    });
    Route::put("{uuid}", function (Request $request, string $uuid) {
        $community = (new UpdateCommunityController(new CommunityRequests))->handler($request, $uuid);
        return response()->json($community->toArray(), 200);
    });
    Route::delete("{uuid}", function (Request $request, string $uuid) {
        $response = (new DeleteCommunityController(new CommunityRequests))->handler($uuid);
        return response()->json(["message" => $response], 200);
    });
});





Route::group(["prefix" => "collections"], function () {
    Route::get("", function (Request $request) {
        if ($request->has('communityName')) {
            $collections = (new GetCollectionsByCommunityController(new CollectionRequests()))->handler($request);
            foreach ($collections as $key => $collection) {
                $collections[$key] = $collection->toArray();
            }
            return response()->json($collections, 200);
        }
        if ($request->has('handle')) {
            $collection = (new GetCollectionByHandleController(new CollectionRequests()))->handler($request);
            return response()->json($collection->toArray(), 200);
        }
        if ($request->has('name')) {
            $collection = (new GetCollectionByNameController(new CollectionRequests()))->handler($request);
            return response()->json($collection->toArray(), 200);
        }
        $collections = (new GetCollectionsController(new CollectionRequests()))->handler($request);
        foreach ($collections as $key => $collection) {
            $collections[$key] = $collection->toArray();
        }
        return response()->json($collections, 200);
    });
    Route::get("{uuid}", function (Request $request, string $uuid) {
        $collection = (new GetCollectionByUUIDController(new CollectionRequests))->handler($request, $uuid);
        return response()->json($collection->toArray(), 200);
    });
    Route::post("", function (Request $request) {
        $collection = (new CreateCollectionController(new CollectionRequests(), new CommunityRequests()))->handler($request);
        return response()->json($collection->toArray(), 200);
    });
    Route::put("{uuid}", function (Request $request, string $uuid) {
        $community = (new UpdateCollectionController(new CollectionRequests))->handler($request, $uuid);
        return response()->json($community->toArray(), 200);
    });
    Route::delete("{uuid}", function (Request $request, string $uuid) {
        $response = (new DeleteCollectionController(new CollectionRequests))->handler($uuid);
        return response()->json(["message" => $response], 200);
    });
});





Route::group(["prefix" => "items"], function () {
    Route::get("", function (Request $request) {
        if ($request->has('collectionName')) {
            $items = (new GetItemsByCollectionController(new ItemRequests()))->handler($request);
            foreach ($items as $key => $item) {
                $items[$key] = $item->toArray();
            }
            return response()->json($items, 200);
        }
        if ($request->has('handle')) {
            $item = (new GetItemByHandleController(new ItemRequests()))->handler($request);
            return response()->json($item->toArray(), 200);
        }
        if ($request->has('name')) {
            $item = (new GetItemByNameController(new ItemRequests()))->handler($request);
            return response()->json($item->toArray(), 200);
        }
        $items = (new GetItemsController(new ItemRequests()))->handler($request);
        foreach ($items as $key => $item) {
            $items[$key] = $item->toArray();
        }
        return response()->json($items, 200);
    });
    Route::get("{uuid}", function (Request $request, string $uuid) {
        $item = (new GetItemByUUIDController(new ItemRequests))->handler($request, $uuid);
        return response()->json($item->toArray(), 200);
    });
    Route::post("", function (Request $request) {
        $item = (new CreateItemController(new CollectionRequests(), new ItemRequests()))->handler($request);
        return response()->json($item->toArray(), 200);
    });
    Route::put("{uuid}", function (Request $request, string $uuid) {
        $item = (new UpdateItemController(new ItemRequests))->handler($request, $uuid);
        return response()->json($item->toArray(), 200);
    });
    Route::delete("{uuid}", function (Request $request, string $uuid) {
        $response = (new DeleteItemController(new ItemRequests))->handler($uuid);
        return response()->json(["message" => $response], 200);
    });
});
