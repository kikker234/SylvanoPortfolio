<script setup lang="ts">
import {Head, Link} from '@inertiajs/vue3';
import PortfolioGrid from "@/Pages/Portfolio/PortfolioGrid.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps<{
    nodes: {
        title: string;
        image: string;
    }[];
}>();
</script>

<template>
    <Head title="Welcome"/>

    <div class="flex justify-center items-center min-h-screen bg-slate-200">
        <PortfolioGrid :nodes="nodes"/>
    </div>

    <footer class="h-fit w-full p-3 shadow-lg">

        <div class="md:flex w-full justify-end">
            <Link :href="route('dashboard')">
                <PrimaryButton class="w-full flex justify-center">
                    Dashboard
                </PrimaryButton>
            </Link>
        </div>
    </footer>
</template>
