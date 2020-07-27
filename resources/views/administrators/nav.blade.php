<div class="container bg-info my-3">
    <div class="row">
        <div class="d-flex my-2 mx-auto">
            <a class="btn btn-secondary mr-4" href="{{ route('carousel.index') }}">管理 Carousel</a>
            
            <div class="dropdown mr-4">
                <button type="button" class="btn btn-secondary dropdown-toggle" id="dropdownMenuOffset"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,5">
                    新增商品
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                    <a class="dropdown-item" href="{{ route('men.create')}}">Man</a>
                    <a class="dropdown-item" href="#">Woman</a>
                </div>
            </div>
        </div>
    </div>
</div>