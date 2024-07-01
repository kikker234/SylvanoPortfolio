<script setup lang="ts">

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SocialMediaModal from "@/Modal/SocialMedia/SocialMediaModal.vue";
import {ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SocialMedia from "@/Components/SocialMedia.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {router} from "@inertiajs/vue3";

const isOpen = ref(false);

const props = defineProps<{
    socialMedia: any[]
}>();

const socialMedia = ref(props.socialMedia);
const editName = ref('');
const editUrl = ref('');
const editId = ref(0);

const editSocialMedia = (media) => {
    editName.value = media.name;
    editUrl.value = media.url;
    editId.value = media.id;

    isOpen.value = true;
}

const deleteSocialMedia = (id) => {
    router.delete(`/admin/social-media/${id}`, {
        preserveScroll: true,
        onSuccess: () => {
            socialMedia.value = socialMedia.value.filter((node) => node.id !== id);
        },
        onError: (error) => {
            console.error('Error deleting social media:', error);
        }
    });
};

const createSocialMedia = () => {
    isOpen.value = true;
}

const closeModal = () => {
    isOpen.value = false;

    editName.value = '';
    editUrl.value = '';
    editId.value = 0;

    router.visit('/admin/social-media', {
        preserveScroll: true,
        onSuccess: (page) => {
            socialMedia.value = props.socialMedia || [];
        },
    });
}

const openLink = (url) => {
    window.open(url, '_blank');
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

        <div class="">
            <div class="overflow-hidden p-6">
                <div class="p-3 mt-3 mx-3 md:mx-24 shadow-sm rounded-lg bg-white" v-if="socialMedia.length == 0">
                    <p class="text-sm text-gray-600 text-center">No social media found!</p>
                </div>

                <div v-for="media in socialMedia"
                     class="p-3 mt-3 mx-3 md:mx-24 shadow-sm rounded-lg bg-white flex justify-between">

                    <div class="flex gap-3 items-center">
                        <SocialMedia :socialMedia="media"/>
                        <p>{{ media.name }}</p>
                    </div>

                    <div class="flex gap-3">
                        <PrimaryButton @click="() => openLink(media.url)">Open link</PrimaryButton>
                        <PrimaryButton @click="() => editSocialMedia(media)">Edit</PrimaryButton>
                        <DangerButton @click="() => deleteSocialMedia(media.id)">Delete</DangerButton>
                    </div>
                </div>
            </div>
        </div>

        <SocialMediaModal :on-close="closeModal" :is-open="isOpen" :name="editName" :url="editUrl" :id="editId"/>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
