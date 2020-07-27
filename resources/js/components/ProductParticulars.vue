<template>
  <div>
    <div class="d-flex my-4">
      <img
        :src="product['img_main']"
        :alt="product['product_name']"
        style="width: 50%; display:flex"
      />
      <div class="text-center col-6 m-auto">
        <form :action="route" method="post" id="purchase_cart_form">
          <h2 class="font-weight-bold" id="product_id">Product Id : {{ product["id"] }}</h2>
          <br />
          <h2 class="font-weight-bold">{{ product["product_name"] }}</h2>
          <br />
          <h2 id="total_quantity">Total Quantity : {{ product["quantity"] }}</h2>
          <br />
          <h3>NT$ : {{ product["price"] }}</h3>

          <br />
          <hr style="background: white;" />
          <br />

          <div class="input-group my-4">
            <div class="input-group-prepend">
              <label class="input-group-text" for="purchase_qty" id="label_purchase_qty">
                Purchase
                Qty
              </label>
            </div>

            <select class="custom-select" id="purchase_qty" name="purchase_qty">
              <option value="-5">-5</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="15">15</option>
            </select>
          </div>

          <button type="submit" class="btn btn-primary btn-lg btn-block" id="purchase">
            <h1>Add to Cart</h1>
          </button>
        </form>
      </div>
    </div>

    <div class="text-center col-12">
      <img :src="product['img_2']" :alt="product['img_2']" class="mb-4" />
      <img :src="product['img_3']" :alt="product['img_3']" class="mb-4" />
      <img :src="product['img_4']" :alt="product['img_4']" class="mb-4" />
      <img :src="product['img_5']" :alt="product['img_5']" class="mb-4" />
    </div>
  </div>
</template>

<script>
export default {
  props: ["product", "route"],

  data: () => ({
    csrf: document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute("content")
  }),

  mounted() {
    const product = this.$props["product"];
    document
      .querySelector("#purchase_cart_form")
      .addEventListener("submit", function(e) {
        e.preventDefault();
        axios
          .post(this.action, {
            product_id: product["id"],
            purchase_qty: document.querySelector("#purchase_qty").value
          })
          .then(response => {
            console.log("Successful response");
            alert("Put the product to purchase cart successfully.");

            refreshNavPurchaseCart(
              response.data["purchase_lists"]["purchase_lists"]
            );

            // remove all error messages
            const errorMessages = document.querySelectorAll(".text-danger");
            errorMessages.forEach(element => (element.textContent = ""));

            // remove all form controls with highlighted error text box
            const formControls = document.querySelectorAll(".border-danger");
            formControls.forEach(element =>
              element.classList.remove("border-danger")
            );
          })
          .catch(error => {
            // console.log('error.status : ' + Object.keys(error.response[status]));
            console.log("error.status : " + error.response.status);
            if (
              error.response.status == 401 &&
              error.response.statusText == "Unauthorized"
            ) {
              console.log("boom!!");
              alert(
                "Please login first before you put the item in the purchase cart."
              );
              window.location = "/login";
            }

            // console.log(error.response.data.errors['product_id']);
            console.log(error.response);
            const errors = error.response.data.errors;

            // remove all error messages
            const errorMessages = document.querySelectorAll(".text-danger");
            errorMessages.forEach(element => (element.textContent = ""));

            // remove all form controls with highlighted error text box
            const formControls = document.querySelectorAll(".form-control");
            formControls.forEach(element =>
              element.classList.remove("border", "border-danger")
            );

            // get the errors' length in Json type
            if (errors == null)
              console.log("boom there are no errors that come from the server");
            else {
              console.log(
                "the count of the errors is : " + Object.keys(errors).length
              );

              const firstItem = Object.keys(errors)[0];
              const firstItemDOM = document.getElementById(firstItem);
              const firstErrorMessage = errors[firstItem][0];

              // scroll to the error message
              firstItemDOM.scrollIntoView({ behavior: "smooth" });

              // show error message
              // firstItemDOM.insertAdjacentHTML('afterend', `<div class="text-danger">${firstErrorMessage}</div>`);
              console.log(Object.keys(errors));
              for (var error in errors) {
                var errorItemDOM = document.getElementById(error);
                var errorMessage = errors[error][0];
                errorItemDOM.insertAdjacentHTML(
                  "afterend",
                  `<div class="text-danger">${errorMessage}</div>`
                );
              }

              // highlight the form control with the error
              firstItemDOM.classList.add("border", "border-danger");
            }
          });
      });
  }
};

// refresh the nav purchase cart when putting the product to the user purchase cart successfully.
function refreshNavPurchaseCart(purchase_lists) {
  document.getElementById("purchase_lists_tbody").innerHTML = "";

  var text = "";
  purchase_lists.forEach(lt => {
    console.log(lt);
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
