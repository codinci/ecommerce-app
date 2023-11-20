<script setup>
import ProductCard from '@/Components/ProductCard.vue'

const items = [
	{ name: 'Shoes', image: '/images/shoes.jpg', size: 'large', price: 'Ksh. 1000', saving: '10%'},
	{ name: 'Shoes', image: '/images/shoes.jpg', size: 'large', price: 'Ksh. 1000', saving: '10%'},
	{ name: 'Shoes', image: '/images/shoes.jpg', size: 'large', price: 'Ksh. 1000', saving: '10%'},
	{ name: 'Shoes', image: '/images/shoes.jpg', size: 'large', price: 'Ksh. 1000', saving: '10%'},
	{ name: 'Shoes', image: '/images/shoes.jpg', size: 'large', price: 'Ksh. 1000', saving: '10%'},
	{ name: 'Shoes', image: '/images/shoes.jpg', size: 'large', price: 'Ksh. 1000', saving: '10%'},
	{ name: 'Shoes', image: '/images/shoes.jpg', size: 'large', price: 'Ksh. 1000', saving: '10%'},
	{ name: 'Shoes', image: '/images/shoes.jpg', size: 'large', price: 'Ksh. 1000', saving: '10%'},
]
</script>
<template>
	<main class="bg-gray-100">
		<div class="container mx-auto my-8">

			<!-- Repeat the following item block for each of your 20 items -->
			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
				 <ProductCard v-for="(item, index) in items" :key="index" :productDetails="item" />
			</div>
		</div>
	</main>
</template>