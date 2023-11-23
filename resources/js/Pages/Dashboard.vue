<script setup>
import { ref, computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import NavigationLayout from '@/Layouts/NavigationLayout.vue';

const props = defineProps(['products']);

//defining pages
const pageSize = ref(10);
const currentPage = ref(1);

const totalPages = computed(() => Math.ceil(props.products.length / pageSize.value));

//defining items per page
const paginatedProducts = computed(() => {
  const start = (currentPage.value - 1) * pageSize.value;
  const end = start + pageSize.value;
  return props.products.slice(start, end);
});

//defining number of pages
const pages = computed(() => Array.from({ length: totalPages.value }, (_, index) => index + 1));

//page movement functions
const gotoPage = (page) => {
  currentPage.value = page;
};

const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    currentPage.value++;
  }
};

const prevPage = () => {
  if (currentPage.value > 1) {
    currentPage.value--;
  }
};

//product deletion
const confirmingProductDeletion = ref(false);
const productToDelete = ref(null);
const form = useForm({});
const confirmProductDeletion = (product) => {
    confirmingProductDeletion.value = true;
    productToDelete.value = product;
};
const closeModal = () => {
    confirmingProductDeletion.value = false;
};

const deleteProduct = (id) => {
    form.delete(route('product.destroy', { id: id }), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => 'Something went wrong',
        onFinish: () => form.reset(),
    });
};


</script>

<template>
    <Head title="Dashboard" />
    <NavigationLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>

                <Link class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" :href="route('product.create')" method="get" as="button">
                    New Product
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div v-if="!products.length" class="text-gray-900">No Products</div>
                    <div v-else>
                    <!-- Table -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col" class="px-2 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Promotional Price
                            </th>
                            <th scope="col" class="hidden md:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Size
                            </th>
                            <th scope="col" class="px-2 md:px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="product in paginatedProducts" :key="product.id">
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                            {{ product.name }}
                            </td>
                            <td class="px-2 md:px-6 py-4 whitespace-nowrap">
                                {{ product.promotional_price }}
                            </td>
                            <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap">
                                {{ product.size }}
                            </td>
                            <td class="px-2 md:px-6 py-4 flex md:justify-around whitespace-nowrap">
                                <Link :href="route('product.edit', { id: product.id })" class="mx-2 md:mx-0 text-blue-400 hover:text-blue-600 hover:scale-1">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </Link>
                                <DangerButton @click="confirmProductDeletion(product)">
                                    <i class="fa-solid fa-trash"></i>
                                </DangerButton>

                            </td>

                        </tr>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <nav class="mt-4">
                        <ul class="pagination flex justify-evenly">
                        <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
                            <PrimaryButton @click="prevPage">Previous</PrimaryButton>
                        </li>
                        <li class="page-item" v-for="page in pages" :key="page" :class="{ 'active': page === currentPage }">
                            <button @click="gotoPage(page)">{{ page }}</button>
                        </li>
                        <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
                            <PrimaryButton @click="nextPage">Next</PrimaryButton>
                        </li>
                        </ul>
                    </nav>
                    </div>
                </div>
            </div>

            <Modal :show="confirmingProductDeletion" @close="closeModal">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">
                        Are you sure you want to delete  {{ productToDelete.name }}?
                    </h2>

                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                        <DangerButton
                            class="ms-3"
                            @click="deleteProduct(productToDelete.id)"
                        >
                            Delete Product
                        </DangerButton>
                    </div>
                </div>
            </Modal>
        </div>
    </NavigationLayout>
</template>
