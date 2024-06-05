<script setup lang="ts">

import PortfolioLayout from "@/Layouts/PortfolioLayout.vue";
import {Head} from "@inertiajs/vue3";
import GlassCard from "@/Components/GlassCard.vue";

const props = defineProps<{
    page: {
        title: string;
        content: string;
    }
}>();


</script>

<template>

    <Head :title="props.page.title"/>

    <PortfolioLayout>
        <div class="flex justify-center items-center p-3">
            <GlassCard class="rounded-lg">
                <h1>{{ props.page.title }}</h1>
                <div v-html="props.page.content"></div>
            </GlassCard>
        </div>
    </PortfolioLayout>

</template>

<style scoped>

</style>
