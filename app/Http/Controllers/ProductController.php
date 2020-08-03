<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Style;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use PhpParser\Node\Expr\FuncCall;

class ProductController extends Controller
{
  public function __construct()
  {
    $this->middleware('verified')->except('');
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
    $this->authorize('viewAny', Product::class);

    $search_category_and_style_route = route('product.showSearch', '');

    if (session('createdSuccessfully')) {
      $createdSuccessfully = '新增商品成功';

      return view('products.create', compact('createdSuccessfully', 'search_category_and_style_route'));
    }
    return view('products.create', compact('search_category_and_style_route'));
  }

  public function showSearch($search)
  {
    switch ($search) {
      case 'gender':
        // select men's or women's categories
        $categories = Category::select('category')
          ->where([
            'gender' => request()->input('gender'),
          ])
          ->get();

        if (!empty($categories))
          return $categories;
        break;
      case 'category':
        $styles = Style::select('style')
          ->where([
            'gender' => request()->input('gender'),
            'category' => request()->input('category'),
          ])
          ->get();

        if (!empty($styles))
          return $styles;
        break;
    }

    return $search;
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

    $check = $this->newProduct();

    if ($check) {
      return redirect()->to(route('product.create'))->with(['createdSuccessfully' => true]);
    }
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

  public function createCategories()
  {
    $this->authorize('viewAny', Product::class);

    if (session('createdSuccessfully')) {
      $createdSuccessfully = '新增商品類別成功';

      return view('products.categories.create', compact('createdSuccessfully'));
    }

    return view('products.categories.create');
  }

  public function storeCategories()
  {
    $this->authorize('viewAny', Product::class);

    request()->validate([
      'gender' => 'required',
      'catogory' => 'required',
    ]);

    $data = Category::where([
      'gender' => request()->input('gender'),
      'category' => request()->input('catogory')
    ])
      ->get()->first();

    if (empty($data)) {
      $data = new Category(
        [
          'gender' => request()->input('gender'),
          'category' => request()->input('catogory')
        ]
      );
      $data->save();

      return redirect()->to(route('product.categories.create'))->with(['createdSuccessfully' => true]);
    } else {
      $errorMessage = '商品類別已存在';
      return view('products.categories.create', compact('errorMessage'));
    }
  }

  public function createStyles()
  {
    $this->authorize('viewAny', Product::class);

    $men_categories = Category::MenCategories()->get();
    $women_categories = Category::WomenCategories()->get();

    if (session('createdSuccessfully')) {
      $createdSuccessfully = '新增商品風格成功';

      return view('products.styles.create', compact('men_categories', 'women_categories', 'createdSuccessfully'));
    }

    return view('products.styles.create', compact('men_categories', 'women_categories'));
  }

  public function storeStyles()
  {
    $this->authorize('viewAny', Product::class);

    request()->validate([
      'gender' => 'required',
      'category' => 'required',
      'style' => 'required',
    ]);

    $data = Style::where([
      'gender' => request()->input('gender'),
      'category' => request()->input('category'),
      'style' => request()->input('style'),
    ])->get()->first();

    if (empty($data)) {
      $data = new Style([
        'gender' => request()->input('gender'),
        'category' => request()->input('category'),
        'style' => request()->input('style'),
      ]);
      $data->save();

      return redirect()->to(route('product.styles.create'))->with(['createdSuccessfully' => true]);
    } else {
      $errorMessage = '商品風格已存在';
      $men_categories = Category::MenCategories()->get();
      $women_categories = Category::WomenCategories()->get();

      return view('products.styles.create', compact('men_categories', 'women_categories', 'errorMessage'));
    }
  }

  private function newProduct()
  {
    if (!is_dir(public_path('/images'))) {
      mkdir(public_path('/images'), 0777);
    }

    $data = request()
      ->validate([
        'product_name' => 'required',
        'price' => 'required|min:0',
        'quantity' => 'required',
        'gender' => 'required',
        'category' => 'required',
        'style' => 'required',
        'is_sold' => 'required',
        'img_main' => 'required|image',
        'img_1' => 'sometimes|required|image',
        'img_2' => 'sometimes|required|image',
        'img_3' => 'sometimes|required|image',
        'img_4' => 'sometimes|required|image',
        'img_5' => 'sometimes|required|image',
        'img_6' => 'sometimes|required|image',
        'img_7' => 'sometimes|required|image',
        'img_8' => 'sometimes|required|image',
        'img_9' => 'sometimes|required|image',
      ]);

    $product = new Product(
      [
        'product_name' => $data['product_name'],
        'price' => $data['price'],
        'quantity' => $data['quantity'],
        'gender' => $data['gender'],
        'category' => $data['category'],
        'style' => $data['style'],
        'is_sold' => $data['is_sold'],
        'imgs' => '',
      ]
    );
    $product->save();

    $imgs_text = [
      'img_main' => 'empty',
      'img_main_thunbnail' => 'empty',
      'img_1' => 'empty',
      'img_2' => 'empty',
      'img_3' => 'empty',
      'img_4' => 'empty',
      'img_5' => 'empty',
      'img_6' => 'empty',
      'img_7' => 'empty',
      'img_8' => 'empty',
      'img_9' => 'empty',
    ];

    foreach ($imgs_text as $key => $value) {
      if (empty(request()->file($key)))
        continue;

      $img = request()->file($key);

      if ($key == 'img_main') {
        $imgs_text['img_main_thunbnail'] =  '/images/' . $product->id . '_img_main_thunbnail.' . request()->file($key)->getClientOriginalExtension();

        Image::make($img)
          ->crop(getimagesize($img)[0], getimagesize($img)[1], null, 0)
          ->fit(230, 284, null, 'top')
          ->text('練習使用', 110, 142, function ($font) {
            $font->file(public_path('mingliu.ttf'));
            $font->size(40);
            $font->color('#f00');
            $font->align('center');
            $font->valign('top');
          })
          ->save(public_path($imgs_text['img_main_thunbnail']));
      }

      $imgs_text[$key] = '/images/' . $product->id . '_' . $key . '.' . request()->file($key)->getClientOriginalExtension();

      Image::make($img)
        ->text('練習使用', getimagesize($img)[0] / 2, getimagesize($img)[1] / 2, function ($font) {
          $font->file(public_path('mingliu.ttf'));
          $font->size(100);
          $font->color('#f00');
          $font->align('center');
          $font->valign('top');
        })
        ->save(public_path($imgs_text[$key]));
    }

    $product->imgs = json_encode($imgs_text);
    $product->save();

    return true;
  }
}
