<script setup>
import { Link } from '@inertiajs/vue3';

const storeProduct = (product) => {
	//set array to items in localStorage or an empty array in case the localStorage is empty
	let productArray = JSON.parse(localStorage.getItem('checkOutItems')) || [];
	//push the new product object into the array
	productArray.push(product)
	//set the localStorage to the new array
	localStorage.setItem('checkOutItems', JSON.stringify(productArray))
}

defineProps({
	productDetails: Object
})

</script>
<template>
	<div class="bg-white p-4 mx-2 rounded shadow-md">
		<h3 class="text-lg font-semibold">{{ productDetails.name }}</h3>
 		<img class="w-36 h-36" :src="`/images/${productDetails.image_filename}`" :alt="productDetails.name">
		<p class="m-2 text-gray-500">{{productDetails.size}}</p>
		<div class="grid grid-cols-4 grid-rows-1 gap-2 mb-2 bg-gray-300 rounded-md">
			<p class="col-span-2 row-span-1  flex items-center justify-center">Kshs.{{ productDetails.promotional_price }}</p>
			<div class="col-span-2 row-span-1 space-y-2 flex-col mx-2 items-center justify-center">
				<p class="line-through text-sm">Kshs.{{ productDetails.original_price }}</p>
				<p class="pb-2">Save: {{ productDetails.saving }}%</p>
			</div>
		</div>
		<Link class="mx-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" :href="route('checkout')" method="get" @click="storeProduct(productDetails)" as="button">
			Add to cart
		</Link>
	</div>
</template>