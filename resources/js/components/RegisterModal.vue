<template>
  <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
    <div class="bg-white p-6 rounded shadow-lg w-96">
      <h2 class="text-2xl mb-4">Register</h2>
      <form @submit.prevent="handleRegister">
        <div class="mb-4">
          <label for="name" class="block text-gray-700">Name</label>
          <input
            v-model="name"
            type="text"
            id="name"
            class="w-full px-4 py-2 border rounded bg-white text-black"
            required
          />
        </div>
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
        <div class="mb-4">
          <label for="confirmPassword" class="block text-gray-700">Confirm Password</label>
          <input
            v-model="confirmPassword"
            type="password"
            id="confirmPassword"
            class="w-full px-4 py-2 border rounded bg-white text-black"
            required
          />
        </div>
        <button
          type="submit"
          class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
        >
          Register
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
import { useUserStore } from '../stores/userStore';
import { register } from '../apis/userApis';

export default {
  setup(props, { emit }) {
    const name = ref('');
    const email = ref('');
    const password = ref('');
    const confirmPassword = ref('');
    const error = ref(null);
    const userStore = useUserStore();

    const handleRegister = async () => {
      if (password.value !== confirmPassword.value) {
        error.value = 'Passwords do not match';
        return;
      }
      try {
        const response = await register({
          name: name.value,
          email: email.value,
          password: password.value,
          password_confirmation: confirmPassword.value,
        });
        console.log('Registration successful', response);
        userStore.token = response.access_token;
        userStore.tokenType = response.token_type;
        localStorage.setItem('token', userStore.token);
        localStorage.setItem('tokenType', userStore.tokenType);
        error.value = null;
        await userStore.fetchUser();
        emit('close');
      } catch (err) {
        console.error('Registration failed', err);
        error.value = 'Registration failed';
      }
    };

    return {
      name,
      email,
      password,
      confirmPassword,
      error,
      handleRegister,
    };
  },
};
</script>

<style scoped>
</style>