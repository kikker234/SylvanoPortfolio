<script setup lang="ts">

import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";
import Page from "@/Components/Page.vue";

const props = defineProps<{
    page: any
    onClose: Function
}>();

const closePreviewModal = () => {
    props.onClose();
}

</script>

<template>

    <Modal :show="props.page !== undefined">
        <Page v-if="props.page !== undefined" :page="props.page"/>

        <div class="flex justify-end m-4">
            <PrimaryButton @click="closePreviewModal">Close</PrimaryButton>
        </div>
    </Modal>

</template>

<style scoped>

</style>
