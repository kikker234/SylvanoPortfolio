<script setup lang="ts">

import {Link, usePage} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Page from "@/types/Page";

const page = usePage();
const customPages = page.props.pages as Page[];

const getRoute = (page: Page) => {
    return page.id != -1 ? route('page.show', page.title) : route('landing');
}

</script>

<template>
    <div class="flex items-center flex-col md:flex-row">

        <Link class="mx-2" v-for="page in customPages" :key="page.id"
              :href="getRoute(page)">

            <PrimaryButton>{{ page.title }}</PrimaryButton>
        </Link>
    </div>
</template>

<style scoped>

</style>
