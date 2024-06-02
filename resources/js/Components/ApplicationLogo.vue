<script setup>
import { usePage } from '@inertiajs/vue3'
import {computed} from "vue";

const page = usePage()
const avatar = computed(() => page.props.avatar)

</script>

<template>
    <img :src="avatar" alt="Application logo" class="rounded-full aspect-square object-cover">
</template>
