<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, router} from "@inertiajs/vue3";
import {ref} from "vue";
import axios from "axios";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import EditNode from "@/Modal/Nodes/EditNode.vue";

const nodes = ref([]);

const props = defineProps({
    nodes: Array,
});

nodes.value = props.nodes;

const isModalVisible = ref(false);
const currentNode = ref(null);

const openModal = (node: Node) => {
    currentNode.value = node;
    isModalVisible.value = true;
};

const closeModal = () => {
    currentNode.value = null;
    isModalVisible.value = false;
};


const deleteNode = (id: number) => {
    router.visit(`/admin/nodes/${id}`, {
        method: 'delete',
        data: {
            id: id,
        },
        preserveScroll: true,
        onSuccess: () => {
            nodes.value = nodes.value.filter((node) => node.id !== id);
        },
    });
};

const reloadNodes = () => {
    // do not use axios.get('/admin/nodes') because it will not trigger the inertia reload
    router.visit('/admin/nodes', {
        preserveScroll: true,
        onSuccess: (page) => {
            nodes.value = page.props.nodes;
        },
    });
}

</script>

<template>
    <Head title="Node"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Node</h2>
                <PrimaryButton @click="() => openModal(null)">Create Node</PrimaryButton>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

<!--                No nodes -->
                    <div v-if="nodes.length === 0">
                        <p class="text-sm text-gray-600 text-center">No nodes found!</p>
                    </div>

<!--                Nodes -->
                    <div class="flex flex-col gap-5">
                        <div class="flex flex-col md:flex-row gap-5" v-for="node in nodes" :key="node.id">

<!--                        Node row-->
                            <div class="w-full md:w-1/4 h-1/4 aspect-square overflow-hidden">
                                <img class="w-full h-full object-contain" :src="node.image" :alt="node.title"/>
                            </div>

                            <div class="w-full flex items-center justify-start">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ node.title }}</h3>
                                    <p class="text-sm text-gray-600">{{ node.description }}</p>
                                </div>
                            </div>

<!--                        Actions-->
                            <div class="flex flex-row md:flex-col gap-3 items-center md:justify-center justify-end">
                                <PrimaryButton @click="() => openModal(node)">Edit</PrimaryButton>
                                <DangerButton @click="() => deleteNode(node.id)">Delete</DangerButton>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <EditNode
            :show="isModalVisible"
            @close="closeModal"
            :onCreated="() => reloadNodes()"
            :node="currentNode"
        />
    </AuthenticatedLayout>
</template>
