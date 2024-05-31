<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import PortfolioGrid from "@/Pages/Portfolio/PortfolioGrid.vue";

const props = defineProps<{
    nodes: {
        title: string;
        image: string;
    }[];
}>();

</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Preview</h2>
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-2 lg:px-6">

                <div class="flex justify-center">
                    <PortfolioGrid :nodes="nodes" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
