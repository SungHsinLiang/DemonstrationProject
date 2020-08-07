<template>
	<div class="col-10 text-center mx-auto my-5">
		<h1>訂單詳細</h1>
		<table class="table table-striped table-dark">
			<thead>
				<tr>
					<th scope="col">產品 ID</th>
					<th scope="col">產品圖片</th>
					<th scope="col">產品名稱</th>
					<th scope="col">購買數量</th>
					<th scope="col">單價</th>
				</tr>
			</thead>
			<tbody id="order_particulars_tbody"></tbody>
		</table>
	</div>
</template>

<script>
export default {
	props: ["order_lists", "order_route"],
	mounted() {
		console.log("Component mounted.");
		console.log(JSON.parse(this.order_lists));
		var text = "";
		var quantity = 0;
		var total_price = 0;
		JSON.parse(this.order_lists).forEach(element => {
			console.log(element["id"]);
			quantity += parseInt(element["purchase_quantity"]);
			total_price +=
				parseInt(element["purchase_quantity"]) * parseInt(element["price"]);

			text += "<tr><td>" + element["id"] + "</td>";
			text +=
				"<td><a href='" +
				this.order_route +
				"/" +
				element["id"] +
				"'><img src=" +
				element["imgs"] +
				" alt style='width: 40%' /></a></td>";
			text +=
				"<td><a href='" +
				this.order_route +
				"/" +
				element["id"] +
				"' class='text-white'>" +
				element["product_name"] +
				"</a></td>";
			text += "<td>" + element["purchase_quantity"] + "</td>";
			text += "<td>" + element["price"] + "</td></tr>";
		});

		text += "<tr><td></td>";
		text += "<td></td>";
		text += "<td></td>";
		text += "<td>數量：</td>";
		text += "<td>" + quantity + "</td></tr>";

		text += "<tr><td></td>";
		text += "<td></td>";
		text += "<td></td>";
		text += "<td>總額：</td>";
		text += "<td>" + total_price + "</td></tr>";

		document.getElementById("order_particulars_tbody").innerHTML = text;
	}
};
</script>

<style scoped></style>
