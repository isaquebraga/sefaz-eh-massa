import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import CadastrosImpostos from '../views/PainelAdminView.vue'
import ImpostosView from '../views/ImpostosView.vue'
import ErroAdmin from '../views/ErroAdmin.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: HomeView,
    },
    {
      path: '/login',
      name: 'Login',
      component: LoginView,
    },
    {
      path: '/admin',
      name: 'CadastroImpostos',
      component: CadastrosImpostos,
      meta: { requiresAuth: true },
    },
    {
      path: '/impostos',
      name: 'Impostos',
      component: ImpostosView,
    },
    {
      path: '/erro-admin',
      name: 'ErroAdmin',
      component: ErroAdmin,
    },
  ],
})

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token')
  if (to.meta.requiresAuth && !token) {
    next('/erro-admin')
  } else {
    next()
  }
})

export default router
