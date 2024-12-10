<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Filter from './Books/Filter.vue';
import BookList from './Books/BookList.vue';
import { Head } from '@inertiajs/vue3';

defineProps({ books: Array });
</script>

<template>
    <Head title="Meus Livros" />

    <AuthenticatedLayout>
        <!-- <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Filtros
            </h2>
        </template> -->

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <Filter/>
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <h2 class="text-xl font-semibold leading-tight text-gray-800 mb-2">
                            Meus Livros
                        </h2>
                        <BookList :books="books"/>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
