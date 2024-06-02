<script setup lang="ts">

import { Link, usePage } from '@inertiajs/vue3'
import { computed, ref, watch } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const page = usePage();
const background = computed(() => page.props.background);
const cssBackground = ref(`url(${background.value})`);

watch(background, (newVal) => {
    cssBackground.value = `url(${newVal})`;
    document.documentElement.style.setProperty('--bg-url', cssBackground.value);
}, { immediate: true });

</script>

<template>

    <div class="custom-bg">
        <nav class="p-4 bg-slate-200 bg-opacity-50 backdrop-blur-sm shadow-lg">
            <div class="flex justify-between">
                <ApplicationLogo class="w-24"/>

                <div class="">
                    <Link href="/">Portfolio</Link>
                </div>
            </div>
        </nav>

        <slot></slot>

        <footer class="h-fit w-full p-3 shadow-lg bg-slate-200 bg-opacity-50 backdrop-blur-sm">

            <div class="md:flex w-full justify-end">
                <Link :href="route('dashboard')">
                    <PrimaryButton class="w-full flex justify-center">
                        Dashboard
                    </PrimaryButton>
                </Link>
            </div>
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
