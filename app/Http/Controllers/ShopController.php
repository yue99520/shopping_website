<?php

namespace App\Http\Controllers;

use App\Http\ErrorResponses\ResourceAlreadyExistError;
use App\Http\ErrorResponses\ResourceNotFoundError;
use App\Http\Requests\Shop\StoreShopRequest;
use App\Http\Requests\Shop\UpdateShopRequest;
use App\Shop;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $shops = Shop::query()->get();
        return response()->json($shops);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreShopRequest $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function store(StoreShopRequest $request)
    {
        $data = $request->validated();

        $user_id = Auth::id();

        $is_exist = Shop::query()->where('user_id', $user_id)->exists();

        if ($is_exist) {
            return ResourceAlreadyExistError::response();
        }

        $shop = new Shop();
        $shop->user_id = $user_id;
        $shop->title = $data['title'];
        $shop->save();

        return response()->json($shop);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function show($id)
    {
        $shop = Shop::query()->find($id);

        if ($shop == null) {
            return ResourceNotFoundError::response();
        }

        return response()->json($shop);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateShopRequest $request
     * @param int $id
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function update(UpdateShopRequest $request, $id)
    {
        $data = $request->validated();
        $user_id = Auth::id();

        $shop = Shop::query()->where('user_id', $user_id)->find($id);
        if ($shop == null) {
            return ResourceNotFoundError::response();
        }

        $shop->title = $data['title'];
        $shop->save();
        return response()->json($shop->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function destroy($id)
    {
        $user_id = Auth::id();
        $shop = Shop::query()
            ->where('user_id', $user_id)
            ->find($id);

        if ($shop == null) {
            return ResourceNotFoundError::response();
        }

        $shop->delete();
        return response()->json([
            'msg' => 'ok'
        ]);
    }
}
