<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	public function __construct()
	{
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		// return view('product.create');
		// return redirect()->back();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		dd('product store');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function show(Product $product)
	{
		return view('products.show', compact('product'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Product $product)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Product $product)
	{
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Product $product)
	{
		//
	}

	public function createMenTops()
	{
		$this->authorize('viewAny', Product::class);

		// dd('hit createMenTops');
		$styles = [
			'請選擇服飾風格...',
			'牛津襯衫',
			'商務襯衫',
			'休閒襯衫',
		];

		return view('products.men.tops.create', compact('styles'));
	}

	public function storeMenTops()
	{
		$this->authorize('viewAny', Product::class);

		$this->newProduct();

		dd('hit storeMenTops');
	}


	private function newProduct()
	{
		if (!is_dir(public_path('/images'))) {
			mkdir(public_path('/images'), 0777);
		}

		// request()
		// 	->validate([
		// 		'product_name' => 'required',
		// 		'price' => 'required|min:0',
		// 		'quantity' => 'required',
		// 		'category' => 'required',
		// 		'style' => 'required',
		// 		'is_sold' => 'required',
		// 		'img_main' => 'required|image',
		// 		'img_2' => 'sometimes|required|image',
		// 		'img_3' => 'sometimes|required|image',
		// 		'img_4' => 'sometimes|required|image',
		// 		'img_5' => 'sometimes|required|image',
		// 		'img_6' => 'sometimes|required|image',
		// 		'img_7' => 'sometimes|required|image',
		// 		'img_8' => 'sometimes|required|image',
		// 		'img_9' => 'sometimes|required|image',
		// 		'img_10' => 'sometimes|required|image',
		// 	]);

		if (request()->input('img_4') != null) {
			dd('image_4 show up');
		}

		// $product = new Product(
		// 	request()
		// 		->validate([
		// 			'product_name' => 'required',
		// 			'price' => 'required|min:0',
		// 			'quantity' => 'required',
		// 			'category' => 'required',
		// 			'style' => 'required',
		// 			'is_sold' => 'required',
		// 			'img_main' => 'required|image',
		// 			'img_2' => 'sometimes|required|image',
		// 			'img_3' => 'sometimes|required|image',
		// 			'img_4' => 'sometimes|required|image',
		// 			'img_5' => 'sometimes|required|image',
		// 		])
		// );

		// dump('in new product function');
		// dd(request()->input());
	}
}
