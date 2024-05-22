<script setup lang="ts">

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import {ref} from "vue";
import axios from "axios";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import CreateNodeModal from "../Modal/Nodes/EditNode.vue";
import EditNode from "@/Modal/Nodes/EditNode.vue";

const nodes = ref([]);

const fetchNodes = async () => {
    const response = await axios.get('/api/node');
    nodes.value = response.data;
};

fetchNodes();

const createModalVisible = ref(false);
const editModalVisible = ref(false);
const currentNode = ref(null);

const openCreateModal = () => {
    currentNode.value = null;
    createModalVisible.value = true;
};

const openEditModal = (node) => {
    currentNode.value = node;
    editModalVisible.value = true;
};

const closeCreateModal = () => {
    createModalVisible.value = false;
};

const closeEditModal = () => {
    editModalVisible.value = false;
};

const onNodeCreated = () => {
    fetchNodes();
};

const deleteNode = (id: number) => {
    axios.delete(`/api/node/${id}`).then(() => {
        fetchNodes();
    });
};

</script>

<template>
    <Head title="Node"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Node</h2>
                <PrimaryButton @click="openCreateModal">Create Node</PrimaryButton>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div v-if="nodes.length === 0">
                        <p class="text-sm text-gray-600 text-center">No nodes found!</p>
                    </div>
                    <div class="flex flex-col gap-5">
                        <div class="flex gap-5" v-for="node in nodes" :key="node.id">
                            <div class="w-1/4 h-1/4 object-cover overflow-hidden">
                                <img :src="node.image" :alt="node.title"/>
                            </div>
                            <div class="w-full flex items-center justify-start">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ node.title }}</h3>
                                    <p class="text-sm text-gray-600">{{ node.description }}</p>
                                </div>
                            </div>
                            <div class="flex gap-3 flex-col items-center justify-center">
                                <PrimaryButton @click="() => openEditModal(node)">Edit</PrimaryButton>
                                <DangerButton @click="() => deleteNode(node.id)">Delete</DangerButton>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <EditNode
            :show="createModalVisible"
            @close="closeCreateModal"
            @created="onNodeCreated"
            :node="{}"
        />

        <EditNode
            :show="editModalVisible"
            @close="closeEditModal"
            @created="onNodeCreated"
            :node="currentNode"
            v-if="currentNode != null"
        />
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
