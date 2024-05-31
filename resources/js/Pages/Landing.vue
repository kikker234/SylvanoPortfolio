<script setup lang="ts">
import {Head, Link} from '@inertiajs/vue3';
import PortfolioGrid from "@/Pages/Portfolio/PortfolioGrid.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();

function navigate() {
    window.location.href = '/dashboard';
}
</script>

<template>
    <Head title="Welcome"/>

    <div class="flex justify-center items-center min-h-screen bg-slate-200">
        <PortfolioGrid/>
    </div>

    <footer class="h-fit p-3 shadow-lg">

        <div class="flex justify-end">
            <PrimaryButton @click="navigate">Admin</PrimaryButton>
        </div>
    </footer>
</template>
