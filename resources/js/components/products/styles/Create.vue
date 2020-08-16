<template>
	<div class="container py-2 my-3">
		<div class="card col-md-10 my-5 mx-auto px-0">
			<div class="card-header text-center">
				新增商品風格
			</div>

			<div class="card-body">
				<form id="form" :action="this.product_styles_create" method="POST">
					<input type="hidden" name="_token" id="token" />

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<label class="input-group-text" for="gender" id="label_gender"
								>新增商品風格歸屬性別</label
							>
						</div>

						<select class="custom-select" id="gender" name="gender">
							<option selected disabled>請選擇新商品風格歸屬性別</option>
							<option value="men">men</option>
							<option value="women">women</option>
						</select>
					</div>
					<div class="alert alert-danger" v-if="jpErrors['gender'] != null">
						{{ jpErrors["gender"][0] }}
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<label class="input-group-text" for="category" id="label_category"
								>新商品風格歸屬部位</label
							>
						</div>

						<select class="custom-select" id="category" name="category">
							<option selected disabled>請選擇商品歸屬部位</option>
						</select>
					</div>
					<div class="alert alert-danger" v-if="jpErrors['category'] != null">
						{{ jpErrors["category"][0] }}
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<label class="input-group-text" for="new_style" id="label_style"
								>新風格名稱</label
							>
						</div>

						<input
							class="form-control"
							type="text"
							name="style"
							id="style"
							placeholder="請輸入新風格名稱"
							:value="jpOlds['style']"
							v-if="jpOlds['style'] != null"
						/>
						<input
							class="form-control"
							type="text"
							name="style"
							id="style"
							placeholder="請輸入新風格名稱"
							value
							v-else
						/>
					</div>
					<div class="alert alert-danger" v-if="jpErrors['style'] != null">
						{{ jpErrors["style"][0] }}
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
	props: [
		"product_styles_create",
		"styles",
		"errors",
		"olds",
		"men_categories",
		"women_categories"
	],

	data: function() {
		return {
			jpStyles: "",
			jpErrors: "",
			jpOlds: "",
			jpMen_categories: "",
			jpWomen_categories: ""
		};
	},

	mounted() {
		var _token = document.querySelector('meta[name="csrf-token"]').content;
		document.getElementById("token").value = _token;
		this.jpErrors = JSON.parse(this.errors);
		this.jpOlds = JSON.parse(this.olds);
		this.jpMen_categories = JSON.parse(this.men_categories);
		this.jpWomen_categories = JSON.parse(this.women_categories);

		document.getElementById("gender").addEventListener("change", e => {
			switch (document.getElementById("gender").value) {
				case "men":
					// mct for men_categories_text
					var mct = "";
					document.getElementById("category").innerHTML = "";
					mct += "<option selected disabled>請選擇商品歸屬部位</option>";
					this.jpMen_categories.forEach(element => {
						mct +=
							"<option value=" +
							element["category"] +
							">" +
							element["category"] +
							"</option>";
					});
					document.getElementById("category").innerHTML = mct;
					break;
				case "women":
					// mct for women_categories_text
					var wct = "";
					document.getElementById("category").innerHTML = "";
					wct += "<option selected disabled>請選擇商品歸屬部位</option>";
					this.jpWomen_categories.forEach(element => {
						wct +=
							"<option value=" +
							element["category"] +
							">" +
							element["category"] +
							"</option>";
					});
					document.getElementById("category").innerHTML = wct;
					break;
			}
		});
	},
	methods: {}
};

function functionName() {}
</script>

<style scoped></style>
