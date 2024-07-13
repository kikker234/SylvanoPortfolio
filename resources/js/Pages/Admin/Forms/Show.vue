<script setup lang="ts">

const props = defineProps({
    results: Array,
});

</script>

<template>
    <div v-for="result in props.results">
        From: {{ result }}
    </div>
</template>

<style scoped>

</style>
