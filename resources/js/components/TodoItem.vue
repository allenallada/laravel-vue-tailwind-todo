<template>
  <div
    :class="[{ 'opacity-50': todo.isCompleted }, 'flex justify-between items-center mb-2 p-2 border border-gray-300 rounded bg-gray-100']"
  >
    <div v-if="isEditing" class="flex items-center">
      <input
        v-model="editTodo"
        @keyup.enter="updateTodo"
        class="border border-gray-300 rounded px-4 py-2 w-64"
      />
      <button
        @click="updateTodo"
        class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
      >
        Update
      </button>
      <button
        @click="cancelEdit"
        class="ml-2 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"
      >
        Cancel
      </button>
    </div>
    <div v-else class="flex justify-between items-center w-full">
      <div class="flex items-center">
        <input
          type="checkbox"
          :checked="todo.isCompleted"
          @change="toggleComplete"
          class="form-checkbox h-5 w-5 text-blue-600"
        />
        <span class="ml-2">{{ todo.todo }}</span>
      </div>
      <div>
        <button
          @click="startEdit"
          class="ml-2 px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600"
        >
          Edit
        </button>
        <button
          @click="$emit('remove-todo')"
          class="ml-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
        >
          Remove
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  props: {
    todo: Object,
    index: Number
  },
  emits: ['update-todo', 'remove-todo'],
  setup(props, { emit }) {
    const isEditing = ref(false);
    const editTodo = ref(props.todo.todo);

    const startEdit = () => {
      isEditing.value = true;
    };

    const updateTodo = () => {
      if (editTodo.value.trim()) {
        emit('update-todo', { index: props.index, todo: editTodo.value.trim() });
        cancelEdit();
      }
    };

    const cancelEdit = () => {
      isEditing.value = false;
      editTodo.value = props.todo.todo;
    };

    const toggleComplete = () => {
      emit('update-todo', { index: props.index, todo: props.todo.todo, isCompleted: !props.todo.isCompleted });
    };

    return {
      isEditing,
      editTodo,
      startEdit,
      updateTodo,
      cancelEdit,
      toggleComplete
    };
  }
};
</script>

<style scoped>
.opacity-50 {
  opacity: 0.5;
}
</style>