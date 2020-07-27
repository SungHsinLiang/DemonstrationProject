<template>
  <div class="text-center">
    <ul id="shirts" class="my-5"></ul>
  </div>
</template>

<script>
export default {
  props: ["categories_route"],

  data: function () {
    return {
      data: "",
    };
  },

  mounted() {
    console.log("Component mounted.");
    console.log(this.categories_route);

    axios
      .get(this.categories_route)
      .then((res) => {
        // console.log(res.data);
        res.data.forEach((element) => {
          var leftNavbar_text = "";
          // console.log(element);
          var index = 0;
          for (const [key, value] of Object.entries(element)) {
            // console.log(key, value);
            if (index == 0) {
              leftNavbar_text += "<li class='my-2'>&#9724;" + key + "</li>";
            } else {
              leftNavbar_text += "<li class='my-2'>&#10097;";
              leftNavbar_text += "<a href='" + value + "'>" + key + "</a>";
              leftNavbar_text += "</li>";
            }
            index++;
          }
          leftNavbar_text += "<hr class='bg-white'>";
          document.getElementById("shirts").innerHTML += leftNavbar_text;
        });
      })
      .catch((err) => {
        console.error(err);
      });
  },

  methods: {},
};

function functionName() {}
</script>

<style scoped>
</style>