<div class="container bg-info my-3">
  <div class="row">
    <div class="d-flex my-2 mx-auto">
      <a class="btn btn-secondary mr-4" href="{{ route('carousel.index') }}">管理 Carousel</a>

      <div class="dropdown mr-4">
        <button type="button" class="btn btn-secondary dropdown-toggle" id="createCategoriesdropdownMenuOffset"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,5">
          新增商品
        </button>
        <div class="dropdown-menu" aria-labelledby="createCategoriesdropdownMenuOffset">
          <a class="dropdown-item" href="{{ route('product.categories.create')}}">新增商品類型</a>
          <a class="dropdown-item" href="{{ route('product.styles.create')}}">新增商品風格</a>
          <a class="dropdown-item" href="{{ route('product.create')}}">新增商品</a>
        </div>
      </div>

    </div>
  </div>
</div>