<script setup lang="ts">

import PreviewPage from "@/Modal/Pages/PreviewPage.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import DangerButton from "@/Components/DangerButton.vue";
import TextEditor from "@/Components/TextEditor.vue";
import TextInput from "@/Components/TextInput.vue";
import {ref, watch} from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputDescription from "@/Components/InputDescription.vue";

const props = defineProps<{
    page: {
        id: number;
        title: string;
        content: string;
    }
}>();

const form = useForm({
    title: props.page ? props.page.title : '',
    content: props.page ? props.page.content : '',
});

const submitForm = () => {
    if (props.page !== undefined) {
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

const getTitle = () => {
    return props.page ? 'Edit page' : 'Create page';
}

watch(form, () => {
    changes.value = true;
}, {deep: true});

const changes = ref(false);

</script>

<template>
    <Head :title="getTitle()"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ getTitle() }}</h2>

                <Link :href="route('pages.index')" class="flex flex-col">
                    <DangerButton v-if="changes">Back</DangerButton>
                    <PrimaryButton v-if="!changes">Back</PrimaryButton>
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                    <form action="">
                        <div class="py-4">
                            <InputLabel>Title</InputLabel>
                            <TextInput class="w-full" v-model="form.title"/>
                            <InputDescription>This is the name shown in the navigation</InputDescription>
                        </div>

                        <div class="py-4">
                            <TextEditor v-model="form.content"></TextEditor>
                        </div>

                        <div class="flex justify-end">
                            <PrimaryButton @click="submitForm">Submit</PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
