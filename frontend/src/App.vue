<script setup>
import { RouterView } from 'vue-router'
import Header from './components/Header.vue'
import Footer from './components/Footer.vue'
import ToastWrapper from './components/ToastWrapper.vue'
import { useRoute, useRouter } from 'vue-router'
import { isAuthenticated } from './auth.js'
import { watchEffect, computed } from 'vue'
import BackToTop from './components/BackToTop.vue'

const route = useRoute()

watchEffect(() => {
  isAuthenticated.value = !!localStorage.getItem('token')
})

const mainStyle = computed(() => {
  if (route.path === '/impostos') {
    return {
      display: 'flex',
      'flex-direction': 'column',
      'align-items': 'center',
      'justify-content': 'flex-start',
      width: '100%',
      height: '100%',
      flex: '1',
      paddingTop: '20px'
    }
  }
  return {
    display: 'flex',
    'flex-direction': 'column',
    'align-items': 'center',
    'justify-content': 'center',
    width: '100%',
    height: '100%',
    flex: '1'
  }
})
</script>

<template>
  <div class="app-container">
    <Header></Header>

    <main :style="mainStyle">
      <RouterView />
    </main>

    <Footer></Footer>

    <ToastWrapper></ToastWrapper>
    <BackToTop></BackToTop>
  </div>
</template>

<style>
.app-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

main {
  flex: 1;
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 100px;
  background-color: #F9FAFB;
}
</style>
