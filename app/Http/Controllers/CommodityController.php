<?php

namespace App\Http\Controllers;

use App\Commodity;
use App\Http\ErrorResponses\ResourceNotFoundError;
use App\Http\Requests\Commodity\StoreCommodityRequest;
use App\Http\Requests\Commodity\UpdateCommodityRequest;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CommodityController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')
            ->only([
                'store',
                'update',
                'destroy',
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

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
     * @param StoreCommodityRequest $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function store(StoreCommodityRequest $request)
    {
        $data = $request->validated();
        $user_id = Auth::id();
        $user = User::query()->find($user_id);
        $shop = $user->shop;

        if ($shop == null) {
            return (new ResourceNotFoundError())->response();
        }

        $commodity = new Commodity();
        $commodity->title = $data['title'];
        $commodity->shop_id = $shop->id;
        $commodity->save();

        return response()->json($commodity);
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
     * @param UpdateCommodityRequest $request
     * @param int $id
     * @return JsonResponse|Response
     */
    public function update(UpdateCommodityRequest $request, $id)
    {
        $data = $request->validated();
        $user_id = Auth::id();
        $user = User::query()->find($user_id);

        $shop = $user->shop;
        $commodity = $shop->commodities()->find($id);

        if ($commodity == null) {
            return (new ResourceNotFoundError())->response();
        }

        $commodity->title = $data['title'];
        return response()->json($commodity);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse|Response
     */
    public function destroy($id)
    {
        $user_id = Auth::id();
        $user = User::query()->find($user_id);
        $shop = $user->shop;
        if ($shop == null) {
            return (new ResourceNotFoundError())->response();
        }

        $commodity = $shop->commodities()->find($id);
        if ($commodity == null) {
            return (new ResourceNotFoundError())->response();
        }

        $commodity->delete();
        return response()->json([
            'msg' => 'ok',
        ]);
    }
}
