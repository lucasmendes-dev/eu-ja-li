<script setup>
import { computed } from 'vue';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
    books: Object
});

const statusColors = {
    not_completed: 'bg-red-600 text-white',
    in_progress: 'bg-blue-600 text-white',
    abandoned: 'bg-orange-500 text-white',
    completed: 'bg-green-600 text-white',
};

function statusColorClass(status) {
    return this.statusColors[status];
}

function bookStatusLabel(status) {
    const labels = {
        not_completed: 'Não Lido',
        in_progress: 'Lendo',
        abandoned: 'Abandonado',
        completed: 'Lido',
    };
    return labels[status];
}

function askDelete(bookId) {
    if (window.confirm("Você irá deletar o livro e não será possível recuperar.")) {
        router.delete(route('books.destroy', bookId));
    }
}

</script>

<template>
    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-700">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 flex items-center">
                    Título
                    <Link :href="route('books', { ...route().params, orderByField: 'title' })">
                        <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                        </svg>
                    </Link>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        Autor
                        <Link :href="route('books', { ...route().params, orderByField: 'author' })">
                            <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                            </svg>
                        </Link>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        Gênero
                        <Link :href="route('books', { ...route().params, orderByField: 'genre' })">
                            <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                            </svg>
                        </Link>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3 flex items-center">
                    Ano de Leitura
                    <Link :href="route('books', { ...route().params, orderByField: 'read_in' })">
                        <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                        </svg>
                    </Link>
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
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
                    {{ book.genre }}
                </td>

                <td class="px-6 py-4">
                    <span v-if="book.read_in" class="ml-4"> {{ book.read_in.slice(0, 4) }} </span>
                    <span v-else class="ml-6"> - </span>
                </td>

                <td class="px-6 py-4">
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