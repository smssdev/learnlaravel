import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8000/api'; // Change this to your backend URL
axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('auth_token')}`;

export default axios;
