<script setup lang="ts">

import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    form: Object,
});

const form = useForm({
    fields: props.form.fields,
    form_id: props.form.id,
    email: '',
    name: ''
});

const submit = () => {
    form.post('/admin/form-results', {
        onError: (e) => {
            console.log(e)
        },
    })
}

</script>

<template>

    <h1>{{ props.form.title }}</h1>

    <div class="py-2 w-full">
        <div class="w-full flex">
            <label for="Name" class="flex">
                Name
            </label>

            <p class="text-red-600">*</p>
        </div>

        <input class="w-full" v-model="form.name" name="Name" type="text" required/>
    </div>

    <div class="py-2 w-full">
        <div class="w-full flex">
            <label for="Email" class="flex">
                Email
            </label>

            <p class="text-red-600">*</p>
        </div>

        <input class="w-full" v-model="form.email" name="Email" type="Email" required/>
    </div>

    <form class="w-full">
        <div class="w-full" v-for="field in form.fields">
            <div class="py-2 w-full">
                <div class="w-full flex">
                    <label :for="field.label" class="flex">
                        {{ field.label }}
                    </label>

                    <p v-if="field.required" class="text-red-600">*</p>
                </div>

                <input class="w-full" :name="field.label" :type="field.type" :required="field.required"/>
            </div>
        </div>

        <div class="flex gap-1 justify-center">
            <p>Fields with a</p>
            <p class="text-red-600">*</p>
            <p>are required!</p>
        </div>
    </form>

    <div class="flex justify-center">
        <PrimaryButton @click="submit">Submit</PrimaryButton>
    </div>
</template>
