<script setup>
import { RouterView } from 'vue-router'
import Header from './components/Header.vue'
import Footer from './components/Footer.vue'
import ToastWrapper from './views/ToastWrapper.vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'
import { isAuthenticated } from './auth.js'
import { watchEffect, computed } from 'vue'

const route = useRoute()
const router = useRouter()

const logout = async () => {
  try {
    await axios.post('http://127.0.0.1:8000/api/logout', {}, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`
      }
    })
  } catch (err) {
    console.warn('Erro ao fazer logout (token pode estar expirado):', err)
  } finally {
    localStorage.removeItem('token')
    delete axios.defaults.headers.common['Authorization']
    isAuthenticated.value = false
    router.push('/')
  }
}

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
