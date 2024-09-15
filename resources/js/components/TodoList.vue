<template>
  <div class="todo-list container mx-auto mt-10 p-4">
    <h1 class="text-2xl font-bold mb-4">Todo List</h1>
    <div class="input-group flex justify-center items-center mb-4">
      <input
        v-model="newTodo"
        @keyup.enter="addTodo"
        placeholder="Add a new todo"
        class="border border-gray-300 rounded px-4 py-2 w-64"
      />
      <button
        @click="addTodo"
        class="ml-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600"
      >
        Add
      </button>
    </div>
    <ul class="list-none p-0">
      <li v-for="(todo, index) in todos" :key="index">
        <TodoItem
          :todo="todo"
          :index="index"
          @update-todo="updateTodo"
          @remove-todo="removeTodo(index)"
        />
      </li>
    </ul>
  </div>
</template>

<script>
import { ref } from 'vue';
import TodoItem from './TodoItem.vue';

export default {
  components: {
    TodoItem
  },
  setup() {
    const todos = ref([]);
    const newTodo = ref('');

    const addTodo = () => {
      if (newTodo.value.trim()) {
        todos.value.push({ todo: newTodo.value.trim(), isCompleted: false });
        newTodo.value = '';
      }
    };

    const removeTodo = (index) => {
      todos.value.splice(index, 1);
    };

    const updateTodo = ({ index, todo, isCompleted }) => {
      if (todo !== undefined) {
        todos.value[index].todo = todo;
      }
      if (isCompleted !== undefined) {
        todos.value[index].isCompleted = isCompleted;
      }
    };

    return {
      todos,
      newTodo,
      addTodo,
      removeTodo,
      updateTodo
    };
  }
};
</script>

<style scoped>
/* No custom styles needed as we are using Tailwind CSS */
</style>