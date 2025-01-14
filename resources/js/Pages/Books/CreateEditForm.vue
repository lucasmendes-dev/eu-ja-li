<script setup>
import { reactive, defineEmits } from 'vue';
import { router } from '@inertiajs/vue3';

const emit = defineEmits(['close']);
const props = defineProps({ book: Object });

const form = reactive({
    title: props.book?.title || '',
    author: props.book?.author || '',
    genre: props.book?.genre || '',
    year: parseInt(props.book?.year) || '',
    read_in: parseInt(props.book?.read_in) || '',
    status: props.book?.status || ''
});

function submit() {
    if (props.book == undefined) {
        router.post(route('books.store'), form, {
            onSuccess: () => {
                emit('close');
            },
            onError: (errors) => {
                console.error('Erro ao salvar:', errors);
            }
        });
    } else {
        router.put(route('books.update', props.book.id), form);
    }

}

</script>

<template>
    <form @submit.prevent="submit" class="max-w-sm mx-auto mt-5">
        <div class="flex space-x-4">
            <div class="mb-5  w-full">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 w-1/2">Título <span class="text-red-500">*</span></label>
                <input type="text" id="title" v-model="form.title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" required  placeholder="Nome do livro"/>
            </div>

            <div class="mb-5  w-full">
                <label for="author" class="block mb-2 text-sm font-medium text-gray-900 w-1/2">Autor <span class="text-red-500">*</span></label>
                <input type="text" id="author" v-model="form.author" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" required  placeholder="Nome do autor"/>
            </div>
        </div>

        <div class="flex space-x-4">
            <div class="mb-5  w-full">
                <label for="genre" class="block mb-2 text-sm font-medium text-gray-900 w-1/2">Gênero</label>
                <input type="text" id="genre" v-model="form.genre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"  placeholder="Ex: Romance"/>
            </div>

            <div class="mb-5  w-full">
                <label for="year" class="block mb-2 text-sm font-medium text-gray-900 ">Ano de Publicação</label>
                <input type="number" id="year" min="1500" step="1" v-model="form.year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ex: 2009"/>
            </div>
        </div>

        <div class="flex space-x-4">
            <div class="mb-5 w-full">
                <label for="read_in" class="block mb-2 text-sm font-medium text-gray-900">Lido em</label>
                <input type="number" id="read_in" min="1500" step="1" v-model="form.read_in"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                        dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    placeholder="Ex: 2021"/>
            </div>

            <div class="mb-5 w-full">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status <span class="text-red-500">*</span></label>
                <select id="genre" v-model="form.status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 appearance-none" required>
                    <option value="not_completed" class="text-red-400">Não Lido</option>
                    <option value="in_progress" class="text-blue-400">Em Leitura</option>
                    <option value="abandoned" class="text-orange-400">Abandonado</option>
                    <option value="completed" class="text-green-400">Lido</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end ">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <span v-if="book">Alterar Livro</span>
                <span v-else>Adicionar Livro</span>
            </button>
        </div>
    </form>
</template>
