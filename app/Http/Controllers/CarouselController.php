<?php

namespace App\Http\Controllers;

use App\Carousel;
use App\Product;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->authorize('viewAny', Product::class);

    $carousel_store_route = route('carousel.store');
    $carousel_data = Carousel::get();
    return view('carousel.index', compact('carousel_data', 'carousel_store_route'));
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
    $this->authorize('viewAny', Product::class);

    // determine whether the image folder exists.
    if (!is_dir(public_path('/images'))) {
      mkdir(public_path('/images'), 0777);
    }

    foreach ($request->input() as $key => $value) {
      switch ($key) {
        case 'carousel_1_checked':
          $this->createOrUpdateCarousel(1);
          break;
        case 'carousel_2_checked':
          $this->createOrUpdateCarousel(2);
          break;
        case 'carousel_3_checked':
          $this->createOrUpdateCarousel(3);
          break;
      }
    }

    $carousel_data = Carousel::get();
    return view('carousel.index', compact('carousel_data'));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Carousel  $carousel
   * @return \Illuminate\Http\Response
   */
  public function show(Carousel $carousel)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Carousel  $carousel
   * @return \Illuminate\Http\Response
   */
  public function edit(Carousel $carousel)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Carousel  $carousel
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Carousel $carousel)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Carousel  $carousel
   * @return \Illuminate\Http\Response
   */
  public function destroy(Carousel $carousel)
  {
    //
  }

  // create or update carousel
  private function createOrUpdateCarousel($carousel_id)
  {
    $data = request()->validate([
      'img_carousel_' . $carousel_id => 'required|image',
      'product_' . $carousel_id . '_url' => 'required|url',
    ]);
    $carousel = Carousel::where([
      'id' => $carousel_id,
    ])->first();

    if (isset($carousel)) {
      $carousel->image = $data['img_carousel_' . $carousel_id];
      $carousel->product_url = $data['product_' . $carousel_id . '_url'];

      $img = request()->file('img_carousel_' . $carousel_id);

      $original = '/images/img_carousel_' . $carousel_id . '.' . $img->getClientOriginalExtension();

      $img->move(public_path('/images'), $original);

      $carousel->image = $original;

      $carousel->save();
    } else {
      $carousel = new Carousel([
        'id' => $carousel_id,
        'image' => $data['img_carousel_' . $carousel_id],
        'product_url' => $data['product_' . $carousel_id . '_url'],
      ]);

      $img = request()->file('img_carousel_' . $carousel_id);

      $original = '/images/img_carousel_' . $carousel_id . '.' . $img->getClientOriginalExtension();

      $img->move(public_path('/images'), $original);

      $carousel->image = $original;

      $carousel->save();
    }
  }
}
