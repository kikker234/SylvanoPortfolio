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
    <div
        class="grid"
        :style="{
            'grid-template-columns': 'repeat(' + size + ', 1fr)',
            'grid-template-rows': 'repeat(' + size + ', 1fr)'
        }">
        <div
            v-for="node in nodes"
            :key="node.title"
            :class="{ 'is-primary': node.primary }">
            {{ node.title }}
        </div>
    </div>
</template>

<style scoped>
.grid {
    display: grid;
    gap: 10px; /* Adjust as necessary */
}

.grid > * {
    width: 100%;
    aspect-ratio: 1/1;
}

.position {
    display: none; /* Hide the position div, adjust or remove if not needed */
}

.is-primary {
    grid-column: span 2;
    grid-row: span 2;
}
</style>
