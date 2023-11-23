<script setup>
import { ref, computed }  from 'vue'
import { Head, Link } from '@inertiajs/vue3';
import NavigationLayout from '@/Layouts/NavigationLayout.vue';

const STORAGE_KEY = 'checkOutItems';

const checkoutItems = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];

//add quantity property to each object in the checkoutItems array and make it reactive
let cartItems = ref(checkoutItems.map(item => {
    return {...item, quantity: 1}
}))


const removeItem = (index) => {
    cartItems.value.splice(index, 1);
};

const increaseQuantity = (index) => {
    cartItems.value[index].quantity++
};


const decreaseQuantity = (index) => {
    if (cartItems.value[index].quantity > 1) {
        cartItems.value[index].quantity--;
    }
};

//calculate the price of each indivicual cart item based on quantity
const calculatedItemPrice = (item) => {
    const itemPrice = item.promotional_price * item.quantity
    return formatCurrency(itemPrice)
}

//Calculate the total price of cart items
const getTotalPrice = (items) => {
    return items.reduce((total, item) => {
        const itemPrice = item.quantity * item.promotional_price;
        return total + itemPrice
    }, 0)
}

//format number as currency
const formatCurrency = (value) => {
    return value.toLocaleString('en-US', { style: 'currency', currency: 'KSH' });
}

const total = computed(() => getTotalPrice(cartItems.value));
</script>

<template>
    <Head title="Cart" />
    <NavigationLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cart</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="!cartItems.length" class="text-center text-gray-600">
                    <p>No items in the cart</p>
                </div>
                <div v-else class="flex flex-col gap-4 p-4">
                    <!-- Loop to display each individual checkout item -->
                    <div v-for="(item, index) in cartItems" :key="index">
                    <div class="flex flex-col bg-white">
                        <!-- Checkout image, name, and delete button -->
                        <div class="flex justify-between mt-2">
                        <div class="flex">
                            <img :src="`/images/${item.image_filename}`" :alt="item.name" class="w-20 md:w-60 h-18 md:h-40 object-cover m-2">
                            <h3 class="text-grey-600 text-lg font-semibold">{{ item.name }}</h3>
                        </div>
                        <button @click="removeItem(index)" class="p-4 mt-[-3rem] md:mt-[-8rem]  text-red-400 hover:text-red-600 hover:scale-1">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        </div>
                        <!-- Checkout quantity and price -->
                        <div class="flex justify-between md:justify-end m-2 p-2">
                        <div class="flex flex-col p-2">
                            <h4 class="text-gray-700 text-sm mb-2 md:text-base">Quantity</h4>
                            <div class="flex items-center space-x-2 border-2">
                            <button @click="decreaseQuantity(index)" :disabled="item.quantity <= 1" class="text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                </svg>
                            </button>
                            <span class="p-2">{{ item.quantity }}</span>
                            <button @click="increaseQuantity(index)" class="text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                            </div>
                        </div>
                        <p class="p-2 mt-12">{{ calculatedItemPrice(item) }}</p>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="flex flex-col items-start w-48 float-right mr-8">
                    <p class="mb-4">Total: {{ formatCurrency(total) }}</p>
                    <Link class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" :href="route('order', { total: total })" method="get" as="button">
                        Checkout
                    </Link>
                </div>

            </div>
        </div>
    </NavigationLayout>
</template>
