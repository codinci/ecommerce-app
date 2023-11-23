<script setup>
import { ref }  from 'vue'
import { Head, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import NavigationLayout from '@/Layouts/NavigationLayout.vue';

const props = defineProps(['total']);
const paymentMethod = ref('method1');

const form = useForm({
	total: props.total,
})

const submit = () => {
    form.post(route('order.create'), {
        onFinish: () => form.reset(),
    });
};

//Format total price
const totalPrice = Number(props.total).toLocaleString('en-US', { style: 'currency', currency: 'KSH' });
</script>
<template>
	<Head title="Order" />
	<NavigationLayout>
		<template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Order Details</h2>
        </template>
		<div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

				<h2 class="text-lg font-semibold mb-4">Select Payment Method</h2>

				<form @submit.prevent="submit">
					<div>
						<input type="radio" id="method1" v-model="paymentMethod" value="method1" />
						<label for="method1" class="ml-2">Mpesa</label>
					</div>

					<div>
						<input type="radio" id="method2" v-model="paymentMethod" value="method2" />
						<label for="method2" class="ml-2">Airtel Money</label>
					</div>
					<div class="flex items-center justify-end mt-4">
						<PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
							Pay : {{ totalPrice }}
						</PrimaryButton>
					</div>
				</form>
			</div>
		</div>
	</NavigationLayout>

</template>