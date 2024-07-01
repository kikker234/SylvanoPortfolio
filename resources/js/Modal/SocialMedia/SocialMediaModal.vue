<script setup lang="ts">

import {useForm} from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import DangerButton from "@/Components/DangerButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {watch} from "vue";

const props = defineProps<{
    isOpen: boolean,
    name: string,
    id: number,
    url: string,
    onClose: () => void
}>();

const form = useForm({
    name: props.name,
    url: props.url,
    icon: () => prepareIcon(),
});

const prepareIcon = () => {
    return props.name.toLowerCase().replace(' ', '-');
}

const submit = () => {
    if (props.name) {
        update();
    } else {
        create();
    }
}

const create = () => {
    form.post('/admin/social-media', {
        preserveScroll: true,
        onSuccess: () => {
            props.onClose();
        },
        onError: (e) => {
            console.log(e)
        }
    });
}

const update = () => {
    form.put(`/admin/social-media/${props.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            props.onClose();
        },
        onError: (e) => {
            console.log(e)
        }
    });
}

watch(() => props.isOpen, (value) => {
    if (value) {
        form.name = props.name;
        form.url = props.url;
    }
});

</script>

<template>
    <Modal :show="isOpen">
        <div class="p-3">
            <div class="">
                <InputLabel>Name</InputLabel>
                <TextInput placeholder="Name" v-model="form.name" name="name" type="text" class="w-full"/>
                <InputError :message="form.errors.name" class="mt-1"/>
            </div>

            <div class="mt-3">
                <InputLabel>URL</InputLabel>
                <TextInput placeholder="URL" v-model="form.url" name="url" type="text" class="w-full"/>
                <InputError :message="form.errors.url" class="mt-1"/>
            </div>

            <div class="flex justify-end mt-2 gap-3">
                <DangerButton :onClick="props.onClose">Cancel</DangerButton>
                <PrimaryButton :onClick="submit">Save</PrimaryButton>
            </div>
        </div>
    </Modal>
</template>

<style scoped>

</style>
