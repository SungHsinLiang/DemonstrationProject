<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 my-3">
        <div class="card">
          <div class="card-header text-center" id="card-header">New Product</div>

          <div class="card-body">
            <form :action="action" method="post">
              <input type="hidden" name="_token" :value="csrf" />

              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="product_name" id="label_product_name" />
                </div>
                <input class="form-control" type="text" name="product_name" id="product_name" />
              </div>

              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="price" id="label_price" />
                </div>
                <input type="number" class="form-control" min="0" name="price" id="price" />
              </div>

              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="quantity" id="label_quantity" />
                </div>
                <input type="number" class="form-control" min="0" name="quantity" id="quantity" />
              </div>

              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="gender" id="label_gender" />
                </div>
                <select class="custom-select" id="gender">
                  <option disabled class="text-danger font-weight-bold">Choose...</option>
                  <option value="0" id="man" />
                  <option value="1" id="woman" />
                </select>
              </div>
              
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="category" id="label_category" />
                </div>
                <select class="custom-select" id="category">
                  <option disabled class="text-danger font-weight-bold">Choose...</option>
                  <option value="top" id="top" />
                  <option value="bottom" id="bottom" />
                </select>
              </div>

              <button type="submit" id="save_btn">SAVE</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    let vm = this;

    console.log("Component mounted.");

    $("#save_btn").html(vm.save_btn);
    $("#card-header").html(vm.add_new_product);
    $("#label_product_name").html(vm.product_name);
    $("#label_price").html(vm.price);
    $("#label_quantity").html(vm.quantity);
    $("#label_gender").html(vm.gender);
    $("#man").html(vm.man);
    $("#woman").html(vm.woman);
    $("#label_category").html(vm.category);
    // $("#top").html(vm.woman);
    // $("#bottom").html(vm.woman);
  },
  props: [
    "action",
    "csrf",
    "save_btn",
    "add_new_product",
    "product_name",
    "price",
    "quantity",
    "gender",
    "man",
    "woman",
    // "category",
  ]
};
</script>
