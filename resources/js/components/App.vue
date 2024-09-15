<template>
  <div>
    <Header />
    <div v-if="isLoggedIn">
      <todo-list></todo-list>
    </div>
    <div v-else>
      <LoginMessage />
    </div>
  </div>
</template>

<script>
import { computed } from 'vue';
import TodoList from './TodoList.vue';
import Header from './Header.vue';
import LoginMessage from './LoginMessage.vue';
import { useUserStore } from '../stores/userStore';

export default {
  name: 'App',
  components: {
    TodoList,
    Header,
    LoginMessage,
  },
  setup() {
    const userStore = useUserStore();
    const isLoggedIn = computed(() => !!userStore.token);
    return {
      isLoggedIn,
    };
  },
  mounted() {
    console.log('App component mounted.');
  }
}
</script>

<style scoped>
  .app {
    text-align: center;
    margin-top: 50px;
  }
</style>