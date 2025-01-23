<script setup>
import { ref, reactive } from 'vue';
import { router } from '@inertiajs/vue3';

const form = reactive({
    title: '',
    author: '',
    genre: '',
    read_in: '',
    status: '',
});

function filterBooks() {
    router.get(route('books'), { search: form }, { preserveState: true, preserveScroll: true });
}

function clear() {
    router.get(route('books'));
}

</script>

<template>
    
<form @submit.prevent="filterBooks" class="max-w-md mb-5">   
    <div class="flex mt-5">
        <div class="mr-6">
            <label for="title" class="block mb-2 text-sm font-medium">Nome do Livro</label>
            <input v-model="form.title" type="text" id="title" class="block p-3 px-5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-100 dark:border-blue-500 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-gray-500" placeholder="Ex: Dom Casmurro" />
        </div>

        <div class="mr-5">
            <label for="author" class="block mb-2 text-sm font-medium">Nome do Autor</label>
            <input v-model="form.author" type="text" id="author" class="block p-3 px-5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-100 dark:border-blue-500 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-gray-500" placeholder="Ex: Machado de Assis" />
        </div>

        <div class="mr-6">
            <label for="genre" class="block mb-2 text-sm font-medium">Gênero</label>
            <input v-model="form.genre" type="text" id="genre" class="block p-3 px-5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-100 dark:border-blue-500 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-gray-500" placeholder="Ex: Romance" />
        </div>

        <div class="mr-6">
            <label for="read_in" class="block mb-2 text-sm font-medium">Ano de Leitura</label>
            <input v-model="form.read_in" type="number" id="read_in" class="block p-3 px-5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-100 dark:border-blue-500 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-gray-500" placeholder="Ex: 2021" />
        </div>

        <div class="mr-6">
            <label for="status" class="block mb-2 text-sm font-medium">Status</label>
            <select v-model="form.status" id="status" class="p-3 px-12 block text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-100 dark:border-blue-500 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-gray-500">
                <option value=""></option>
                <option value="not_completed" class="text-red-600">Não Lido</option>
                <option value="in_progress" class="text-blue-600">Em Leitura</option>
                <option value="abandoned" class="text-orange-500">Abandonado</option>
                <option value="completed" class="text-green-600">Lido</option>
            </select>
        </div>

        <div>
            <br>
            <button type="submit" class="text-white focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm p-3 px-7 mt-1 dark:bg-gray-600 dark:hover:bg-gray-700">Buscar</button>
        </div>
        <div>
            <br>

        </div>

    </div>
</form>

</template>