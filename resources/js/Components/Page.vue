<script setup lang="ts">

import Page from "@/types/Page";

const props = defineProps<{
    page: Page
}>();

</script>

<template>

    <div class="p-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{props.page.title}}</h2>

        <div v-html="props.page.content ? props.page.content : '<i>No page content found</i>'"></div>
    </div>

</template>
