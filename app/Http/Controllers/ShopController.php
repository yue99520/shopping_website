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
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ShopController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only([
            'store',
            'destroy',
            'edit',
            'create',
            'update',
            'dashboard',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|JsonResponse|View
     */
    public function index()
    {
        $shops = Shop::query()->get();
        return view('shop.list.index', ['shops' => $shops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function create()
    {
        $user_id = Auth::id();
        $shop = Shop::query()->where('user_id', $user_id)->first();

        if ($shop != null) {
            return redirect(route('shop.dashboard'));
        }

        $user = User::query()->findOrFail($user_id);
        return view('shop.manage.create', [
            'user' => $user,
        ]);
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
        $shop->description = $data['description'];
        $shop->image = null;
        $shop->save();

        if (isset($data['image'])) {
            $this->updateImage($shop, $data['image']);
        }

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

        return view('shop.show', [
            'shop' => $shop
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|Response|View
     */
    public function edit($id)
    {
        $user_id = Auth::id();
        $shop = Shop::query()->where('user_id', $user_id)->find($id);

        if ($shop == null) {
            return redirect(route('shop.dashboard'));
        }

        return view('shop.manage.edit', [
            'shop' => $shop,
        ]);
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

        if (isset($data['title'])) {
            $shop->title = $data['title'];
        }

        if (isset($data['description'])) {
            $shop->description = $data['description'];
        }

        $shop->save();

        if (isset($data['image'])) {
            $this->updateImage($shop, $data['image']);
        }

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

    public function dashboard()
    {
        $user_id = Auth::id();
        $user = User::query()->find($user_id);
        $shop = $user->shop;

        return view('shop.manage.dashboard', [
            'shop' => $shop
        ]);
    }

    private function updateImage(Shop $shop, UploadedFile $image)
    {
        $path = '/shop/';
        $fileSystem = Storage::disk('public');
        $fileSystem->makeDirectory('/shop');

        if ($fileSystem->put($path, $image)) {

            if ($fileSystem->exists($shop->image)) {
                $fileSystem->delete($shop->image);
            }

            $shop->image = $path . $image->hashName();
            $shop->save();
        }
    }
}
