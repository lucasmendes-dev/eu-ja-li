<script setup>
import { computed } from 'vue';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
    books: Object
});

const statusColors = {
    not_completed: 'bg-red-400 text-white',
    in_progress: 'bg-blue-400 text-white',
    completed: 'bg-green-400 text-white',
};

function statusColorClass(status) {
    return this.statusColors[status];
}

function bookStatusLabel(status) {
    const labels = {
        not_completed: 'Não Lido',
        in_progress: 'Lendo',
        completed: 'Lido',
    };
    return labels[status];
}

function askDelete(bookId) {
    if (window.confirm("Você irá deletar o livro e não será possível recuperar!")) {
        router.delete(route('books.destroy', bookId));
    }
}

</script>

<template>
    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-700">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Título
                </th>
                <th scope="col" class="px-6 py-3">
                    Autor
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Ano de Leitura
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="book in books.data" :key="book.id" class="bg-white border-b dark:bg-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-300">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ book.title }}
                </th>
                <td class="px-6 py-4">
                    {{ book.author }}
                </td>
                <td class="px-6 py-4">
                    <!-- <span class="bg-green-400 rounded-full px-2"> -->
                    <span
                        :class="[
                            'rounded-full px-2',
                            statusColorClass(book.status)
                        ]"
                    >
                        {{ bookStatusLabel(book.status) }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <span v-if="book.read_in"> {{ book.read_in.slice(0, 4) }} </span>
                    <span v-else> - </span>
                </td>
                <td class="px-6 py-4">
                    <Link :href="route('books.edit', book.id)" class="dark:text-blue-500 hover:underline mx-2">
                        <ion-icon name="create-outline" class="w-4 h-4"></ion-icon>
                    </Link>

                    <button @click="askDelete(book.id)" data-record-id="" class="dark:text-red-500 hover:underline delete-button" type="button">
                        <ion-icon name="trash-outline" class="w-4 h-4"></ion-icon>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>


</template>