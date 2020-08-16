<template>
	<div class="container py-2 my-3">
		<div class="card col-md-10 my-5 mx-auto px-0">
			<div class="card-header text-center">
				新增商品類型
			</div>

			<div class="card-body">
				<form id="form" :action="this.product_categories_create" method="POST">
					<input type="hidden" name="_token" id="token" />

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<label class="input-group-text" for="gender" id="label_gender"
								>新商品類型歸屬性別</label
							>
						</div>

						<select class="custom-select" id="gender" name="gender">
							<option selected disabled>請選擇新商品類型歸屬性別</option>
							<option value="men">men</option>
							<option value="women">women</option>
						</select>
					</div>
					<div class="alert alert-danger" v-if="jpErrors['gender'] != null">
						{{ jpErrors["gender"][0] }}
					</div>

					<!-- <div class="input-group mb-2">
						<div class="input-group-prepend">
							<label
								class="input-group-text"
								for="cloth_position"
								id="label_cloth_position"
								>商品歸屬部位</label
							>
						</div>

						<select
							class="custom-select"
							id="cloth_position"
							name="cloth_position"
						>
							<option selected disabled>請選擇商品歸屬部位</option>
							<option value="top">上身類</option>
							<option value="bottom">下身類</option>
						</select>
					</div>
					<div
						class="alert alert-danger"
						v-if="jpErrors['cloth_position'] != null"
					>
						{{ jpErrors["cloth_position"][0] }}
					</div> -->

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<label
								class="input-group-text"
								for="new_style"
								id="label_new_style"
								>新商品類型名稱</label
							>
						</div>

						<input
							class="form-control"
							type="text"
							name="catogory"
							id="catogory"
							placeholder="請輸入新商品類型名稱"
							:value="jpOlds['catogory']"
							v-if="jpOlds['catogory'] != null"
						/>
						<input
							class="form-control"
							type="text"
							name="catogory"
							id="catogory"
							placeholder="請輸入新商品類型名稱"
							value
							v-else
						/>
					</div>
					<div class="alert alert-danger" v-if="jpErrors['catogory'] != null">
						{{ jpErrors["catogory"][0] }}
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
	props: ["product_categories_create", "styles", "errors", "olds"],

	data: function() {
		return {
			jpStyles: "",
			jpErrors: "",
			jpOlds: ""
		};
	},

	mounted() {
		var _token = document.querySelector('meta[name="csrf-token"]').content;
		document.getElementById("token").value = _token;
	},

	methods: {}
};

function functionName() {}
</script>

<style scoped></style>
