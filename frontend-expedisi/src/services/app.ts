// File: src/services/api.ts (opsional jika ingin pisah axios)
import axios from 'axios';

export default axios.create({
  baseURL: 'http://localhost/backend-ci3/api/',
});
