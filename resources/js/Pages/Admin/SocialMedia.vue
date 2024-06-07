<script setup lang="ts">

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SocialMediaModal from "@/Modal/SocialMedia/SocialMediaModal.vue";
</script>

<template>
    <AuthenticatedLayout>

        <SocialMediaModal :is-open="true" name="" url="" />
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
