<script setup>
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import NavigationLayout from '@/Layouts/NavigationLayout.vue';


const props = defineProps(['product'])
const form = useForm({
    name: props.product.name,
    price: props.product.original_price,
	size: props.product.size,
	saving: props.product.saving,
	image: props.product.image_filename,
});

//array of sizes for dropdown
const sizes = ['small', 'medium', 'large'];

const handleImageChange = (event) => {
	form.image = event.target.files[0];
};

const submit = () => {
    form.put(route('product.update', {id: props.product.id}), {
        onFinish: () => form.reset(),
    });
};

console.log(props.product);
</script>
<template>
	<NavigationLayout>
		<template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Product</h2>
        </template>
		 <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            	<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
					<form @submit.prevent="submit">
						<div>
							<InputLabel  for="name" value="Product Name" />
							<TextInput
								id="name"
								type="text"
								class="mt-1 block w-full"
								v-model="form.name"
								required
								autofocus
							/>

							<InputError class="mt-2" :message="form.errors.name" />
						</div>

						<div class="mt-4 flex flex-col md:flex-row justify-between">
							<div class="flex w-full md:w-1/3">
								<InputLabel class="w-1/2 md:w-1/4 my-auto" for="price" value="Product Price" />

								<TextInput
									id="price"
									type="text"
									class="mt-1 block w-1/2 md:w-3/4"
									v-model="form.price"
									required
								/>

								<InputError class="mt-2" :message="form.errors.price" />
							</div>
							<div class="flex w-full md:w-1/3 md:ml-4">
								<InputLabel class="my-auto w-1/2 md:mr-[-1rem]" for="saving" value="Product Saving" />

								<TextInput
									id="saving"
									type="text"
									class="mt-1 block w-1/2 md:w-full"
									v-model="form.saving"
									required
								/>
								<InputError class="mt-2" :message="form.errors.saving" />

							</div>
							<div class="flex w-full md:w-1/3 md:ml-4">
								<InputLabel class="my-auto w-1/2 md:w-1/4 md:mr-[-.5rem]" for="size" value="Product Size" />

								<select
									id="size"
									v-model="form.size"
									class="mt-1 block w-1/2 md:w-3/4"
									required
								>
									<option v-for="size in sizes" :key="size" :value="size">{{ size }}</option>
								</select>

								<InputError class="mt-2" :message="form.errors.size" />
							</div>

						</div>


						<div class="mt-4">
                            <InputLabel for="image" value="Product Image" />
							<img v-if="form.image"  :src="`/images/${form.image}`" alt="form.name" class="mt-2 block w-32 h-32" />

                            <input
                                id="image"
                                type="file"
                                class="mt-1 block w-full"
								@change="handleImageChange"
                            />

                            <InputError class="mt-2" :message="form.errors.image" />
						</div>



						<div class="flex items-center justify-end mt-4">
							<PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
								Update product
							</PrimaryButton>
						</div>
					</form>
				</div>
			</div>
		</div>


	</NavigationLayout>

</template>