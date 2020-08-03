<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Style;
use Illuminate\Http\Request;

class MenController extends Controller
{
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
    //
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

  public function getAllcategories()
  {
    $categories = Category::MenCategories()->get();
    $styles = Style::MenStyles()->get();

    $search_category_and_style_route = route('men.search', '');

    return [
      'categories' => $categories,
      'styles' => $styles,
      'search_category_and_style_route' => $search_category_and_style_route
    ];
  }

  public function search()
  {
    $products = Product::where([
      'gender' => request()->input('gender'),
      'category' => request()->input('category'),
      'style' => request()->input('style'),
      'is_sold' => '1',
      ['quantity', '>', '0'],
    ])->inRandomOrder()->get();

    return view('men.search', compact('products'));
  }
}
