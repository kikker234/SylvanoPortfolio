<script setup lang="ts">

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Head, useForm, usePage} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {computed} from "vue";

const page = usePage();
const background = computed(() => page.props.background)

const avatarForm = useForm({
    image: null,
});

const backgroundForm = useForm({
    image: null,
});

const submitAvatar = () => {
    avatarForm.post(route('look-and-feel.avatar'), {
        onFinish: () => {
            avatarForm.reset('image');
        },
    });
};

const submitBackground = () => {
    backgroundForm.post(route('look-and-feel.background'), {
        onFinish: () => {
            backgroundForm.reset('image');
        },
    });
};

const handleFileChange = (form, event) => {
    if (event.target.files && event.target.files.length > 0) {
        form.image = event.target.files[0];
    } else {
        console.error("Geen bestand geselecteerd.");
    }
}

</script>

<template>
    <Head title="Look and feel"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Look and feel</h2>
            </div>
        </template>


        <div class="mx-32 my-5 p-4 bg-white shadow-xl rounded-lg">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Avatar</h2>

            <form @submit.prevent="submitAvatar">

                <div class="flex justify-around items-center">
                    <div class="">
                        <input type="file" name="image" v-on:change="(event) => handleFileChange(avatarForm, event)">
                        <InputError :message="avatarForm.errors.image"/>
                    </div>

                    <ApplicationLogo class="w-1/6"/>
                </div>

                <div class="flex justify-around items-center">
                    <PrimaryButton :disable="avatarForm.processing">Update</PrimaryButton>
                </div>
            </form>
        </div>

        <div class="mx-32 my-5 p-4 bg-white shadow-xl rounded-lg">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Background</h2>

            <form @submit.prevent="submitBackground">

                <div class="flex justify-around items-center">
                    <div class="">
                        <input type="file" name="image" v-on:change="(event) => handleFileChange(backgroundForm, event)">
                        <InputError :message="backgroundForm.errors.image"/>
                    </div>

                    <img :src="background" class="w-1/6" alt="Background image"/>
                </div>

                <div class="flex justify-around items-center">
                    <PrimaryButton :disable="backgroundForm.processing">Update</PrimaryButton>
                </div>
            </form>
        </div>

    </AuthenticatedLayout>
</template>

<style scoped>

</style>
