<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class MenController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$products = Product::MenProducts()->get();

		return view('men.index', compact('products'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('viewAny', Product::class);

		$styles = $this->getShirtStyles();

		return view('men.create', compact('styles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->authorize('viewAny', Product::class);

		if (!is_dir(public_path('/images'))) {
			mkdir(public_path('/images'), 0777);
		}

		$product = new Product(request()->validate([
			'product_name' => 'required',
			'price' => 'required|min:0',
			'quantity' => 'required',
			'category' => 'required',
			'style' => 'required',
			'is_sold' => 'required',
			'img_main' => 'required|image',
			'img_2' => 'sometimes|required|image',
			'img_3' => 'sometimes|required|image',
			'img_4' => 'sometimes|required|image',
			'img_5' => 'sometimes|required|image',
		]));

		$product->gender = 'men';

		$imgs = [
			'img_main',
			'img_2',
			'img_3',
			'img_4',
			'img_5',
		];

		$product->save();

		foreach ($imgs as $img) {
			if (empty(request()->file($img))) {
				continue;
			}
			$img_name = $img;

			$img = request()->file($img);

			$original = '/images/' . $product->id . '_' . $img_name . '.' . $img->getClientOriginalExtension();

			switch ($img_name) {
				case "img_main":
					$img_main_thumbnail = $product->id . '_img_main_thunbnail.' . $img->getClientOriginalExtension();
					Image::make($img)
						->crop(760, 500, null, 0)
						->fit(230, 284, null, 'top')
						->text('test', 110, 142, function ($font) {
							$font->size(12);
							$font->color('#f00');
							$font->align('center');
							$font->valign('top');
						})
						->save(public_path('/images/') . $img_main_thumbnail);
					$product->img_main_thumbnail = '/images/' . $img_main_thumbnail;
					$product->img_main = $original;
					break;
				case "img_2":
					$product->img_2 = $original;
					break;
				case "img_3":
					$product->img_3 = $original;
					break;
				case "img_4":
					$product->img_4 = $original;
					break;
				case "img_5":
					$product->img_5 = $original;
					break;
			}
			$img->move(public_path('/images'), $original);
		}

		$product->save();

		$createdSuccessfully = 'Created Successfully';

		$styles = $this->getShirtStyles();

		return view('men.create', compact('createdSuccessfully', 'styles'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function show(Product $product)
	{
		//
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
		//
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

	/**
	 * Tops/oxfords page
	 */
	public function showOxfords()
	{
		$products = Product::MenOxfords()->get();
		return view('men.tops.oxfords', compact('products'));
	}

	/**
	 * Tops/oxfords page
	 */
	public function showBusinesses()
	{
		dd('hit showBusinesses');

		// $products = Product::MenOxfords()->get();
		// return view('men.tops.oxfords', compact('products'));
	}

	/**
	 * Tops/oxfords page
	 */
	public function showCasuals()
	{
		dd('hit showCasuals');

		// $products = Product::MenOxfords()->get();
		// return view('men.tops.oxfords', compact('products'));
	}

	public function getAllcategories()
	{
		return [
			$this->getShirtStyles(),
			$this->getBottoms(),
		];
	}

	private function getShirtStyles()
	{
		return [
			'襯衫類' => '',
			'牛津襯衫' => route('men.tops.oxfords'),
			'商務襯衫' => route('men.tops.businesses'),
			'休閒襯衫' => route('men.tops.casuals'),
		];
	}

	private function getBottoms()
	{
		return [
			'下身類' => '',
			'卡其/休閒長褲' => '卡其/休閒長褲 test url',
			'牛仔褲' => '牛仔褲 test url',
		];
	}
}
