<template>
  <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
    <div class="bg-white p-6 rounded shadow-lg w-96">
      <h2 class="text-2xl mb-4">Login</h2>
      <form @submit.prevent="handleLogin">
        <div class="mb-4">
          <label for="email" class="block text-gray-700">Email</label>
          <input
            v-model="email"
            type="email"
            id="email"
            class="w-full px-4 py-2 border rounded bg-white text-black"
            required
          />
        </div>
        <div class="mb-4">
          <label for="password" class="block text-gray-700">Password</label>
          <input
            v-model="password"
            type="password"
            id="password"
            class="w-full px-4 py-2 border rounded bg-white text-black"
            required
          />
        </div>
        <button
          type="submit"
          class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
        >
          Login
        </button>
      </form>
      <p v-if="error" class="text-red-500 mt-4">{{ error }}</p>
      <button @click="$emit('close')" class="w-full px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 mt-4">
        Close
      </button>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  name: 'LoginModal',
  props: {
    error: String,
  },
  emits: ['close', 'login'],
  setup(props, { emit }) {
    const email = ref('');
    const password = ref('');

    const handleLogin = () => {
      emit('login', { email: email.value, password: password.value });
    };

    return {
      email,
      password,
      handleLogin,
    };
  },
};
</script>

<style scoped>
</style>