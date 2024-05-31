<script setup lang="ts">

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
</script>

<template>
    <Head title="Node"/>

    <AuthenticatedLayout>
        <template #header>
            Hoofd
        </template>

        <div class="py-12">
            Content
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
