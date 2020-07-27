<template>
  <div id="demo" class="carousel slide my-3" data-ride="carousel">
    <!-- The slideshow -->
    <div class="carousel-inner" id="carousel_items">
      <!-- <div class="carousel-item active">
        <a href="http://127.0.0.1:8000/product/1">
          <img src="images/i/carousel/sliderShow_1.jpg" width="1288" />
        </a>
      </div>
      <div class="carousel-item">
        <a href="http://127.0.0.1:8000/product/2">
          <img src="images/i/carousel/sliderShow_2.jpg" width="1288" />
        </a>
      </div>
      <div class="carousel-item">
        <a href="http://127.0.0.1:8000/product/3">
          <img src="images/i/carousel/sliderShow_3.jpg" width="1288" />
        </a>
      </div>-->
    </div>

    <!-- Indicators -->
    <ul class="carousel-indicators mb-0" id="carousel_indicators">
      <!-- <li data-target="#demo" data-slide-to="0" class="active"></li>
      <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>-->
    </ul>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
</template>

<script>
export default {
  props: ["carousels"],
  mounted() {
    var Jcarousels = JSON.parse(this.carousels);

    var carousel_items = "";
    var carousel_indicators = "";

    Jcarousels.forEach((element, index) => {
      if (element.id == 1) {
        carousel_items += "<div class='carousel-item active'>";

        carousel_indicators +=
          "<li data-target='#demo' data-slide-to='" +
          index +
          "' class='active'></li>";
      } else {
        carousel_items += "<div class='carousel-item'>";

        carousel_indicators +=
          "<li data-target='#demo' data-slide-to='" + index + "'></li>";
      }
      carousel_items += "<a href=" + element.product_url + ">";
      carousel_items +=
        "<img src=" + element.image + " class='carousel_img' />";
      carousel_items += "</a>";
      carousel_items += "</div>";
    });

    document.getElementById("carousel_items").innerHTML = carousel_items;
    document.getElementById(
      "carousel_indicators"
    ).innerHTML = carousel_indicators;
  },
};
</script>

<style scoped>
</style>