import axios from 'axios'


const api = axios.create({
    baseURL: 'http://my-api.local/api/v1',

    headers: {
        'Content-Type': 'application/json'
    }
})


export function sendContact(data) {
    return api.post('/contact', data)
}