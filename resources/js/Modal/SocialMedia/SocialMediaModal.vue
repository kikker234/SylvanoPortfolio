<script setup lang="ts">

import {useForm} from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import DangerButton from "@/Components/DangerButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps<{
    isOpen: boolean,
    name: string,
    url: string,
}>();

const form = useForm({
    name: props.name,
    url: props.url,
    icon: () => prepareIcon(),
});

const prepareIcon = () => {
    return props.name.toLowerCase().replace(' ', '-');
}

const save = () => {
    console.log('save')

    form.post('/social-media', {
        preserveScroll: true,
        onSuccess: () => {
            console.log('success')
        },
        onError: () => {
            console.log('error')
        }
    });
}

</script>

<template>
    <Modal :show="isOpen">
        <input type="hidden" name="_token" :value="csrfToken">

        <div class="">
            <InputLabel>Name</InputLabel>
            <TextInput placeholder="Name" :model-value="form.name" name="name" type="text" class="w-full"/>
            <InputError :message="form.errors.name" class="mt-1"/>
        </div>

        <div class="mt-3">
            <InputLabel>URL</InputLabel>
            <TextInput placeholder="URL" :model-value="form.url" name="url" type="text" class="w-full"/>
            <InputError :message="form.errors.url" class="mt-1"/>
        </div>

        <div class="flex justify-end">
            <DangerButton>Cancel</DangerButton>
            <PrimaryButton :onClick="save">Save</PrimaryButton>
        </div>
    </Modal>
</template>

<style scoped>

</style>
