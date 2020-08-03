<?php

namespace App\Http\Controllers;

use App\Product;
use App\PurchaseCart;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseCartController extends Controller
{
  public function __construct()
  {
    $this->middleware('verified');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
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
    $data = $request->validate([
      'product_id' => 'required',
      'purchase_qty' => 'required|integer|min:1|max:10',
    ]);

    $user_id = auth()->user()->id;

    $product = Product::where('id', $data['product_id'])->first();

    // serch purchase_cats table to figure out that is there the same product that the user have already put into the cart.
    $serch = PurchaseCart::where([
      ['product_id', $data['product_id']],
      ['user_id', $user_id],
      ['is_purchased', false],
    ])->first();

    if ($serch == null) {
      // there is no the same product then create data into the purchase cart table.
      $purchase = new PurchaseCart([
        'product_id' => $data['product_id'],
        'user_id' => $user_id,
        'order_id' => 0,
        'purchase_quantity' => $data['purchase_qty'],
        'is_purchased' => false,
        'transport_method' => '',
      ]);
      $purchase->save();
    } else if ($product->quantity - $data['purchase_qty'] - $serch->purchase_quantity >= 0) {
      // there is the same product already exists in the table then increase the quantity.
      $serch->purchase_quantity = $serch->purchase_quantity + $data['purchase_qty'];
      $serch->save();
    }

    // grab some data from getPurchaseList function
    $purchase_lists = $this->getPurchaseList($user_id);

    return [
      'quantity' => $product->quantity,
      'purchase_lists' => $purchase_lists,
    ];
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $purchase_lists = $this->getPurchaseListWithImgMain(auth()->user()->id);

    return view('purchase_cart.show')->with($purchase_lists);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

    return view('purchase_cart.edit');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $request->validate([
      'change_purchase_quantity' => 'required|integer|min:1|max:100',
    ]);

    $user_id = auth()->user()->id;

    // modify user purchase product quantity
    $purchase_item_data = PurchaseCart::where([
      'id' => $id,
    ])
      ->first();
    $purchase_item_data['purchase_quantity'] = $request['change_purchase_quantity'];
    $purchase_item_data->save();

    // grab all user purchase data from getPurchaseList function
    $purchase_lists = $this->getPurchaseList($user_id);

    // grab the user modified data
    $update_data = DB::table('purchase_carts')
      ->select('products.id', 'products.product_name', 'purchase_carts.purchase_quantity', 'products.price')
      ->join('products', 'products.id', '=', 'purchase_carts.product_id')
      ->where([
        'purchase_carts.id' => $id,
        'user_id' => $user_id,
        'is_purchased' => 0,
      ])
      ->first();

    // culculate the amount ant the total quantities
    $total_amount = 0;
    $total_quantities = 0;
    for ($i = 0; $i < count($purchase_lists['purchase_lists']); $i++) {
      $total_amount += $purchase_lists['purchase_lists'][$i]->price * $purchase_lists['purchase_lists'][$i]->purchase_quantity;
      $total_quantities += $purchase_lists['purchase_lists'][$i]->purchase_quantity;
    }

    return [
      'purchase_lists' => $purchase_lists,
      'update_data' => $update_data,
      'total_amount' => $total_amount,
      'total_quantities' => $total_quantities,
    ];
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    PurchaseCart::where('id', $id)->delete();

    // grab all user purchase data from getPurchaseList function
    $user_id = auth()->user()->id;
    $purchase_lists = $this->getPurchaseList($user_id);

    // culculate the amount ant the total quantities
    $total_amount = 0;
    $total_quantities = 0;
    for ($i = 0; $i < count($purchase_lists['purchase_lists']); $i++) {
      $total_amount += $purchase_lists['purchase_lists'][$i]->price * $purchase_lists['purchase_lists'][$i]->purchase_quantity;
      $total_quantities += $purchase_lists['purchase_lists'][$i]->purchase_quantity;
    }

    return [
      'delete_massage' => 'delete the item successfull',
      'delete cart id' => $id,
      'user_id' => auth()->user()->id,
      'purchase_lists' => $purchase_lists,
      'total_amount' => $total_amount,
      'total_quantities' => $total_quantities,
    ];
  }

  public function getPurchaseList($user_id)
  {
    $purchase_lists = DB::table('purchase_carts')
      ->select('products.id', 'products.product_name', 'purchase_carts.purchase_quantity', 'products.price')
      ->join('products', 'products.id', '=', 'purchase_carts.product_id')
      ->where([
        'user_id' => $user_id,
        'is_purchased' => 0,
      ])
      ->get();

    return [
      'purchase_lists' => $purchase_lists,
    ];
  }

  public function getPurchaseListWithImgMain($user_id)
  {
    $purchase_lists = DB::table('purchase_carts')
      ->select('products.id AS products_id', 'purchase_carts.id AS purchase_carts_id', 'products.product_name', 'purchase_carts.purchase_quantity', 'products.imgs', 'products.price')
      ->join('products', 'products.id', '=', 'purchase_carts.product_id')
      ->where([
        'user_id' => $user_id,
        'is_purchased' => 0,
      ])
      ->get();

    foreach ($purchase_lists as $item) {
      $item->imgs = json_decode($item->imgs)->img_main_thunbnail;
    }

    return [
      'purchase_lists' => $purchase_lists,
    ];
  }
}
