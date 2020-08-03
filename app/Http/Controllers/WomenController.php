<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Style;
use Illuminate\Http\Request;

class WomenController extends Controller
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
    $products = Product::WomenProducts()->get();

    return view('women.index', compact('products'));
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
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
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
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }

  public function getAllcategories()
  {
    $categories = Category::WomenCategories()->get();
    $styles = Style::WomenStyles()->get();

    $search_category_and_style_route = route('women.search', '');

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

    return view('women.search', compact('products'));
  }
}
