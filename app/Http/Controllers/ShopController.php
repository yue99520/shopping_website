<?php

namespace App\Http\Controllers;

use App\Exceptions\ShopAlreadyCreatedException;
use App\Http\Requests\Shop\StoreShopRequest;
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
     * @return Response
     */
    public function index()
    {
        //
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

        if (User::query()->find($user_id)->shop != null) {
            return response()->json([
                'msg' => 'Your shop has been created before.',
            ]);
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
     * @return Response
     */
    public function show($id)
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
