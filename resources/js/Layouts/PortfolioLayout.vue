<script setup lang="ts">

import {Link, usePage} from '@inertiajs/vue3'
import {computed, ref, watch} from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import GlassCard from "@/Components/GlassCard.vue";
import Page from "@/types/Page";
import Navbar from "@/Components/Navbar.vue";

const page = usePage();
const background = computed(() => page.props.background);
const cssBackground = ref(`url(${background.value})`);

watch(background, (newVal) => {
    cssBackground.value = `url(${newVal})`;
    document.documentElement.style.setProperty('--bg-url', cssBackground.value);
}, {immediate: true});

const customPages: Page[] = page.props.pages as Page[];

</script>

<template>

    <div class="custom-bg min-h-screen flex flex-col">
        <Navbar />

        <div class="flex-grow">
            <slot></slot>
        </div>

        <footer class="h-fit w-full">
            <GlassCard class="p-3">
                <div class="md:flex w-full justify-end">
                    <Link :href="route('dashboard')">
                        <PrimaryButton class="w-full flex justify-center">
                            Dashboard
                        </PrimaryButton>
                    </Link>
                </div>
            </GlassCard>
        </footer>
    </div>

</template>

<style scoped>

:root {
    --bg-url: url('https://via.placeholder.com/600x400');
}

.custom-bg {
    background-image: var(--bg-url);
    background-size: cover;
    background-position: center;
}

</style>
