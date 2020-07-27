<template>
  <div class="col-10 text-center mx-auto my-5">
    <h1>訂單查詢</h1>
    <h3>點選訂單編號可連結至訂單詳細頁面</h3>
    <table class="table table-striped table-dark">
      <thead>
        <tr>
          <th scope="col">訂購日期</th>
          <th scope="col">訂單編號</th>
          <th scope="col">完成付款</th>
          <th scope="col">應付金額</th>
        </tr>
      </thead>
      <tbody id="order_tbody"></tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["orders_index_route"],

  mounted() {
    console.log(this.orders_index_route);
    axios
      .get("http://127.0.0.1:8000/orders/lists")
      // .get(this.orders_index_route)
      .then(res => {
        console.log(res.data);
        document.getElementById("order_tbody").innerHTML = "";
        var text = "";

        res.data.orders_lists.forEach(element => {
          text += "<tr><td>" + element["created_at"].substring(0, 10) + "</td>";
          text +=
            '<td><a href="http://127.0.0.1:8000/orders/' +
            element["id"] +
            '" class="text-white">' +
            element["id"] +
            "</a></td>";
          text += "<td>尚未完成</td>";
          text += "<td>" + element["order_price"] + "</td></tr>";
          console.log(element["created_at"].substring(0, 10));
        });
        document.getElementById("order_tbody").innerHTML = text;
      })
      .catch(err => {
        console.error(err);
      });
  }
};
</script>

<style scoped>
</style>
