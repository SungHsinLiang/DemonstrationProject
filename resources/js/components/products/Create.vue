<template>
	<div class="container py-2 my-3">
		<div class="card col-md-10 my-5 mx-auto px-0">
			<div class="card-header text-center">
				新增商品
			</div>

			<div class="card-body">
				<form
					id="form"
					:action="this.product_store"
					method="POST"
					enctype="multipart/form-data"
				>
					<input type="hidden" name="_token" id="token" />

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<label
								class="input-group-text"
								for="product_name"
								id="label_product_name"
								>產品名稱</label
							>
						</div>

						<input
							class="form-control"
							type="text"
							name="product_name"
							id="product_name"
							placeholder="請輸入產品名稱"
							:value="jpOlds['product_name']"
							v-if="jpOlds['product_name'] != null"
						/>
						<input
							class="form-control"
							type="text"
							name="product_name"
							id="product_name"
							placeholder="請輸入產品名稱"
							value
							v-else
						/>
					</div>
					<div
						class="alert alert-danger"
						v-if="jpErrors['product_name'] != null"
					>
						{{ jpErrors["product_name"][0] }}
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<label class="input-group-text" for="gender" id="label_gender"
								>商品歸屬性別</label
							>
						</div>

						<select class="custom-select" id="gender" name="gender">
							<option disabled selected>請選擇商品歸屬性別</option>
							<option value="men">Men</option>
							<option value="women">Women</option>
						</select>
					</div>
					<div class="alert alert-danger" v-if="jpErrors['gender'] != null">
						{{ jpErrors["gender"][0] }}
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<label class="input-group-text" for="price" id="label_price"
								>單價</label
							>
						</div>

						<input
							type="number"
							class="form-control"
							min="0"
							name="price"
							id="price"
							placeholder="請輸入單價"
							:value="jpOlds['price']"
							v-if="this.jpOlds['price'] != null"
						/>
						<input
							type="number"
							class="form-control"
							min="0"
							name="price"
							id="price"
							placeholder="請輸入單價"
							value
							v-else
						/>
					</div>
					<div class="alert alert-danger" v-if="jpErrors['price'] != null">
						{{ jpErrors["price"][0] }}
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<label class="input-group-text" for="quantity" id="label_quantity"
								>商品總數</label
							>
						</div>

						<input
							type="number"
							class="form-control"
							min="0"
							name="quantity"
							id="quantity"
							placeholder="請輸入新商品總數量"
							:value="jpOlds['quantity']"
							v-if="this.jpOlds['quantity'] != null"
						/>
						<input
							type="number"
							class="form-control"
							min="0"
							name="quantity"
							id="quantity"
							placeholder="請輸入新商品總數量"
							value
							v-else
						/>
					</div>
					<div class="alert alert-danger" v-if="jpErrors['quantity'] != null">
						{{ jpErrors["quantity"][0] }}
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<label class="input-group-text" for="category" id="label_category"
								>商品類型</label
							>
						</div>

						<select class="custom-select" id="category" name="category">
							<option disabled selected>請先選取商品歸屬性別</option>
						</select>
					</div>
					<div class="alert alert-danger" v-if="jpErrors['category'] != null">
						{{ jpErrors["category"][0] }}
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<label class="input-group-text" for="style" id="label_style"
								>商品風格</label
							>
						</div>

						<select class="custom-select" id="style" name="style">
							<option disabled selected>請先選取商品類型</option>
						</select>
					</div>
					<div class="alert alert-danger" v-if="jpErrors['style'] != null">
						{{ jpErrors["style"][0] }}
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<label class="input-group-text" for="is_sold" id="label_is_sold"
								>販賣許可</label
							>
						</div>

						<div class="input-group-text justify-content-between">
							<label class="input-group-text mr-2" for="determine">確定</label>
							<input
								class="mr-4"
								type="radio"
								id="determine"
								name="is_sold"
								value="1"
								checked
								v-if="this.jpOlds['is_sold'] == 1"
							/>
							<input
								class="mr-4"
								type="radio"
								id="determine"
								name="is_sold"
								value="1"
								v-else
							/>

							<label class="input-group-text mr-2" for="deny">稍後</label>
							<input
								type="radio"
								id="deny"
								name="is_sold"
								value="0"
								checked
								v-if="this.jpOlds['is_sold'] == 0"
							/>
							<input type="radio" id="deny" name="is_sold" value="0" v-else />
						</div>
					</div>
					<div class="alert alert-danger" v-if="jpErrors['is_sold'] != null">
						{{ jpErrors["is_sold"][0] }}
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<label class="input-group-text" for="img_main">主要圖片</label>
						</div>
						<div class="custom-file">
							<input
								type="file"
								class="custom-file-input"
								name="img_main"
								id="img_main"
								aria-describedby="img_main"
							/>
							<label class="custom-file-label" for="img_main">選擇圖片</label>
						</div>
					</div>
					<div class="alert alert-danger" v-if="jpErrors['img_main'] != null">
						{{ jpErrors["img_main"][0] }}
					</div>

					<div class="input-group mb-2">
						<button
							class="btn-primary btn-lg btn-block my-2 col-5 mx-auto"
							id="addImageBtn"
							v-on:click="addImage()"
						>
							增加圖片
						</button>
						<button
							class="btn-danger btn-lg btn-block my-2 col-5 mx-auto"
							id="deleteImageBtn"
							v-on:click="deleteImage()"
						>
							刪除最後一張圖片
						</button>
					</div>

					<button
						type="submit"
						class="btn btn-primary btn-lg btn-block my-2"
						id="submitBtn"
					>
						submit
					</button>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: ["product_store", "errors", "olds", "search_category_and_style_route"],

	data: function() {
		return {
			jpErrors: "",
			jpOlds: ""
		};
	},

	mounted() {
		var _token = document.querySelector('meta[name="csrf-token"]').content;
		document.getElementById("token").value = _token;

		document.getElementById("addImageBtn").addEventListener("click", e => {
			e.preventDefault();
		});

		document.getElementById("deleteImageBtn").addEventListener("click", e => {
			e.preventDefault();
		});

		document.getElementById("img_main").addEventListener("change", e => {
			chooseFileName("img_main", e);
		});

		document.getElementById("gender").addEventListener("change", e => {
			document.getElementById("style").innerHTML =
				"<option disabled selected>請先選取商品類型</option>";
			console.log(this.search_category_and_style_route);
			var searchtext =
				this.search_category_and_style_route +
				"/gender?gender=" +
				document.getElementById("gender").value;
			console.log(searchtext);
			axios
				.get(searchtext, {})
				.then(res => {
					console.log(res.data);
					var category_text =
						"<option disabled selected>請選擇商品類型</option>";

					document.getElementById("category").innerHTML = "";
					res.data.forEach(element => {
						category_text +=
							"<option value=" +
							element["category"] +
							">" +
							element["category"] +
							"</option>";
					});
					document.getElementById("category").innerHTML = category_text;
				})
				.catch(err => console.error(err));
		});

		document.getElementById("category").addEventListener("change", e => {
			// alert(document.getElementById("gender").value);
			console.log(this.search_category_and_style_route);
			var searchtext =
				this.search_category_and_style_route +
				"/category?gender=" +
				document.getElementById("gender").value +
				"&category=" +
				document.getElementById("category").value;
			console.log(searchtext);
			axios
				.get(searchtext, {})
				.then(res => {
					console.log(res.data);
					console.log(res.data.length);
					if (res.data.length == 0) {
						console.log("請先新增商品風格");
						document.getElementById("style").innerHTML =
							"<option disabled selected>無任何商品風格，請先新增商品風格</option>";
					} else {
						var style_text =
							"<option disabled selected>請選擇商品風格</option>";

						document.getElementById("style").innerHTML = "";
						res.data.forEach(element => {
							style_text +=
								"<option value=" +
								element["style"] +
								">" +
								element["style"] +
								"</option>";
						});
						document.getElementById("style").innerHTML = style_text;
					}
				})
				.catch(err => console.error(err));
		});

		this.jpErrors = JSON.parse(this.errors);
		this.jpOlds = JSON.parse(this.olds);
	},

	methods: {
		addImage() {
			console.log("in addImage function");

			var imgs = document.querySelectorAll("[id^=img_]");

			console.log(imgs.length);
			imgs.forEach(element => {
				console.log(element);
			});
			var img_html = "";
			img_html += "<div class='input-group mb-2'>";
			img_html += "<div class='input-group-prepend'>";
			img_html +=
				"<label class='input-group-text' for='img_" +
				imgs.length +
				"'>圖片" +
				imgs.length +
				"</label>";
			img_html += "</div>";
			img_html += "<div class='custom-file'>";
			img_html +=
				"<input type='file' class='custom-file-input' name='img_" +
				imgs.length +
				"' id='img_" +
				imgs.length +
				"' aria-describedby='img_" +
				imgs.length +
				"' />";
			img_html +=
				"<label class='custom-file-label' for='img_" +
				imgs.length +
				"'>選擇圖片</label>";
			img_html += "</div>";
			img_html += "</div>";

			var newNode = document.createElement("div");
			var parentNode = document.getElementById("form");
			var submitBtn = document.getElementById("submitBtn");
			parentNode.insertBefore(newNode, submitBtn);
			newNode.innerHTML = img_html;
			newNode.id = "div_image_" + imgs.length;

			document
				.getElementById("img_" + imgs.length)
				.addEventListener("change", e => {
					chooseFileName("img_" + imgs.length, e);
				});
		},

		deleteImage() {
			var div_images = document.querySelectorAll("[id^=div_image_]");
			var lastNode = div_images[div_images.length - 1];
			if (div_images.length - 1 < 0) return;
			console.log(lastNode);
			var parentNode = document.getElementById("form");
			parentNode.removeChild(lastNode);
		}
	}
};

function chooseFileName(idname, e) {
	var fileName = document.getElementById(idname).files[0].name;
	var nextSibling = e.target.nextElementSibling;
	nextSibling.innerText = fileName;
}
</script>

<style scoped></style>
