<script setup lang="ts">

import PreviewPage from "@/Modal/Pages/PreviewPage.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import DangerButton from "@/Components/DangerButton.vue";
import TextEditor from "@/Components/TextEditor.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps<{
    page: {
        id: number;
        title: string;
        content: string;
    }
}>();

const form = useForm({
    title: props.page.title,
    content: props.page.content,
});

const submitForm = () => {
    if(props.page !== undefined) {
        updatePage();
    } else {
        createPage();
    }
}

const createPage = () => {
    form.post(route('pages.store'));
}

const updatePage = () => {
    form.put(route('pages.update', props.page.id));
}

</script>

<template>
    <Head title="Page editor"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Page editor</h2>

                <Link :href="route('pages.index')" class="flex flex-col">
                    <DangerButton>Back</DangerButton>
                </Link>
            </div>
        </template>

        <div class="">
            <form action="">
                <TextInput v-model="form.title" />
                <TextEditor v-model="form.content"></TextEditor>

                <PrimaryButton @click="submitForm">Submit</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
