import { defineStore } from 'pinia';
import { login, register, fetch } from '../apis/userApis';

export const useUserStore = defineStore('user', {
  state: () => ({
    user: null,
    token: localStorage.getItem('token') || '',
    tokenType: localStorage.getItem('tokenType') || '',
    error: null,
  }),
  actions: {
    async login(email, password) {
      try {
        const response = await login({ email, password });
        this.token = response.access_token;
        this.tokenType = response.token_type;
        localStorage.setItem('token', this.token);
        localStorage.setItem('tokenType', this.tokenType);
        this.error = null;
        await this.fetchUser();
      } catch (error) {
        this.error = 'Invalid credentials';
      }
    },
    async register(name, email, password) {
      try {
        const response = await register({ name, email, password });
        this.token = response.access_token;
        this.tokenType = response.token_type;
        localStorage.setItem('token', this.token);
        localStorage.setItem('tokenType', this.tokenType);
        this.error = null;
        await this.fetchUser();
      } catch (error) {
        this.error = 'Registration failed';
      }
    },
    async fetchUser() {
      try {
        const user = await fetch(this.tokenType, this.token);
        this.user = user;
      } catch (error) {
        console.error('Failed to fetch user details', error);
        this.user = null;
      }
    },
    logout() {
      this.token = '';
      this.tokenType = '';
      this.user = null;
      localStorage.removeItem('token');
      localStorage.removeItem('tokenType');
    },
  },
});