<template>
  <div class="flex items-center mb-2">
    <input
      type="checkbox"
      v-model="localTodo.is_completed"
      @change="updateTodo"
      class="mr-2"
    />
    <div v-if="isEditing" class="flex-1">
      <input
        v-model="localTodo.todo"
        @blur="saveTodo"
        @keyup.enter="saveTodo"
        class="flex-1 px-4 py-2 border rounded"
      />
    </div>
    <div v-else class="flex-1 text-left">
      <span>{{ localTodo.todo }}</span>
    </div>
    <button
      @click="toggleEdit"
      class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
    >
      {{ isEditing ? 'Save' : 'Edit' }}
    </button>
    <button
      @click="removeTodo"
      class="ml-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
    >
      Remove
    </button>
  </div>
</template>

<script>
  import { ref, watch } from 'vue';
  import { useTodoStore } from '../stores/todoStore';

  export default {
    props: {
      todo: {
        type: Object,
        required: true,
      },
      index: {
        type: Number,
        required: true,
      },
    },
    emits: ['update-todo', 'remove-todo'],
    setup(props, { emit }) {
      const todoStore = useTodoStore();
      const localTodo = ref({ ...props.todo });
      const isEditing = ref(false);

      const toggleEdit = () => {
        isEditing.value = !isEditing.value;
        if (!isEditing.value) {
          saveTodo();
        }
      };

      const saveTodo = async () => {
        try {
          await todoStore.updateTodo(localTodo.value.id, localTodo.value);
          emit('update-todo', props.index, localTodo.value);
        } catch (error) {
          console.error('Error saving todo:', error);
        }
      };

      const updateTodo = async () => {
        try {
          await todoStore.updateTodo(localTodo.value.id, localTodo.value);
          emit('update-todo', props.index, localTodo.value);
        } catch (error) {
          console.error('Error updating todo:', error);
        }
      };

      const removeTodo = () => {
        emit('remove-todo', props.index);
      };

      watch(
        () => props.todo,
        (newTodo) => {
          localTodo.value = { ...newTodo };
        }
      );

      return {
        localTodo,
        isEditing,
        toggleEdit,
        saveTodo,
        updateTodo,
        removeTodo,
      };
    },
  };
</script>