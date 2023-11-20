<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import NavigationLayout from '@/Layouts/NavigationLayout.vue'
import ProductsLayout from '@/Layouts/ProductsLayout.vue'

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    }
});

</script>

<template>
    <Head title="Welcome" />
    <NavigationLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
        </template>
        <ProductsLayout/>
    </NavigationLayout>

</template>

<style>

</style>
