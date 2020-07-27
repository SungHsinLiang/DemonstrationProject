<template>
	<div class="container bg-secondary">
		<div class="row justify-content-center">
			<div class="col-12 my-5">
				<div class="card">
					<div class="card-header text-center">管理 Carousel</div>

					<div class="card-body">
						<form
							action="http://127.0.0.1:8000/carousel"
							method="POST"
							enctype="multipart/form-data"
						>
							<input type="hidden" name="_token" id="token" />

							<div class="input-group mb-2">
								<img class="my-2 mx-auto" id="carousel_img_1" width="772" />

								<div class="input-group-prepend col-7">
									<div class="input-group-text">
										<label class="my-auto mr-2" for="carousel_1_checked"
											>修改確認 :</label
										>
										<input
											type="checkbox"
											id="carousel_1_checked"
											name="carousel_1_checked"
										/>
									</div>

									<label class="input-group-text" for="product_1_url"
										>圖片連結網址 :</label
									>
									<input
										class="p-2 w-100"
										type="text"
										id="product_1_url"
										name="product_1_url"
									/>
								</div>

								<label class="input-group-text">選擇圖片</label>
								<div class="custom-file">
									<input
										type="file"
										class="custom-file-input"
										name="img_carousel_1"
										id="img_carousel_1"
										aria-describedby="img_carousel_1"
									/>
									<label
										class="custom-file-label"
										for="img_carousel_1"
										id="img_carousel_1_label"
										>選擇圖片</label
									>
								</div>
							</div>

							<div class="input-group mb-2">
								<img class="my-2 mx-auto" id="carousel_img_2" width="772" />

								<div class="input-group-prepend col-7">
									<div class="input-group-text">
										<label class="my-auto mr-2" for="carousel_2_checked"
											>修改確認 :</label
										>
										<input
											type="checkbox"
											id="carousel_2_checked"
											name="carousel_2_checked"
										/>
									</div>

									<label class="input-group-text" for="product_2_url"
										>圖片連結網址 :</label
									>
									<input
										class="p-2 w-100"
										type="text"
										id="product_2_url"
										name="product_2_url"
									/>
								</div>

								<label class="input-group-text">選擇圖片</label>
								<div class="custom-file">
									<input
										type="file"
										class="custom-file-input"
										name="img_carousel_2"
										id="img_carousel_2"
										aria-describedby="img_carousel_2"
									/>
									<label
										class="custom-file-label"
										for="img_carousel_2"
										id="img_carousel_2_label"
										>選擇圖片</label
									>
								</div>
							</div>

							<div class="input-group mb-2">
								<img class="my-2 mx-auto" id="carousel_img_3" width="772" />

								<div class="input-group-prepend col-7">
									<div class="input-group-text">
										<label class="my-auto mr-2" for="carousel_3_checked"
											>修改確認 :</label
										>
										<input
											type="checkbox"
											id="carousel_3_checked"
											name="carousel_3_checked"
										/>
									</div>

									<label class="input-group-text" for="product_3_url"
										>圖片連結網址 :</label
									>
									<input
										class="p-2 w-100"
										type="text"
										id="product_3_url"
										name="product_3_url"
									/>
								</div>

								<label class="input-group-text">選擇圖片</label>
								<div class="custom-file">
									<input
										type="file"
										class="custom-file-input"
										name="img_carousel_3"
										id="img_carousel_3"
										aria-describedby="img_carousel_3"
									/>
									<label
										class="custom-file-label"
										for="img_carousel_3"
										id="img_carousel_3_label"
										>選擇圖片</label
									>
								</div>
							</div>

							<button
								type="submit"
								class="btn btn-primary btn-lg btn-block my-2"
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
	props: ["carousel_data"],
	data() {
		return {
			csrf: ""
		};
	},

	mounted() {
		this.csrf = $('meta[name="csrf-token"]').attr("content");
		document.getElementById("token").value = this.csrf;

		if (this.carousel_data != null) {
			var Jcarousel_data = JSON.parse(this.carousel_data);

			Jcarousel_data.forEach(element => {
				switch (element.id) {
					case 1:
						document.getElementById("carousel_img_1").src = element.image;
						break;
					case 2:
						document.getElementById("carousel_img_2").src = element.image;
						break;
					case 3:
						document.getElementById("carousel_img_3").src = element.image;
						break;
				}
			});
		}

		$("#img_carousel_1").on("change", function(e) {
			chooseFileName(this.id, e);
		});

		$("#img_carousel_2").on("change", function(e) {
			chooseFileName(this.id, e);
		});

		$("#img_carousel_3").on("change", function(e) {
			chooseFileName(this.id, e);
		});
	}
};
</script>

<style scoped></style>
