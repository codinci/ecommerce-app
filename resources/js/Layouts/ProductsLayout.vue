<script setup>
import { ref, computed, watch } from 'vue';
import ProductCard from '@/Components/ProductCard.vue'

const props = defineProps({
	products: Object
})
const sizes = computed(() => {
	const sizeSet = props.products.map(product => product.size)
	return sizeSet;
});
const selectedSize = ref(null);

const filteredProducts = ref(props.products);

watch(() => selectedSize.value, () => {
  filterProducts();
});

function filterProducts() {
  if (!selectedSize.value) {
    filteredProducts.value = props.products;
  } else {
    filteredProducts.value = props.products.filter((product) => product.size === selectedSize.value);
  }
}


</script>
<template>
	<main class="bg-gray-100">
		<div class="container mx-auto my-8">
			<div class="mb-4">
				<label for="sizeFilter" class="font-semibold">Filter by Size:</label>
				<select id="sizeFilter" v-model="selectedSize" class="ml-2 p-2">
					<option value="">All Sizes</option>
					<option v-for="size in sizes" :key="size" :value="size">{{ size }}</option>
				</select>
			</div>

			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
				 <ProductCard v-for="(item, index) in filteredProducts" :key="index" :productDetails="item" />
			</div>
		</div>
	</main>
</template>