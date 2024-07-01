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

const openLink = () => {
    window.open(props.socialMedia.url, '_blank');
}

</script>

<template>
    <a @click="openLink" class="cursor-pointer">
        <v-icon :name="iconName" scale="1.5"/>
    </a>
</template>

<style scoped>

</style>
