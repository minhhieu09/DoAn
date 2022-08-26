<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Services\StoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use App\Services\ProductService;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class StoreController extends Controller
{
    public $productService;
    public $storeService;

    public function __construct(
        ProductService $productService,
        StoreService $storeService
    )
    {
        $this->productService = $productService;
        $this->storeService = $storeService;
    }

    public function index()
    {
//        dd($this->productService->insert(1));
        return view('store.index');
    }

    public function table()
    {
        return DataTables::of(DB::table('product')->get())->make(true);
    }

    public function addCart(Request $request)
    {
//        dd(Session::get('cart'));
        $dataRequest = $request->all();
        $dataRequest['time'] = strtotime(now());

        $this->storeService->addCart($dataRequest, $dataRequest['id']);

        return response()->json(Session::get('cart'));
    }

    public function getCartSession()
    {
//        return Session::flush();
        if (Session::has('cart')) {
            return response()->json(Session::get('cart'));
        }

        return response()->json();
    }

    public function removeCart()
    {
        $data = Session::get('cart');
        unset($data[6]);
    }

    public function detail()
    {
        Breadcrumbs::register('continent', function ($breadcrumbs) {
            $breadcrumbs->push('Home', route(STORE));
            $breadcrumbs->push('ten san pham', route(STORE_PRODUCT_DETAIL));
        });

        return view('store.detail');
    }

    public function sendMail()
    {
        try {
            Mail::to('hung.vu2@ntq-solution.com.vn')->send(new VerifyEmail('test email'));
            return 'send oke';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
