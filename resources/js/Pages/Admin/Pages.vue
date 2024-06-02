<script setup lang="ts">

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputCheckbox from "@/Components/InputCheckbox.vue";
import PreviewPage from "@/Modal/Pages/PreviewPage.vue";
import {ref} from "vue";

const props = defineProps<{
    pages: any
}>();

const show = ref(false);

</script>

<template>
    <Head title="Pages"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pages</h2>
            </div>
        </template>


        <div v-for="page in pages" class="p-3 mt-3 mx-3 md:mx-24 shadow-lg rounded-lg bg-white">
            <div class="flex items-center justify-between">
                <div class="">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">{{ page.title }}</h2>
                </div>

                <div class="flex gap-3">
                    <PrimaryButton @click="() => show = true">Preview</PrimaryButton>
                    <PrimaryButton>Edit</PrimaryButton>
                </div>
            </div>
        </div>

        <PreviewPage :onClose="() => {
            console.log('Close');
            show = false;
        }" :show="show" :page="pages[0]"></PreviewPage>
    </AuthenticatedLayout>
</template>
