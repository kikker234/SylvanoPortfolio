<script setup lang="ts">

import SocialMedia from "@/types/SocialMedia";
import {onMounted, ref} from "vue";
import GlassCard from "@/Components/GlassCard.vue";

const props = defineProps<{
    socialMedia: SocialMedia
}>();

const getIconName = () => {
    return "bi-" + props.socialMedia.icon;
}

const iconName = ref(getIconName());

onMounted(() => {
    iconName.value = getIconName();
});

</script>

<template>
    <a :href="getIconName()">
        <GlassCard class="p-3 rounded-full flex flex-col bg-white shadow-2xl aspect-square w-fit h-fit items-center justify-center">
            <div class="flex items-center flex-col">
                <v-icon :name="iconName" scale="1.5"/>
                <span>{{ socialMedia.name }}</span>
            </div>
        </GlassCard>
    </a>
</template>

<style scoped>

</style>
