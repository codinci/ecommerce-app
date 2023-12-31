<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const showNavigationDropdown = ref(false);

//clear localStorage on logging out
const clearLocalStorage = () => {
    localStorage.clear()
}


</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <Link class="flex" href="/">
                                <ApplicationLogo
                                    class="block h-9 w-auto fill-current text-gray-800 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500"
                                />
                                <h1 class="ml-2 mt-2 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">
                                    Chapa Online Store
                                </h1>
                            </Link>
                        </div>

                        <!-- Navigation Links -->
                        <div v-if="$page.props.auth.user && $page.props.auth.user.role === 'admin'" class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <NavLink  :href="route('dashboard')" :active="route().current('dashboard')">
                                Dashboard
                            </NavLink>
                            <NavLink  :href="route('product.create')" :active="route().current('product.create')">
                                New Product
                            </NavLink>
                        </div>
                        <div v-else class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <NavLink  href="/" :active="route().current('home')">
                                Home
                            </NavLink>
                            <NavLink :href="route('checkout')" :active="route().current('checkout')">
                                Cart
                            </NavLink>
                        </div>
                    </div>

                    <div v-if="!$page.props.auth.user" class="hidden sm:flex sm:top-0 sm:right-0 p-6 text-end">
                        <Link
                            :href="route('login')"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                        >
                            Login
                        </Link>
                        <Link
                            :href="route('register')"
                            class="ml-2 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                        >
                            Register
                        </Link>
                    </div>
                    <div v-else class="hidden sm:flex sm:items-center sm:ms-6">
                        <!-- Settings Dropdown -->
                        <div class="ms-3 relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                        >
                                            {{$page.props.auth.user.name}}

                                            <svg
                                                class="ms-2 -me-0.5 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('logout')" method="post" as="button" @click="clearLocalStorage">
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>


                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button
                            @click="showNavigationDropdown = !showNavigationDropdown"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                        >
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path
                                    :class="{
                                        hidden: showNavigationDropdown,
                                        'inline-flex': !showNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{
                                        hidden: !showNavigationDropdown,
                                        'inline-flex': showNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>


                </div>
            </div>

              <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showNavigationDropdown, hidden: !showNavigationDropdown }"
                    class="sm:hidden"
                >
                    <div v-if="$page.props.auth.user && $page.props.auth.user.role === 'admin'" class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink  :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink  :href="route('product.create')" :active="route().current('product.create')">
                            New Product
                        </ResponsiveNavLink>
                    </div>
                    <div v-else class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink href="/" :active="route().current('home')">
                            Home
                        </ResponsiveNavLink>
                        <ResponsiveNavLink  :href="route('checkout')" :active="route().current('checkout')">
                            Cart
                        </ResponsiveNavLink>

                    </div>
                    <div v-if="!$page.props.auth.user" class="pt-2 pb-3 px-2 space-y-1">
                        <div>
                            <Link
                                :href="route('login')"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            >
                                Log in
                            </Link>
                        </div>
                        <div>
                            <Link
                                :href="route('register')"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            >
                                Register
                            </Link>
                        </div>
                    </div>

                    <div v-else class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button" @click="clearLocalStorage">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
        </nav>

        <!-- Page Heading -->
        <header class="bg-white shadow" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>


        <!-- Page Content -->
        <main>
            <slot />
        </main>
    </div>
</template>