<script setup lang="ts">

import {Link, usePage} from '@inertiajs/vue3'
import {computed, ref, watch} from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import GlassCard from "@/Components/GlassCard.vue";
import Page from "@/types/Page";

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
        <GlassCard>

            <nav class="p-4">
                <div class="flex justify-between">
                    <ApplicationLogo class="w-24"/>

                    <div class="flex items-center">
                        <PrimaryButton>
                            <Link href="/">Portfolio</Link>
                        </PrimaryButton>

                        <Link class="mx-2" v-for="page in customPages" :key="page.id" :href="route('page.show', page.id)">
                            <PrimaryButton>
                                {{ page.title }}
                            </PrimaryButton>
                        </Link>
                    </div>
                </div>
            </nav>
        </GlassCard>

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
