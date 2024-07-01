<script setup lang="ts">

import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import GlassCard from "@/Components/GlassCard.vue";
import Dropdown from "@/Components/Dropdown.vue";
import {onMounted, ref} from "vue";
import NavbarContent from "@/Components/NavbarContent.vue";

const isScreenSmall = ref(false);

onMounted(() => {
    isScreenSmall.value = window.innerWidth < 768;

    window.addEventListener('resize', () => {
        isScreenSmall.value = window.innerWidth < 768;
    });
});

</script>

<template>

    <nav class="p-4">
        <div class="flex justify-between items-center">
            <ApplicationLogo class="md:w-24 w-16"/>

            <Dropdown v-if="isScreenSmall">
                <template #trigger>
                    <v-icon name="fa-bars" fill="white" scale="2.5"/>
                </template>

                <template #content>
                    <NavbarContent/>
                </template>
            </Dropdown>

            <div v-else>
                <NavbarContent/>
            </div>
        </div>
    </nav>
</template>

<style scoped>

</style>
