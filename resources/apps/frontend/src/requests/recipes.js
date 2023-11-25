import axios from 'axios';

export function loadPackages(params = {}) {
  return axios.get('/api/recipes', {params}).then(response => response.data);
}

export function showPackage(packageId) {
  return axios
    .get('/api/recipes/' + packageId)
    .then(response => response.data);
}

export function destroyPackage(packageId) {
  return axios
    .delete('/api/recipes/' + packageId)
    .then(response => response.data);
}

export function createPackage(data) {
  return axios.post('/api/recipes', data).then(response => response.data);
}

export function updatePackage(packageId, data) {
  return axios
    .put('/api/recipes/' + packageId, data)
    .then(response => response.data);
}
