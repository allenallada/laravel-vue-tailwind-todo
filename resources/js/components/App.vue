<template>
    <div class="app">
      <todo-list></todo-list>
    </div>
  </template>
  
  <script>
  import TodoList from './TodoList.vue';
  
  export default {
    name: 'App',
    components: {
      TodoList,
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