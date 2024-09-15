import { defineStore } from 'pinia';
import { fetch, create, update, remove } from '../apis/todoApis';

export const useTodoStore = defineStore('todo', {
  state: () => ({
    todos: [],
  }),
  actions: {
    async fetchTodos() {
      try {
        this.todos = await fetch();
        console.log(this.todos);
      } catch (error) {
        console.error('Error fetching todos:', error);
      }
    },
    async createTodo(newTodo) {
      try {
        const createdTodo = await create(newTodo);
        this.todos.push(createdTodo);
      } catch (error) {
        console.error('Error creating todo:', error);
      }
    },
    async updateTodo(id, updatedTodo) {
      try {
        const todo = await update(id, updatedTodo);
        const index = this.todos.findIndex((t) => t.id === id);
        if (index !== -1) {
          this.todos[index] = todo;
        }
      } catch (error) {
        console.error('Error updating todo:', error);
      }
    },
    async deleteTodo(id) {
      try {
        await remove(id);
        this.todos = this.todos.filter((todo) => todo.id !== id);
      } catch (error) {
        console.error('Error deleting todo:', error);
      }
    },
  },
});