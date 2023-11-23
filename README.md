# Ecommerce Application

This is a demo online shop

## Table of contents

- [Overview](#overview)
  - [Run Locally](#run-locally)
  - [The challenge](#the-challenge)
  - [Screenshot](#screenshot)
  - [Links](#links)
- [My process](#my-process)
  - [Built with](#built-with)
  - [What I learned](#what-i-learned)
  - [Continued development](#continued-development)
  - [Useful resources](#useful-resources)
- [Author](#author)


## Overview

### Run Locally

- First clone the application to your machine

### The challenge

Users should be able to:

- Register or login into the application
- View products on the platform
- Add items to cart
- Make an order and pick between two payment methods
- Filter products based on size

### Screenshot
### Desktop View
![Desktop Version](/public/images/screenshots/screenshot-desktop.png)

### Mobile View
- Mobile View
![Mobile Version](/public/images/screenshots/screenshot-mobile.png)
- Mobile Navigation
![Mobile Navigation](/public/images/screenshots/screenshot-mobile-navbar.png)

### Links

- Solution URL: [Github](https://github.com/codinci/url-shortening-api)

## My process

### Built with

- [Vue](https://vuejs.org/) - JS framework
- [Inertia](https://inertiajs.com/) - Adapter to create monolithic applications
- [Laravel](https://laravel.com/) - PHP framework
- [MySQL](https://www.mysql.com/) - Database management
- [Tailwind Css](https://tailwindcss.com/) - For styles
- [Fontawesome](https://fontawesome.com/) - For icons


### What I learned
- Made a refresher on development of Laravel, Inertia and VueJS
- Learnt on use of set to get unique properties in an array
```
const sizes = computed(() => {
	const sizeSet = [...new Set(props.products.map(product => product.size))]
	return sizeSet;
});
```
- Use of method poofing to handle update of a file upload
```
const form = useForm({
	_method: 'PUT',
    name: props.product.name,
    price: props.product.original_price,
	size: props.product.size,
	saving: props.product.saving,
	image: props.product.image_filename,
});
```
```
const submit = () => {
    form.post(route('product.update', {id : props.product.id}), {
        onFinish: () => form.reset(),
    });
};
```
```
<form @submit.prevent="submit">
	<input type="hidden" name="_method" v-model="form._method" />
```
- Making custom validations
```
<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Phonenumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
       if(!preg_match('/^(01|07)\d{8}$/', $value)) {
        $fail('The :attribute must be a a valid phone number.');
       }
    }
}
```


### Continued development

- Better error and success handling management.
- Save cart items to a state management store such as Pinia.
- Redirection of users based on their role.
- Utilize vue-router for enhanced routing on VueJS
- A user profile
- More categories and filter options.
- Improve on the UI/UX of the application.
- Managing orders via proper saving of properties such as the product being ordered
  and payment of the order.


### Useful resources

- [Stack OverFlow](https://stackoverflow.com/questions/69297185/updating-the-image-in-laravel-8-inertia-validation-error-even-the-fields-are) - This helped me gain insight on method poofing in order to help resolve update of a file upload
- [Stack OverFlow](https://stackoverflow.com/questions/1960473/get-all-unique-values-in-a-javascript-array-remove-duplicatesb) - This helped me gain insight on how to extract unique values from an array.

## Author
- Github - [codinci](https://github.com/codinci)

