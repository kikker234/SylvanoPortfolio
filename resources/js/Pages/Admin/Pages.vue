<script setup lang="ts">

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputCheckbox from "@/Components/InputCheckbox.vue";
import PreviewPage from "@/Modal/Pages/PreviewPage.vue";
import {ref} from "vue";
import Page from "@/types/Page";

const props = defineProps<{
    pages: any
}>();


const previewPage = ref(undefined);

const showPreview = (page: Page) => {
    previewPage.value = page;
}

const closePreview = () => {
    previewPage.value = undefined;
    console.log(previewPage.value)
}

</script>

<template>
    <Head title="Pages"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pages</h2>

                <Link :href="route('pages.create')">
                    <PrimaryButton>Create Page</PrimaryButton>
                </Link>
            </div>
        </template>


        <div v-for="page in pages" class="p-3 mt-3 mx-3 md:mx-24 shadow-lg rounded-lg bg-white">
            <div class="flex items-center justify-between">
                <div class="">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">{{ page.title }}</h2>
                </div>

                <div class="flex gap-3">
                    <PrimaryButton @click="() => showPreview(page)">Preview</PrimaryButton>

                    <Link :href="route('pages.edit', page.id)">
                        <PrimaryButton>Edit</PrimaryButton>
                    </Link>
                </div>
            </div>
        </div>

        <PreviewPage :onClose="closePreview"  :page="previewPage"></PreviewPage>
    </AuthenticatedLayout>
</template>
