@extends('layouts.layout')

@section('title', '新增男性商品')

@section('main_content')

@include('administrators.nav')

<div class="container bg-secondary">
	<div class="row justify-content-center">
		<div class="col-md-10 my-5">
			<div class="card">
				<div class="card-header text-center">新增男性商品</div>
				@isset($createdSuccessfully)
				<div class="text-center text-danger">{{ $createdSuccessfully }}</div>
				@endisset

				<div class="card-body">
					<form action="{{ route('men.store') }}" method="POST" enctype="multipart/form-data">
						@csrf

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<label class="input-group-text" for="product_name" id="label_product_name">{{ __('text.ProductName') }}</label>
							</div>

							<input class="form-control" type="text" name="product_name" id="product_name" value="{{ old('product_name') }}" />
						</div>
						@error('product_name')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<label class="input-group-text" for="price" id="label_price">{{ __('text.Price') }}</label>
							</div>

							<input type="number" class="form-control" min="0" name="price" id="price" value="{{ old('price') }}" />
						</div>
						@error('price')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<label class="input-group-text" for="quantity" id="label_quantity">{{ __('text.Quantity') }}</label>
							</div>

							<input type="number" class="form-control" min="0" name="quantity" id="quantity" value="{{ old('quantity') }}" />
						</div>
						@error('quantity')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<label class="input-group-text" for="category" id="label_category">{{ __('text.Category') }}</label>
							</div>

							<select class="custom-select" id="category" name="category">
								<option disabled class="text-danger font-weight-bold">Choose...</option>
								<option value="top" {{ old('category') == 'top' ? 'selected' : ''}}>{{ __('text.Top') }}
								</option>
								<option value="bottom" {{ old('category') == 'bottom' ? 'selected' : ''}}>
									{{ __('text.Bottom') }}</option>
							</select>
						</div>
						@error('category')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<label class="input-group-text" for="style" id="label_style">風格</label>
							</div>

							<select class="custom-select" id="style" name="style">
								{{-- @foreach ($styles as $style)
                                <option value="{{ $style }}" {{ old('style') == $style ? 'selected' : ''}}>{{$style}}
								</option>
								@endforeach --}}
								@foreach ($styles as $key => $value)
								<option value="{{ $key }}" {{ old('style') == $key ? 'selected' : ''}}>{{$key}}
								</option>
								@endforeach
							</select>
						</div>
						@error('style')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<label class="input-group-text" for="is_sold" id="label_is_sold">{{ __('text.IsSold') }}</label>
							</div>

							<div class="input-group-text justify-content-between">
								<label class="input-group-text mr-2" for="determine">{{ __('text.Determine') }}</label>
								<input class="mr-4" type="radio" id="determine" name="is_sold" value='1'
									{{ old('is_sold') == 1 ? 'checked' : ''}}>

								<label class="input-group-text mr-2" for="deny">{{ __('text.Deny') }}</label>
								<input type="radio" id="deny" name="is_sold" value='0' {{ old('is_sold') == 0 ? 'checked' : ''}}>
							</div>
						</div>
						@error('is_sold')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<label class="input-group-text" for="img_main">主要圖片</label>
							</div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="img_main" id="img_main" aria-describedby="img_main">
								<label class="custom-file-label" for="img_main">選擇圖片</label>
							</div>
						</div>
						@error('img_main')
						<div class="alert alert-danger">{{ $message }}
						</div>
						@enderror

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<label class="input-group-text" for="img_2">圖片2</label>
							</div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="img_2" id="img_2" aria-describedby="img_2">
								<label class="custom-file-label" for="img_2">選擇圖片</label>
							</div>
						</div>
						@error('img_2')
						<div class="alert alert-danger">{{ $message }}
						</div>
						@enderror

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<label class="input-group-text" for="img_3">圖片3</label>
							</div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="img_3" id="img_3" aria-describedby="img_3">
								<label class="custom-file-label" for="img_3">選擇圖片</label>
							</div>
						</div>
						@error('img_3')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<label class="input-group-text" for="img_4">圖片4</label>
							</div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="img_4" id="img_4" aria-describedby="img_4">
								<label class="custom-file-label" for="img_4">選擇圖片</label>
							</div>
						</div>
						@error('img_4')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<label class="input-group-text" for="img_5">圖片5</label>
							</div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="img_5" id="img_5" aria-describedby="img_5">
								<label class="custom-file-label" for="img_5">選擇圖片</label>
							</div>
						</div>
						@error('img_5')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror

						<button type="submit" class="btn btn-primary btn-lg btn-block my-2">{{ __('text.SaveBtn') }}</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection