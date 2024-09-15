import axios from 'axios';

export const fetch = async () => {
  try {
    const response = await axios.get('/api/todos');
    return response.data;
  } catch (error) {
    console.error('Error fetching todos:', error);
    throw error;
  }
};

export const create = async (todo) => {
  try {
    const response = await axios.post('/api/todos', todo);
    return response.data;
  } catch (error) {
    console.error('Error creating todo:', error);
    throw error;
  }
};

export const update = async (id, updatedTodo) => {
  try {
    const response = await axios.put(`/api/todos/${id}`, updatedTodo);
    return response.data;
  } catch (error) {
    console.error('Error updating todo:', error);
    throw error;
  }
};

export const remove = async (id) => {
  try {
    await axios.delete(`/api/todos/${id}`);
  } catch (error) {
    console.error('Error deleting todo:', error);
    throw error;
  }
};