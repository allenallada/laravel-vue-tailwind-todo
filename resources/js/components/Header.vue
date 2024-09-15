<template>
  <header class="bg-gray-800 text-white p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold">Todo App</h1>
    <div>
      <template v-if="!isLoggedIn">
        <button @click="showLogin = true" class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">
          Login
        </button>
        <button @click="showRegister = true" class="bg-green-500 px-4 py-2 rounded hover:bg-green-600 ml-2">
          Register
        </button>
      </template>
      <template v-else>
        <span class="mr-4">Hello {{ userStore.user?.name || ''}}!</span>
        <button @click="handleLogout" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600">
          Logout
        </button>
      </template>
    </div>
    <LoginModal v-if="showLogin" :error="error" @close="showLogin = false" @login="handleLogin" />
    <RegisterModal v-if="showRegister" :error="error" @close="showRegister = false"/>
  </header>
</template>

<script>
import { ref, computed, onMounted } from 'vue';
import { useUserStore } from '../stores/userStore';
import { useTodoStore } from '../stores/todoStore';
import LoginModal from './LoginModal.vue';
import RegisterModal from './RegisterModal.vue';
import { logout } from '../apis/userApis';

export default {
  name: 'Header',
  components: {
    LoginModal,
    RegisterModal,
  },
  setup() {
    const userStore = useUserStore();
    const todoStore = useTodoStore();
    const showLogin = ref(false);
    const showRegister = ref(false);
    const error = ref(null);

    const isLoggedIn = computed(() => !!userStore.token);

    const handleLogin = async ({ email, password }) => {
      console.log('Attempting login with', email);
      await userStore.login(email, password);
      if (!userStore.error) {
        console.log('Login successful');
        showLogin.value = false; 
        error.value = null;
        await todoStore.fetchTodos();
        console.log('showLogin value after successful login:', showLogin.value);
      } else {
        console.log('Login failed', userStore.error);
        error.value = userStore.error;
      }
    };

    const handleLogout = async () => {
      try {
        await logout(userStore.token);
        console.log('Logout successful');
      } catch (error) {
        console.error('Logout failed', error);
      } finally {
        userStore.logout();
        todoStore.clearTodos();
      }
    };

    onMounted(() => {
      if (isLoggedIn.value) {
        userStore.fetchUser();
      }
    });

    return {
      showLogin,
      showRegister,
      handleLogin,
      handleLogout,
      error,
      isLoggedIn,
      userStore,
    };
  },
};
</script>