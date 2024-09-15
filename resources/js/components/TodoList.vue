<template>
  <div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
      <div class="flex items-center mb-4">
        <input
          v-model="newTodo"
          type="text"
          placeholder="Add a new todo"
          class="flex-1 px-4 py-2 border rounded"
        />
        <button
          @click="addTodo"
          class="ml-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600"
        >
          Add
        </button>
      </div>
      <ul class="list-none p-0">
        <li v-for="(todo, index) in todos" :key="index" class="mb-2">
          <TodoItem
            :todo="todo"
            :index="index"
            @update-todo="updateTodo"
            @remove-todo="removeTodo"
          />
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, computed } from 'vue';
import { useTodoStore } from '../stores/todoStore';
import TodoItem from './TodoItem.vue';

export default {
  components: {
    TodoItem,
  },
  setup() {
    const todoStore = useTodoStore();
    const newTodo = ref('');

    const todos = computed(() => todoStore.todos);

    const addTodo = async () => {
      if (newTodo.value.trim()) {
        try {
          await todoStore.createTodo({ todo: newTodo.value.trim(), is_completed: false });
          newTodo.value = '';
        } catch (error) {
          console.error('Error adding todo:', error);
        }
      }
    };

    const updateTodo = async (index, updatedTodo) => {
      const todo = todos.value[index];
      try {
        await todoStore.updateTodo(todo.id, updatedTodo);
      } catch (error) {
        console.error('Error updating todo:', error);
      }
    };

    const removeTodo = async (index) => {
      const todo = todos.value[index];
      try {
        await todoStore.deleteTodo(todo.id);
      } catch (error) {
        console.error('Error deleting todo:', error);
      }
    };

    onMounted(() => {
      todoStore.fetchTodos();
    });

    return {
      todos,
      newTodo,
      addTodo,
      updateTodo,
      removeTodo,
    };
  },
};
</script>