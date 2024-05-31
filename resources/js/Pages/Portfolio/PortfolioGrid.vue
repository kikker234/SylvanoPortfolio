<script setup lang="ts">

const props = defineProps<{
    nodes: {
        title: string;
        image: string;
    }[];
}>();

</script>

<template>
    <div class="bg-white w-4/5 rounded-lg">
        <div class="columns-1 gap-5 sm:columns-2 sm:gap-8 md:columns-3 lg:columns-4 [&>img:not(:first-child)]:mt-8">
            <div
                class="relative mb-3"
                v-for="node in nodes"
                :key="node.title">
                <img
                    :src="node.image"
                    alt="node.title"
                    class="w-full h-full object-cover rounded-lg">
                <div
                    class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 hover:opacity-100 rounded-lg transition-opacity duration-300">
                    <span class="text-white text-center">{{ node.title }}</span>
                </div>
            </div>
        </div>
    </div>

</template>
