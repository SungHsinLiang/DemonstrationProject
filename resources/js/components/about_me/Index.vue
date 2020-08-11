<template>
	<div class="container my-5">
		<div class="row">
			<div class="card col-6 my-auto about-me text-center p-0">
				<div class="card-header">
					<h1>樣本：關於我</h1>
				</div>

				<div class="card-body">
					<table style="width: 100%">
						<tr>
							<th>電話：</th>
							<td>03-xxxxxxx</td>
						</tr>
						<br />
						<tr>
							<th>營業時間：</th>
							<td>06:20 ~ 23:45</td>
						</tr>
						<br />
						<tr>
							<th>地址：</th>
							<td>320桃園市中壢區高鐵北路一段x號</td>
						</tr>
					</table>
				</div>
			</div>

			<div class="container col-6">
				<h1 class="text-center">Google map</h1>
				<GmapMap
					:center="{ lat: 25.013024, lng: 121.214896 }"
					:zoom="15"
					map-type-id="terrain"
					class="google-map mx-auto"
				>
					<GmapMarker
						ref="myMarker"
						:position="google && new google.maps.LatLng(25.013024, 121.214896)"
					/>
				</GmapMap>
			</div>
		</div>
	</div>
</template>

<script>
import { gmapApi } from "vue2-google-maps";

export default {
	computed: {
		google: gmapApi
	},
	props: [],

	data: function() {
		return {
			data: ""
			// map: null,
			// lat: 25.013024,
			// lng: 121.214896
		};
	},

	mounted() {},

	methods: {}
};
</script>

<style scoped>
.google-map {
	height: 500px;
}
</style>
