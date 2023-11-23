<script setup>
import { Head, Link } from '@inertiajs/vue3';
import NavigationLayout from '@/Layouts/NavigationLayout.vue'
import ProductsLayout from '@/Layouts/ProductsLayout.vue'

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    products: {
        type: Object,
    }
});

</script>

<template>
    <Head title="Welcome" />
    <NavigationLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
        </template>
        <ProductsLayout :products="products"/>
    </NavigationLayout>

</template>

<style>

</style>
