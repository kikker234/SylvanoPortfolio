<script setup lang="ts">
import {Head, Link} from '@inertiajs/vue3';
import PortfolioGrid from "@/Pages/Portfolio/PortfolioGrid.vue";
import PortfolioLayout from "@/Layouts/PortfolioLayout.vue";

defineProps<{
    nodes: {
        title: string;
        image: string;
    }[];
}>();
</script>

<template>
    <Head title="Welcome"/>

    <PortfolioLayout>

        <div class="flex justify-center items-center min-h-screen">
            <PortfolioGrid :nodes="nodes"/>
        </div>

    </PortfolioLayout>
</template>
