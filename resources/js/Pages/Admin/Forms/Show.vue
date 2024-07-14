<template>
    <Head title="Results"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Results</h2>

                <Link :href="route('forms.index')">
                    <PrimaryButton>Back</PrimaryButton>
                </Link>
            </div>
        </template>

        <div v-for="result in results" :key="result.id" class="result-item">
            <div @click="toggleResult(result.id)" class="result-header">
                From: {{ result.name }} ({{ result.email }})
            </div>

            <div v-if="isResultVisible(result.id)" class="content">
                {{ result }}
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Head, Link} from "@inertiajs/vue3";
import DangerButton from "@/Components/DangerButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

export default {
    components: {Link, AuthenticatedLayout, DangerButton, Head, PrimaryButton},
    props: {
        results: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            visibleResults: [],
        };
    },
    methods: {
        toggleResult(id) {
            if (this.visibleResults.includes(id)) {
                this.visibleResults = this.visibleResults.filter(resultId => resultId !== id);
            } else {
                this.visibleResults.push(id);
            }
        },
        isResultVisible(id) {
            return this.visibleResults.includes(id);
        },
    },
};
</script>

<style>
.result-item {
    margin-bottom: 10px;
}

.result-header {
    cursor: pointer;
    font-weight: bold;
    padding: 10px;
    background-color: #f5f5f5;
}

.content {
    padding: 10px;
    border: 1px solid #ddd;
    border-top: none;
}
</style>
