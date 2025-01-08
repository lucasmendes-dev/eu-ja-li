<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Filter from './Books/Filter.vue';
import BookList from './Books/BookList.vue';
import CreateModal from './Books/CreateModal.vue';

import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({ books: Object });

const isModalOpen = ref(false);
const openModal = () => (isModalOpen.value = true);
const closeModal = () => (isModalOpen.value = false);

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
                        <div class="flex items-center mb-2 justify-between">
                            <h2 class="text-xl font-semibold leading-tight text-gray-800 mb-2 ml-2">
                                Meus Livros
                            </h2>
                            <button  class="text-white end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-2"
                                @click="openModal" >
                                Adicionar Livro
                            </button>
                        </div>
                        <BookList :books="books"/>
                    </div>
                </div>
            </div>
        </div>
        <CreateModal :isOpen="isModalOpen" @close="closeModal"</CreateModal>
    </AuthenticatedLayout>
</template>
