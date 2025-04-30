<template>
  <q-layout view="hHh lpR fFf">
    <q-header bordered class="bg-primary text-white" height-hint="98">
      <q-toolbar>
        <q-btn dense flat round icon="menu" @click="toggleLeftDrawer" />
        <q-toolbar-title>
          <q-avatar>
            <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
          </q-avatar>
          Title
        </q-toolbar-title>
      </q-toolbar>

      <!-- <q-tabs align="left">
        <q-btn flat label="Page One" @click="go('/page1')" />
        <q-btn flat label="Page Two" @click="go('/page2')" />
        <q-btn flat label="Page Three" @click="go('/page3')" />
      </q-tabs> -->
    </q-header>

    <q-drawer show-if-above v-model="leftDrawerOpen" side="left" bordered>
      <q-list>
        <q-item clickable v-ripple @click="go('/dashboard')">
          <q-item-section avatar>
            <q-icon name="dashboard" />
          </q-item-section>
          <q-item-section>Dashboard</q-item-section>
        </q-item>

        <q-item clickable v-ripple @click="go('/users')">
          <q-item-section avatar>
            <q-icon name="people" />
          </q-item-section>
          <q-item-section>Users</q-item-section>
        </q-item>
      </q-list>
    </q-drawer>

    <q-page-container>
      <slot />
    </q-page-container>

    <q-footer bordered class="bg-grey-8 text-white">
      <q-toolbar>
        <q-toolbar-title>
          <q-avatar>
            <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
          </q-avatar>
          <div>Title</div>
        </q-toolbar-title>
      </q-toolbar>
    </q-footer>
  </q-layout>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

// Quasar components
import {
  QLayout,
  QHeader,
  QToolbar,
  QToolbarTitle,
  QBtn,
  QAvatar,
  QTabs,
  QDrawer,
  QList,
  QItem,
  QItemSection,
  QIcon,
  QPageContainer,
  QFooter
} from 'quasar'

const leftDrawerOpen = ref(false)

function toggleLeftDrawer (): void {
  leftDrawerOpen.value = !leftDrawerOpen.value
}

function go (url: string): void {
  router.visit(url)
}
</script>
