<template>
    <Modal :show="show" @close="close">
        <div class="p-6">
            <h2 class="text-xl font-medium text-gray-900">
                Create node
            </h2>

            <div class="">
                <InputLabel>Title</InputLabel>
                <TextInput class="mt-1 block w-3/4" v-model="form.title"/>
                <InputError :message="form.errors.title" class="mt-2"/>
            </div>

            <div class="">
                <InputLabel>Description</InputLabel>
                <TextInput class="mt-1 block w-3/4" v-model="form.description"/>
                <InputError :message="form.errors.description" class="mt-2"/>
            </div>

            <div class="">
                <InputLabel>Image</InputLabel>
                <input type="file" class="mt-1 block w-3/4" v-on:change="handleFileChange"/>
                <InputError :message="form.errors.image" class="mt-2"/>
            </div>

            <div class="">
                <!--<div class="flex items-center mt-2 gap-3">
                    <InputCheckbox v-model="form.primary"/>
                    <InputLabel>Primary</InputLabel>
                </div>
                <InputError :message="form.errors.primary" class="mt-2"/>-->
            </div>

            <div class="mt-6 flex justify-end">
                <DangerButton @click="close">Cancel</DangerButton>
                <PrimaryButton @click="createNode" class="ms-3">Save</PrimaryButton>
            </div>
        </div>
    </Modal>
</template>

<script setup lang="ts">
import {ref, nextTick, defineProps, watch} from 'vue';
import {useForm} from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import DangerButton from "@/Components/DangerButton.vue";
import InputError from "@/Components/InputError.vue";
import InputCheckbox from "@/Components/InputCheckbox.vue";

const props = defineProps({
    show: Boolean,
    onClose: Function,
    onCreated: Function,
    node: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    title: '',
    description: '',
    image: '',
    primary: false,
});

const handleFileChange = (event) => {
    if (event.target.files && event.target.files.length > 0) {
        form.image = event.target.files[0];
    } else {
        console.error("Geen bestand geselecteerd.");
    }
}

watch(() => props.node, (newNode) => {
    form.title = newNode.title || '';
    form.description = newNode.description || '';
    form.image = newNode.image || '';
    form.primary = newNode.primary || false;
}, {immediate: true});

const close = () => {
    form.reset();
    props.onClose();
};

const createNode = () => {
    if (props.node.title === undefined) {

        form.post('/admin/nodes', {
            preserveScroll: true,
            onSuccess: () => {
                close();
                props.onCreated();
            },
            onError: () => {
                nextTick(() => {
                    if (form.errors.title) {
                        form.reset('title');
                    }
                    if (form.errors.description) {
                        form.reset('description');
                    }
                    if (form.errors.image) {
                        form.reset('image');
                    }
                });
            },
        });
        return;
    }

    form.put(`/admin/nodes/${props.node.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            close();
            props.onCreated();
        },
        onError: () => {
            nextTick(() => {
                if (form.errors.title) {
                    form.reset('title');
                }
                if (form.errors.description) {
                    form.reset('description');
                }
                if (form.errors.image) {
                    form.reset('image');
                }
            });
        },
    });
};
</script>
