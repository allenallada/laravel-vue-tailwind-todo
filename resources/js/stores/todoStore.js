import { defineStore } from 'pinia';

export const useTodoStore = defineStore('todo', {
  state: () => ({
    todos: [],
    newTodo: ''
  }),
  actions: {
    addTodo() {
        console.log('called');
      if (this.newTodo.trim() !== '') {
        this.todos.push(this.newTodo.trim());
        this.newTodo = '';
      }
    },
    removeTodo(index) {
      this.todos.splice(index, 1);
    }
  }
});