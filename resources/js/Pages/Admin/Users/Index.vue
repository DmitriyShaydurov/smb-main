<!--/resources/js/Pages/Admin/Users/Index.vue-->
<template>
  <MainLayout>
    <q-page class="q-pa-md">
      <q-card flat bordered class="q-pa-md">
        <q-btn label="Create User" color="primary" />
        <q-table :rows="users" :columns="columns" row-key="id">
        <template #body-cell-actions="{ row }">
          <q-btn flat dense icon="edit" color="primary" @click="editUser(row)" />
          <q-btn flat dense icon="delete" color="negative" @click="deleteUser(row)" />
        </template>
        </q-table>
      </q-card>
    </q-page>
  </MainLayout>
</template>

<script setup lang="ts">
import { QPage, QCard, QBtn, QTable } from 'quasar'
import MainLayout from '../../../Layouts/MainLayout.vue'
import { computed, ref } from 'vue'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps<{
  users: Array<{ [key: string]: any }>
}>()

const users = computed(() => props.users)

const columns = [
  { name: 'name', label: 'Name', field: 'name' },
  { name: 'email', label: 'Email', field: 'email' },
  { name: 'email_verified_at', label: 'Verified', field: 'email_verified_at' },
  { name: 'created_at', label: 'Created', field: 'created_at' },
  { name: 'updated_at', label: 'Updated', field: 'updated_at' },
  { name: 'role', label: 'Role', field: 'role' },
  { name: 'actions', label: 'Actions', field: 'actions', sortable: false }
];

function editUser(user: any): void {
  // Example redirect if you have an edit route
  Inertia.get(`/admin/users/${user.id}/edit`)
}

function deleteUser(user: any): void {
  if (confirm(`Are you sure you want to delete ${user.name}?`)) {
    Inertia.delete(`/admin/users/${user.id}`)
  }
}
</script>
