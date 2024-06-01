<template>
    <Modal :show="show" @close="close">
        <div class="p-6">
            <h2 class="text-xl font-medium text-gray-900">
                {{ node === null ? 'Create' : 'Edit' }} Node
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

            <div class="" v-if="node === null">
                <InputLabel>Image</InputLabel>
                <input type="file" class="mt-1 block w-3/4" v-on:change="handleFileChange"/>
                <InputError :message="form.errors.image" class="mt-2"/>
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
import {router, useForm} from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import DangerButton from "@/Components/DangerButton.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    show: Boolean,
    onClose: Function,
    onCreated: Function,
    node: {
        type: Object,
        required: false,
    },
});

const form = useForm({
    title: props.node === null ? '' : props.node.title || '',
    description: props.node === null ? '' : props.node.description || '',
    image: props.node === null ? '' : props.node.image || '',
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
    form.title = newNode === null ? '' : newNode.title || '';
    form.description = newNode === null ? '' : newNode.description || '';
    form.image = newNode === null ? '' : newNode.image || '';
    form.primary = newNode === null ? false : newNode.primary || false;
}, {immediate: true});

const close = () => {
    form.reset();

    // Reset validation errors
    form.errors.title = null;
    form.errors.description = null;
    form.errors.image = null;

    props.onClose();
};


const createNode = () => {
    if (props.node === null) {
        form.post('/admin/nodes', {
            preserveScroll: true,
            onSuccess: () => {
                close();
                if (typeof props.onCreated === 'function') {
                    props.onCreated();
                }
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
    } else {
        form.put(route('nodes.update', props.node.id), {
            ...form.data(), // Include form data
            preserveScroll: true,
            onSuccess: () => {
                close();
                if (typeof props.onCreated === 'function') {
                    props.onCreated();
                }
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
    }
};


</script>
