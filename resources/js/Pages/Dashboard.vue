<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-bold text-2xl text-sky-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white/90 border border-sky-100 overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6 text-sky-900">Selamat datang di Lapak Mahasiswa 👋</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
