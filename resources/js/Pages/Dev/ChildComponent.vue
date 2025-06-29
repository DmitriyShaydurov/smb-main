<!-- ChildComponent.vue -->
<template>
    <div
        :style="{
            margin: '10px',
            padding: '20px',
            backgroundColor: 'lightgray',
        }"
    >
        <h3>First child Component with table</h3>
        <q-table
            :rows="rows"
            :columns="columns"
            :pagination="pagination"
            row-key="recipient"
            @request="onRequest"
        />
    </div>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({ statistics: Object });
const emit = defineEmits(["paginationRequest"]);

// Извлекаем строки и пагинацию
const rows = computed(() => props.statistics.data);

const pagination = computed(() => ({
    page: props.statistics.current_page,
    rowsPerPage: props.statistics.per_page,
    rowsNumber: props.statistics.total,
}));

const columns = [
    {
        name: "recipient",
        label: "Recipient",
        field: "recipient",
        align: "left",
    },
    { name: "status", label: "Status", field: "status", align: "left" },
    { name: "user_name", label: "User", field: "user_name", align: "left" },
    { name: "country", label: "Country", field: "country", align: "left" },
    { name: "created_at", label: "Date", field: "created_at", align: "left" },
    { name: "price", label: "Price", field: "price", align: "left" },
    { name: "currency", label: "Currency", field: "currency", align: "left" },
];

const onRequest = (params) => {
    emit("paginationRequest", params.pagination);
};
</script>
