<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() =>
    props.active
        ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-sky-500 text-left text-base font-medium text-sky-800 bg-sky-50 focus:outline-none focus:text-sky-900 focus:bg-sky-100 focus:border-sky-700 transition duration-150 ease-in-out'
        : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-700 hover:text-sky-900 hover:bg-sky-50 hover:border-sky-200 focus:outline-none focus:text-sky-900 focus:bg-sky-50 focus:border-sky-300 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
