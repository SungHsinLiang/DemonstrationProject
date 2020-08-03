<template>
  <li class="nav-item text-center text-white m-auto dropdown">
    <a :href="route" class="dropbtn bg-dark px-4 py-2 btn">&#128722;購物車</a>
    <div class="dropdown-content" style="right:0;">
      <table style="width:350px" class="m-3 text-dark">
        <thead>
          <tr>
            <th>商品名稱</th>
            <th>數量</th>
          </tr>
        </thead>
        <tbody id="purchase_lists_tbody"></tbody>
      </table>
      <a :href="route">
        <button type="button" class="btn btn-primary btn-lg btn-block mb-2">&#128722; 前往結帳</button>
      </a>
    </div>
  </li>
</template>

<script>
export default {
  name: "Nav-Purchase-Cart",
  props: ["route", "purchase_list"],
  mounted() {
    // console.log(this.$props["route"]);
    // console.log(this.$props["purchase_list"]);

    axios
      .get(this.$props["purchase_list"], {
        timeout: 5000,
      })
      .then((res) => {
        this.$data["purchase_lists"] = res.data["purchase_lists"];
        updatePurchaseCart(this.$data["purchase_lists"]);
      })
      .catch((err) => console.error(err));
  },
  data() {
    return {
      purchase_lists: ["9999999"],
    };
  },
  methods: {},
};

// refresh the nav purchase cart when putting the product to the user purchase cart successfully.
function updatePurchaseCart(lists) {
  document.getElementById("purchase_lists_tbody").innerHTML = "";

  var text = "";
  lists.forEach((lt) => {
    text += '<tr><th><a href="/product/' + lt["id"] + '">' + lt["product_name"] + "</a></th>";
    text += "<td>" + lt["purchase_quantity"] + "</td></tr>";
  });

  // refresh purchase cart
  document.getElementById("purchase_lists_tbody").innerHTML = text;
}
</script>

<style scoped>
.dropbtn {
  color: #cccccc;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  text-decoration: none;
}

.dropdown-content a:hover {
  background-color: yellow;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}

tbody {
  border-top: 20px solid transparent;
}
</style>
