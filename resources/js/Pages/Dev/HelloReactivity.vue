<!-- Parent.vue -->
<template>
    <div
        :style="{
            margin: '10px',
            padding: '20px',
            backgroundColor: 'lightblue',
        }"
    >
        <h2>Parent Component</h2>
        <ChildComponent
            :statistics="statistics"
            @paginationRequest="fetchPage"
        />
    </div>
</template>

<script setup>
import ChildComponent from "./ChildComponent.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    statistics: Object,
});

const fetchPage = ({ page, rowsPerPage }) => {
    console.log(`Fetching page ${page} with ${rowsPerPage} rows per page`);

    router.get(
        window.location.pathname,
        {
            page,
            per_page: rowsPerPage,
        },
        {
            preserveState: false,
            preserveScroll: true,
        },
    );
};
</script>
