<template>
	<div class="container bg-secondary">
		<div class="row justify-content-center">
			<div class="col-md-10 my-5">
				<div class="card">
					<div class="card-header text-center">
						新增男性上衣類商品
					</div>

					<div class="card-body">
						<form
							id="form"
							:action="this.product_men_tops_create"
							method="POST"
							enctype="multipart/form-data"
						>
							<input type="hidden" name="_token" id="token" />
							<input type="hidden" name="gender" value="men" />

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
									value
									placeholder="請輸入產品名稱"
								/>
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
									value
									placeholder="請輸入單價"
								/>
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<label
										class="input-group-text"
										for="quantity"
										id="label_quantity"
										>商品總數</label
									>
								</div>

								<input
									type="number"
									class="form-control"
									min="0"
									name="quantity"
									id="quantity"
									value
									placeholder="請輸入新商品總數量"
								/>
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<label class="input-group-text" for="style" id="label_style"
										>風格</label
									>
								</div>

								<select class="custom-select" id="style" name="style">
									<option selected disabled>請選擇服飾風格...</option>
								</select>
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<label
										class="input-group-text"
										for="is_sold"
										id="label_is_sold"
										>販賣許可</label
									>
								</div>

								<div class="input-group-text justify-content-between">
									<label class="input-group-text mr-2" for="determine"
										>確定</label
									>
									<input
										class="mr-4"
										type="radio"
										id="determine"
										name="is_sold"
										value="1"
									/>

									<label class="input-group-text mr-2" for="deny">稍後</label>
									<input type="radio" id="deny" name="is_sold" value="0" />
								</div>
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<label class="input-group-text" for="img_main"
										>主要圖片</label
									>
								</div>
								<div class="custom-file">
									<input
										type="file"
										class="custom-file-input"
										name="img_main"
										id="img_main"
										aria-describedby="img_main"
									/>
									<label class="custom-file-label" for="img_main"
										>選擇圖片</label
									>
								</div>
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
		</div>
	</div>
</template>

<script>
export default {
	props: ["product_men_tops_create", "styles"],

	data: function() {
		return {
			jpStyles: ""
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

		this.jpStyles = JSON.parse(this.styles);

		var style_text = "";
		this.jpStyles.forEach((element, index) => {
			console.log(element, index);
			if (index == 0) {
				style_text = "<option selected disabled>" + element + "</option>";
			} else {
				style_text += "<option value=" + element + ">" + element + "</option>";
			}
		});

		document.getElementById("style").innerHTML = style_text;
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
