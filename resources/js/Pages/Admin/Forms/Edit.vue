<script setup lang="ts">

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, useForm, Link} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";
import DangerButton from "@/Components/DangerButton.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    form: Object,
    availableTypes: Array,
});

const form = useForm({
    title: props.form.title,
    fields: props.form.fields,
});

const removeField = (field) => {
    form.fields = form.fields.filter((f) => f !== field);
};

const addField = () => {
    let field = {
        type: 'Text',
        label: '',
        required: false,
        visible: true,
    };

    form.fields.push(field);
};

const saveForm = () => {
    form.post("/admin/forms", {
        preserveState: true,
        onSuccess: () => {
        }
    });
}

</script>

<template>
    <Head title="Form Editor"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Editor</h2>

                <div class="flex gap-3">
                    <Link :href="route('forms.index')">
                        <DangerButton @click="saveForm">Back</DangerButton>
                    </Link>

                    <PrimaryButton @click="saveForm">Save</PrimaryButton>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div>
                        <input name="title" v-model="form.title" type="text" placeholder="Title">
                        <InputError :message="form.errors.title"/>
                    </div>

                    <div v-if="form.fields && form.fields.length !== 0">
                        <table class="w-full text-center">
                            <tr>
                                <td>Label</td>
                                <td>Type</td>
                                <td>Required</td>
                                <td>Visible</td>
                                <td></td>
                            </tr>

                            <tr v-for="field in form.fields">

                                <td>
                                    <input v-model="field.label" type="text" placeholder="Label">
                                </td>

                                <td>
                                    <select v-model="field.type">
                                        <option v-for="type in availableTypes" :value="type.label">{{
                                                type.label
                                            }}
                                        </option>
                                    </select>
                                </td>

                                <td class="">
                                    <input v-model="field.required" type="checkbox">
                                </td>

                                <td class="">
                                    <input v-model="field.visible" type="checkbox">
                                </td>

                                <td>
                                    <DangerButton @click="() => removeField(field)">Remove</DangerButton>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div v-else>
                        <div class="text-center">
                            <i>No form fields</i>
                        </div>
                    </div>

                    <InputError class="text-center" :message="form.errors.fields"/>
                    <div class="flex justify-center py-2">
                        <PrimaryButton @click="addField">Add field</PrimaryButton>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
</style>
