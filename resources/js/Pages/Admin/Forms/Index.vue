<script setup lang="ts">

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps<{
    forms: any[]
}>();

</script>

<template>
    <Head title="Forms"/>


    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Forms</h2>

                <Link :href="route('forms.create')">
                    <PrimaryButton>Create form</PrimaryButton>
                </Link>
            </div>
        </template>

        <div class="">
            <div v-for="form in props.forms" class="p-3 mt-3 mx-3 md:mx-24 shadow-lg rounded-lg bg-white">
                <div class="flex items-center justify-between">
                    <p>{{ form.title }}</p>

                    <div class="flex gap-3">
                        <Link :href="route('forms.edit', form)">
                            <PrimaryButton>Edit</PrimaryButton>
                        </Link>

                        <Link :href="route('forms.results', form.id)">
                            <PrimaryButton>Results</PrimaryButton>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
