<script setup>

defineProps({ 
    books: Array
});


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
                    {{ book.status }}
                </td>
                <td class="px-6 py-4">
                    {{ book.read_in }}
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="dark:text-blue-500 hover:underline mx-2">
                        <ion-icon name="create-outline" class="w-4 h-4"></ion-icon>
                    </a>

                    <button data-record-id="" class="dark:text-red-500 hover:underline delete-button" type="button">
                        <ion-icon name="trash-outline" class="w-4 h-4"></ion-icon>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>


</template>