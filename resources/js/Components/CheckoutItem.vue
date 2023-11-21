<script setup>
defineProps({
	item: Object
})
import { ref } from 'vue'

const quantity = ref(1)

// const decreaseQuanitity = (index) {

// }

// console.log(item)
</script>
<template>
	<div class="flex items-center bg-white p-4 mb-4 relative">

        <!-- Product Image -->
        <img :src="item.image" :alt="item.name" class="w-20 md:w-60 h-15 md:h-40 object-cover m-2">
        <!-- Product Details -->
        <div class="flex-1">
          <p class="text-lg font-semibold">{{ item.name }}</p>
        </div>

      <!-- Delete Icon -->
      <button @click="removeItem(index)" class="absolute top-0 right-0 p-4 text-red-400 hover:text-red-600 hover:scale-1">
        <i class="fa-solid fa-trash"></i>
      </button>

      <!-- Quantity and Price -->
      <div class="flex items-end ml-10 mt-12 md:mb-[-8rem]">
        <div class="flex flex-col md:m-2 ">
          <h4 class="text-gray-700 text-sm md:text-base">Quantity</h4>
          <div class="flex items-center space-x-2">
            <button @click="decreaseQuantity(index)" :disabled="quantity <= 1" class="text-gray-500">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
              </svg>
            </button>
            <span class="p-2">{{ quantity }}</span>
            <button @click="increaseQuantity(index)" class="text-gray-500">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
            </button>
          </div>
        </div>
        <p class="text-gray-600 md:ml-4 md:mb-4">{{ item.price }}</p>
      </div>
    </div>

</template>