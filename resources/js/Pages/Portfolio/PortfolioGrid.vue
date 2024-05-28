<script setup lang="ts">
import {ref, watch} from 'vue';
import axios from 'axios';

import {Node} from "@/types/types";

const size = ref(0);
const nodes = ref<Node[]>([]);
let grid: string[][] = [];

// Function to fetch nodes from the API
async function fetchNodes() {
    try {
        const response = await axios.get('/api/node');
        nodes.value = response.data as Node[];
    } catch (error) {
        console.error("Error fetching nodes:", error);
    }
}

// Function to calculate the grid size based on the number of nodes
function calculateGridSize() {
    if (nodes.value.length <= 1) {
        return 1;
    }
    //return Math.ceil(Math.sqrt(nodes.value.length));

    return Math.ceil(Math.sqrt(nodes.value.length) * 2);
}

// Function to initialize the grid
function initGrid() {

    grid = Array.from({length: size.value}, () => Array.from({length: size.value}, () => ''));
}

// Function to get the position of a node in the grid
function getPosition(isPrimary: boolean) {
    const size = isPrimary ? 2 : 1;

    for (let y = 0; y < grid.length; y++) {
        for (let x = 0; x < grid[y].length; x++) {
            if (grid[y][x] === '') {
                let canPlace = true;
                for (let i = 0; i < size; i++) {
                    if (grid[y + i]?.[x] !== '') {
                        canPlace = false;
                        break;
                    }
                }

                if (canPlace) {
                    for (let i = 0; i < size; i++) {
                        grid[y + i][x] = 'x';
                    }

                    return {x, y};
                }
            }
        }
    }
}

// Watch the nodes array and initialize the grid when nodes are fetched
watch(nodes, () => {
    initGrid();

    size.value = calculateGridSize();
    console.log(size.value);
});

// Fetch nodes initially
fetchNodes();

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
