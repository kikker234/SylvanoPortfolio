<script setup lang="ts">

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SocialMediaModal from "@/Modal/SocialMedia/SocialMediaModal.vue";
import {ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const isOpen = ref(false);

const editSocialMedia = () => {
    console.log('edit social media')
}

const createSocialMedia = () => {
    console.log('create social media')
    isOpen.value = true;
}

const closeModal = () => {
    isOpen.value = false;
}

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Social Media</h2>

                <PrimaryButton @click="createSocialMedia">Create</PrimaryButton>
            </div>
        </template>

        <SocialMediaModal :on-close="closeModal" :is-open="isOpen" name="" url=""/>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
