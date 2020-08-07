<template>
	<div class="container">
		<div class="err_message text-danger text-center my-3"></div>
		<div class="card bg-light my-3 mx-auto d-black">
			<!-- purchase list -->
			<div class="d-block" id="purchase_cart">
				<div class="card-header text-center">
					<h3>購物清單</h3>
				</div>

				<div class="card-body">
					<div class="container d-flex text-center">
						<div class="col-3">
							<h3>商品圖片</h3>
						</div>
						<div class="col-4">
							<h3>商品名稱</h3>
						</div>
						<div class="col-2">
							<h3>購買數量</h3>
						</div>
						<div class="col-2">
							<h3>金額</h3>
						</div>
						<div class="col-1">
							<h3>取消</h3>
						</div>
					</div>

					<hr />

					<div v-for="(item, index) in purchase_lists" :key="item.id">
						<div
							class="container d-flex text-center"
							:id="'container_' + index"
						>
							<div class="col-3">
								<a :href="product_route + '/' + item['products_id']">
									<img :src="item['imgs']" alt style="width: 40%" />
								</a>
							</div>

							<div class="col-4 d-flex">
								<div class="m-auto">
									<a :href="product_route + '/' + item['products_id']">{{
										item["product_name"]
									}}</a>
								</div>
							</div>

							<div class="col-2 d-flex">
								<div class="input-group m-auto">
									<div class="input-group-prepend">
										<button
											class="btn bg-info p-1"
											v-on:click="change_quantity(index, 'decrease_btn')"
										>
											&#10134;
										</button>
									</div>
									<input
										type="text"
										class="form-control text-center"
										aria-label="Example text with button addon"
										aria-describedby="button-addon1"
										:id="'container_purchase_quantity_' + index"
										:value="item['purchase_quantity']"
										disabled
									/>
									<div class="input-group-append">
										<button
											class="btn bg-info p-1"
											v-on:click="change_quantity(index, 'increase_btn')"
										>
											&#10133;
										</button>
									</div>
								</div>
							</div>

							<div class="col-2 d-flex">
								<div class="m-auto" :id="'container_amount_' + index">
									$ {{ item["price"] * item["purchase_quantity"] }}
								</div>
							</div>

							<div class="col-1 d-flex">
								<div
									class="m-auto bg-danger btn"
									v-on:click="removePurchaseProduct(item, index)"
								>
									&#10006;
								</div>
							</div>
						</div>

						<hr :id="'container_hr_' + index" />
					</div>
				</div>

				<div class="card-footer">
					<div class="container">
						<div class="row text-right my-3">
							<div class="col-11">商品數 :</div>
							<div class="col-1" id="total_quantities">
								{{ total_quantities }}
							</div>
						</div>
						<div class="row text-right my-3">
							<div class="col-11">商品金額 :</div>
							<div class="col-1 total_amount">{{ total_amount }}</div>
						</div>
						<div class="row text-right my-3">
							<div class="col-11">運費 :</div>

							<div class="col-1 transport_fee" v-if="shipping_fee == 0">
								未選擇
							</div>
							<div class="col-1 transport_fee" v-else>{{ shipping_fee }}</div>
						</div>

						<hr />

						<div class="row text-right my-4">
							<div class="col-11">小計 :</div>
							<div class="col-1 order_amount">{{ order_amount }}</div>
						</div>
					</div>

					<div class="d-flex">
						<div class="btn ml-auto w-25" v-on:click="nextStepBtn()">
							下一步
						</div>
					</div>
				</div>
			</div>

			<!-- choose the payment and transport method. -->
			<div class="d-none" id="payment_and_transport">
				<div class="card-header text-center">
					<h3>付款與運送方式</h3>
				</div>

				<div class="card-body">
					<div class="container d-flex text-center">
						<div class="col-6">
							<h3>運送方式</h3>
						</div>
						<div class="col-6">
							<h3>運費</h3>
						</div>
					</div>

					<hr />

					<div class="container">
						<div class="row">
							<div class="col-6">
								<input
									type="radio"
									id="seven"
									name="payway"
									value="seven"
									v-model="picked"
									v-on:click="chooseTransportMethod()"
								/>
								<label for="seven" class="pl-2">7-11 取貨付款</label>
							</div>
							<div class="col-6 text-right">滿 1000 元免運，運費 $ 50</div>
						</div>
					</div>

					<hr />

					<div class="container">
						<div class="row">
							<div class="col-6">
								<input
									type="radio"
									id="othersConvenienceStores"
									name="payway"
									value="othersConvenienceStores"
									v-model="picked"
									v-on:click="chooseTransportMethod()"
								/>
								<label for="othersConvenienceStores" class="pl-2"
									>全家、OK、萊爾富 取貨付款</label
								>
							</div>
							<div class="col-6 text-right">滿 1000 元免運，運費 $ 70</div>
						</div>
					</div>

					<hr />
				</div>

				<div class="card-footer">
					<div class="container">
						<div class="row text-right my-3">
							<div class="col-11">商品數 :</div>
							<div class="col-1" id="total_quantities">
								{{ total_quantities }}
							</div>
						</div>
						<div class="row text-right my-3">
							<div class="col-11">商品金額 :</div>
							<div class="col-1 total_amount">{{ total_amount }}</div>
						</div>
						<div class="row text-right my-3">
							<div class="col-11">運費 :</div>
							<div
								class="col-1 transport_fee text-danger"
								v-if="shipping_fee == 0"
							>
								未選擇
							</div>
							<div class="col-1 transport_fee" v-else>{{ shipping_fee }}</div>
						</div>

						<hr />

						<div class="row text-right my-4">
							<div class="col-11">應付金額 :</div>
							<div class="col-1 order_amount">{{ order_amount }}</div>
						</div>
					</div>

					<div class="d-flex">
						<div class="btn mr-auto w-25" v-on:click="previousStepBtn()">
							返回購物車
						</div>
						<div
							id="submit"
							class="btn ml-auto w-25 disabled"
							v-on:click="submit_the_order()"
						>
							送出訂單
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: [
		"purchase_lists",
		"purchase_cart_route",
		"product_route",
		"order_route"
	],

	data: function() {
		return {
			total_amount: 0,
			total_quantities: 0,
			order_amount: 0,
			picked: null,
			shipping_fee: 0,
			csrf: ""
		};
	},

	mounted() {
		this.csrf = $('meta[name="csrf-token"]').attr("content");

		this.purchase_lists.forEach(element => {
			this.total_amount += element["price"] * element["purchase_quantity"];
			this.total_quantities += parseInt(element["purchase_quantity"]);
		});
		this.order_amount = this.total_amount;
	},

	methods: {
		removePurchaseProduct: function(e, index) {
			console.clear();
			console.log(e);
			console.log(this.purchase_cart_route + "/" + e["purchase_carts_id"]);

			axios
				.delete(this.purchase_cart_route + "/" + e["purchase_carts_id"])
				.then(res => {
					alert("remove the product successfully!");
					console.log(res);
					document.getElementById("container_" + index).remove();
					document.getElementById("container_hr_" + index).remove();

					// update nav purchase cart
					refreshNavPurchaseCart(res.data["purchase_lists"]["purchase_lists"]);

					this.total_amount = res.data["total_amount"];
					this.total_quantities = res.data["total_quantities"];
					this.order_amount = this.total_amount + this.shipping_fee;

					// modify the total quantities and the total amount
					document.getElementsByClassName(
						"total_amount"
					)[0].innerHTML = this.total_amount;
					document.getElementsByClassName(
						"total_amount"
					)[1].innerHTML = this.total_amount;

					document.getElementById(
						"total_quantities"
					).innerHTML = this.total_quantities;

					document.getElementsByClassName(
						"order_amount"
					)[0].innerHTML = this.order_amount;
					document.getElementsByClassName(
						"order_amount"
					)[1].innerHTML = this.order_amount;
				})
				.catch(err => console.error(err));
		},

		change_quantity: function(e, button) {
			// get the choosen product quantity
			var ichange_purchase_quantity = document.getElementById(
				"container_purchase_quantity_" + e
			).value;

			// figure out the user clicked btn
			if (button == "increase_btn") {
				ichange_purchase_quantity++;
			} else if (button == "decrease_btn") {
				ichange_purchase_quantity--;
			}

			axios
				.patch(
					this.purchase_cart_route +
						"/" +
						this.purchase_lists[e]["purchase_carts_id"],
					{
						change_purchase_quantity: ichange_purchase_quantity
					}
				)
				.then(res => {
					// update nav purchase cart
					refreshNavPurchaseCart(res.data["purchase_lists"]["purchase_lists"]);

					// modify the product quantity
					this.purchase_lists[e]["purchase_quantity"] =
						res.data["update_data"]["purchase_quantity"];
					document.getElementById("container_purchase_quantity_" + e).value =
						res.data["update_data"]["purchase_quantity"];

					// modify the purchase money
					document.getElementById("container_amount_" + e).innerHTML =
						"$ " +
						res.data["update_data"]["purchase_quantity"] *
							res.data["update_data"]["price"];

					this.total_amount = res.data["total_amount"];
					this.total_quantities = res.data["total_quantities"];
					this.order_amount = this.total_amount + this.shipping_fee;

					// modify the total quantities, the total amount and order amount
					document.getElementsByClassName(
						"total_amount"
					)[0].innerHTML = this.total_amount;
					document.getElementsByClassName(
						"total_amount"
					)[1].innerHTML = this.total_amount;

					document.getElementById(
						"total_quantities"
					).innerHTML = this.total_quantities;

					document.getElementsByClassName(
						"order_amount"
					)[0].innerHTML = this.order_amount;
					document.getElementsByClassName(
						"order_amount"
					)[1].innerHTML = this.order_amount;
				})
				.catch(err => console.error(err));
		},

		chooseTransportMethod() {
			setTimeout(() => {
				// set the shipping fee
				switch (this.picked) {
					case "seven":
						console.log("seven shipping fee is " + 50);
						this.shipping_fee = 50;
						break;
					case "othersConvenienceStores":
						console.log("othersConvenienceStores shipping fee is " + 70);
						this.shipping_fee = 70;
						break;
				}
				this.order_amount = this.total_amount + this.shipping_fee;

				// modify the transport fee and order amount
				document.getElementsByClassName(
					"transport_fee"
				)[0].innerHTML = this.shipping_fee;
				document.getElementsByClassName(
					"transport_fee"
				)[1].innerHTML = this.shipping_fee;

				document.getElementsByClassName(
					"order_amount"
				)[0].innerHTML = this.order_amount;
				document.getElementsByClassName(
					"order_amount"
				)[1].innerHTML = this.order_amount;

				// remove the text-danger class
				document
					.getElementsByClassName("transport_fee")[1]
					.classList.remove("text-danger");

				// enable the submit button
				document.getElementById("submit").classList.remove("disabled");
			}, 50);
		},

		nextStepBtn() {
			console.log("nextStepBtn");
			document.getElementById("purchase_cart").classList.remove("d-block");
			document.getElementById("purchase_cart").classList.add("d-none");
			document.getElementById("payment_and_transport").classList.add("d-block");
			document
				.getElementById("payment_and_transport")
				.classList.remove("d-none");
		},

		previousStepBtn() {
			console.log("previousStepBtn");
			document
				.getElementById("payment_and_transport")
				.classList.remove("d-block");
			document.getElementById("payment_and_transport").classList.add("d-none");
			document.getElementById("purchase_cart").classList.add("d-block");
			document.getElementById("purchase_cart").classList.remove("d-none");
		},

		submit_the_order() {
			axios
				.post(this.order_route, {
					transport_method: this.picked,
					_token: this.csrf
				})
				.then(res => {
					// console.log(res.data["place_the_order_successfully_route"]);
					console.log(res);
					// console.log("success");
					// window.location = res.data["place_the_order_successfully_route"];
				})
				.catch(err => {
					if (err.response.data.message == "carts count less than 1") {
						document.getElementsByClassName("err_message")[0].innerHTML =
							"購物車內無商品，請先選購商品。";
					}
				});
		}
	}
};

// refresh the nav purchase cart when putting the product to the user purchase cart successfully.
function refreshNavPurchaseCart(purchase_lists) {
	document.getElementById("purchase_lists_tbody").innerHTML = "";

	var text = "";
	purchase_lists.forEach(lt => {
		text +=
			'<tr><th><a href="/product/' +
			lt["id"] +
			'">' +
			lt["product_name"] +
			"</a></th>";
		text += "<td>" + lt["purchase_quantity"] + "</td></tr>";
	});

	document.getElementById("purchase_lists_tbody").innerHTML = text;
}
</script>

<style scoped></style>
