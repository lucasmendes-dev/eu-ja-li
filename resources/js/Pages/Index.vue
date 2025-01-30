<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Filter from './Books/Filter.vue';
import BookList from './Books/BookList.vue';
import CreateModal from './Books/CreateModal.vue';
import Pagination from './Books/Pagination.vue';

import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({ books: Object, search: Object, paginateNumber: Number, allBooks: Object });

const isModalOpen = ref(false);
const setPaginateNumber = ref(props.paginateNumber);
const openModal = () => (isModalOpen.value = true);
const closeModal = () => (isModalOpen.value = false);

function searchIsNotEmpty() {
    return Object.values(props.search).some(value => value !== null);
}

function changePaginateNumber() {
    router.get(route('books'), { 
        ...route().params,
        paginateNumber: setPaginateNumber.value 
    }, { preserveState: true, preserveScroll: true });
}

</script>

<template>
    <Head title="Eu Já Li - Meus Livros" />

    <AuthenticatedLayout>  
        <div class="py-5">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg px-5 py-3">
                    <div class="flex">
                        <h2 class="text-xl font-semibold leading-tight text-gray-800">Filtros</h2>
                        <a v-if="searchIsNotEmpty()" :href="route('books')" class="ml-3 text-white rounded-lg p-1 px-6 dark:bg-gray-500 dark:hover:bg-gray-400">
                            <ion-icon name="reload-outline"></ion-icon>
                        </a>
                    </div>
                    <div class="flex">
                        <Filter class="w-full"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-2">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 mb-10"> 
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg" :class="{'mt-20' : books.total == 0}">

                    <div v-if="books.total > 0" class="p-6 text-gray-900">
                        <div class="flex items-center mb-2 justify-between">
                            <div class="flex">
                                <h2 class="text-xl font-semibold leading-tight text-gray-800 mb-2 ml-2">
                                    Meus Livros
                                </h2>
                                <p class="ml-3 mb-1 bg-gray-200 rounded-lg px-5 text-center">{{ books.total }}</p>
                            </div>
                            <button class="text-white end-2.5 bottom-2.5 bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 mb-2"
                                @click="openModal" >
                                Adicionar Livro
                            </button>
                        </div>
                        <BookList v-if="books.data.length > 0" :books="books"/>

                        <div class="flex justify-between mt-5 mb-5"> 
                            <div class="text-center">
                                <p class="text-sm">Mostrando</p>
                                <select v-model="setPaginateNumber" name="showing" id="showing" class="rounded-lg p-1 px-7 text-gray-700" @change="changePaginateNumber">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <Pagination class="float-end" :links="books.links" :books="books" :paginateNumber="paginateNumber"/>
                        </div>
                    </div>

                    <div v-else class="p-6 text-gray-900">
                        <div v-if="searchIsNotEmpty()" class="flex justify-between mt-5 mb-5"> 
                            <h1 class="text-gray-700">
                                Nenhum resultado encontrado para
                                <span v-for="item in Object.values(search)">
                                    <span v-if="item"> - </span>
                                    <span v-if="item" >'{{ item }}'</span>
                                </span>
                            </h1>
                        </div>

                        <div v-else>
                            <div class="py-8">
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <div class="p-6 text-gray-900 dark:text-gray-100">
                                        <div class="flex items-center justify-center">
                                            <a href="/">
                                                <img src="images/logo.png" width="100px" alt="logo">
                                            </a>
                                        </div>
                                        <h1 class="font-semibold text-xl text-gray-800 leading-tight flex items-center justify-center">Seja bem-vindo, {{ $page.props.auth.user.name }}!</h1>

                                        <div class="text-center mt-8">
                                            <p class="text-lg text-gray-700 mb-4">Você ainda não possui livros cadastrados.</p>    
                                            <button class="text-white end-2.5 bottom-2.5 bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 mb-2"
                                                @click="openModal" >
                                                Cadastrar Meu Primeiro Livro
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <CreateModal :allBooks="allBooks" :isOpen="isModalOpen" @close="closeModal" />
    </AuthenticatedLayout>
</template>
