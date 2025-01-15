<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    links: Array,
    books: Object,
    paginateNumber: Number
});

function recordsPerPage() {
    let recordsPerPage = props.books.current_page * props.paginateNumber;
    if (recordsPerPage >= props.books.total) {
        recordsPerPage = props.books.total
    }
    return recordsPerPage;
}

function numberOfItemsPerPage() {
    if (props.books.current_page == 1) {
        return 1;
    } else {
        return (props.paginateNumber * (props.books.current_page - 1)) + 1;
    }
}

</script>

<template>
    <div v-if="links.length > 0">
        <p class="flex justify-end text-sm text-gray-600 mr-3 mb-1"> {{ numberOfItemsPerPage() }} - {{ recordsPerPage() }} de {{ books.total }}</p>
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, linkIndex) in links" :key="linkIndex">
                <div
                    v-if="link.url === null"
                    v-html="link.label"
                    class="mr-1 mb-1 px-4 py-2 text-sm leading-4 text-gray-500 border rounded"
                    preserveState="true" preserveScroll="true"
                >
                </div>

                <Link
                    v-else
                    class="mr-1 mb-1 px-4 py-2 text-sm leading-4 text-gray-500 border rounded hover:bg-gray-600 hover:text-gray-200
                        focus:boder-indigo-500 inline-block focus:text-white-500"
                    :class="{ 'bg-gray-600 text-white': link.active}"
                    :href="link.url"
                    preserveState="true" preserveScroll="true"
                >
                    <span v-html="link.label"></span>
                </Link>
            </template>
        </div>
    </div>
</template>
