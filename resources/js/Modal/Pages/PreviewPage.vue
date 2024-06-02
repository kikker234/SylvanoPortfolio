<script setup lang="ts">

import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";
import Page from "@/Components/Page.vue";

const props = defineProps<{
    page: any
    show: boolean
    onClose: Function
}>();

</script>

<template>

    <Modal :show="show">
        <Page :page="props.page"/>

        <div class="flex justify-end m-4">
            <PrimaryButton @click="onClose">Close</PrimaryButton>
        </div>
    </Modal>

</template>

<style scoped>

</style>
