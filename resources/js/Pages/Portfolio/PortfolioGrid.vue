<script setup lang="ts">
import {ref} from 'vue';
import axios from 'axios';

import {Node} from "@/types/types";

const nodes = ref<Node[]>([]);

const fetchNodes = async () => {
    const response = await axios.get('/api/node');
    nodes.value = response.data as Node[];
};

function compileGrid() {
    const grid: string[][] = [];

    for (let i = 0; i < 3; i++) {
        grid[i] = [];
        for (let j = 0; j < 3; j++) {
            grid[i][j] = '';
        }
    }

    printGrid(grid);
}

function printGrid(grid: string[][]) {
    console.log(grid);
}

fetchNodes();
</script>

<template>
    <div class="p-4">
        <div class="grid gap-4 grid-template-areas">
            <div
                v-for="(node, index) in nodes"
                :key="node.title"
                :class="[
                    'bg-white overflow-hidden shadow-sm sm:rounded-lg relative group',
                    node.primary ? 'col-span-2 row-span-2' : 'col-span-1 row-span-1',
                    `item-${index + 1}`
                ]"
                :style="node.primary ? { gridArea: 'primary' + (index + 1) } : { gridArea: 'item' + (index + 1) }"
            >
                <img :src="node.image" :alt="node.title" class="w-full h-auto"/>
                <div
                    class="absolute inset-0 flex flex-col justify-center items-center bg-opacity-50 bg-black text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <h2 class="font-semibold text-xl text-gray-100 leading-tight">{{ node.title }}</h2>
                    <p class="text-gray-300">{{ node.description }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
