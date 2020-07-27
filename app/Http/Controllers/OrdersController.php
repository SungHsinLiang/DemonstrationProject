<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\PurchaseCart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\support\facades\DB;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd([
        //     'orders_index_function' => 'index message',
        //     'user_id' => auth()->user()->id,
        // ]);

        return view('orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $transport_method = $request->input('transport_method');
        DB::transaction(function () use ($user_id, $transport_method) {
            $new_order = new Order();
            $new_order->user_id = $user_id;
            $new_order->pay_way = '';
            $new_order->order_price = 0;
            $new_order->is_settled = 0;
            $new_order->save();

            $order_price = 0;

            $carts = PurchaseCart::where([
                'user_id' => $user_id,
                'is_purchased' => 0,
            ])->lockForUpdate()->get();
            
            if ($carts->count() <= 0){
                throw new Exception('carts count less than 1');
            }

            // modify the product quantity and purchase cart's is_purchased column from 0 to 1
            foreach ($carts as $cart) {
                $product = Product::where([
                    'id' => $cart->product_id,
                ])->lockForUpdate()->first();

                if (($product->quantity - $cart->purchase_quantity) < 0) {
                    $m = $product->quantity - $cart->purchase_quantity;
                    throw new Exception($m);
                }

                $order_price += $product->price * $cart->purchase_quantity;

                $product->quantity -= $cart->purchase_quantity;
                $product->save();

                $cart->order_id = $new_order->id;
                $cart->is_purchased = 1;
                $cart->transport_method = $transport_method;
                $cart->save();
            }

            $new_order->user_id = $user_id;
            $new_order->pay_way = '';
            $new_order->order_price = $order_price;
            $new_order->is_settled = 0;
            $new_order->save();
        });

        // use an event to send an email to inform user that placing an order successfully.
        // Mail::to(auth()->user()->email)->send(new PlaceAnOrderSuccessfully());

        // user place an order successful
        // redirect user to show order list page
        return [
            // 'redirect_route' => route('home'),
            'place_the_order_successfully_route' => route('orders.success'),
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($order)
    {
        $user_id = auth()->user()->id;
        // query user's order
        // $order_lists = PurchaseCart::select('product_id', 'purchase_quantity')
        //     ->where([
        //         'user_id' => $user_id,
        //         'order_id' => $order,
        //     ])
        //     ->get();
        $order_lists = PurchaseCart::select('products.id', 'products.product_name', 'products.img_main_thumbnail', 'purchase_carts.purchase_quantity', 'products.price')
            ->join('products', 'products.id', '=', 'purchase_carts.product_id')
            ->where([
                'order_id' => $order,
                'user_id' => $user_id,
            ])
            ->get();

        // dd([
        //     'oders_show_function' => 'hit oders show function',
        //     'user_id' => $user_id,
        //     'order_id' => $order,
        //     'order_lists' => $order_lists,
        // ]);

        // return [
        //     'orders_show_function' => 'test data',
        // ];
        
        return view('orders.show', compact('order_lists'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function success()
    {
        // dd([
        //     'orders_success_function' => 'successful message',
        //     'user_id' => auth()->user()->id,
        // ]);

        return view('orders.success');
    }

    public function getLists()
    {
        $user_id = auth()->user()->id;
        
        // $orders_lists = Order::select('*')
        $orders_lists = Order::select('created_at', 'id', 'order_price')
        ->where([
            'user_id' => $user_id,
        ])
        ->get();
        
        return [
            'orders_lists' => $orders_lists,
            
        ];
    }
}