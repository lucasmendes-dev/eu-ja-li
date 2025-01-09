<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import CreateEditForm from './CreateEditForm.vue';

defineProps({ book: Object });
</script>

<template>
    <Head title="Editar - " />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <Link :href="route('books')" class="underline">Voltar</Link>

                        <h2 class="text-xl font-semibold leading-tight text-gray-800 mt-2 mb-2 ml-2 text-center">
                            Editar - {{ book.title }}
                        </h2>
                        <div class="mb-2 justify-between">
                            <CreateEditForm :book="book"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>