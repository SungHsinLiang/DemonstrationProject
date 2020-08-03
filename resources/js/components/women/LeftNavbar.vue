<template>
  <div class="text-center">
    <ul id="shirts" class="my-5"></ul>
  </div>
</template>

<script>
export default {
  props: ["categories_route"],

  data: function() {
    return {
      categories: "",
      styles: "",
      search: "",
    };
  },

  mounted() {
    // console.log(this.categories_route);

    axios
      .get(this.categories_route)
      .then((res) => {
        console.log(res);
        // console.log(res.data["styles"]);
        this.categories = res.data["categories"];
        this.styles = res.data["styles"];
        this.search = res.data["search_category_and_style_route"];

        var leftNavbar_text = "";

        this.categories.forEach((c_element) => {
          console.log("category = " + c_element["category"]);
          var category_has_styles = false;
          var temporary_hr = false;

          this.styles.forEach((s_element) => {
            if (s_element["category"] == c_element["category"]) {
              if (!category_has_styles) {
                leftNavbar_text += "<li class='my-2'>&#9724;" + c_element["category"] + "</li>";
                temporary_hr = true;
                category_has_styles = true;
              }
              console.log("style = " + s_element["style"]);
              leftNavbar_text += "<li class='my-2'>&#10097;";
              leftNavbar_text +=
                "<a href='" +
                this.search +
                "?gender=" +
                s_element["gender"] +
                "&category=" +
                s_element["category"] +
                "&style=" +
                s_element["style"] +
                "'>" +
                s_element["style"] +
                "</a>";
              leftNavbar_text += "</li>";
            }
          });

          if (temporary_hr) leftNavbar_text += "<hr class='bg-white'>";
        });
        document.getElementById("shirts").innerHTML += leftNavbar_text;
      })
      .catch((err) => {
        console.error(err);
      });
  },

  methods: {},
};

function functionName() {}
</script>

<style scoped></style>
