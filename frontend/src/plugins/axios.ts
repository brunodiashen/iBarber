import axios from "axios";
import { links } from '@/core/config';
import { gettoken } from '@/core/auth';

axios.defaults.baseURL = links.api
axios.defaults.headers.common['Authorization'] = gettoken()
axios.defaults.headers.common['Content-type'] = 'application/json'
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*'
// axios.defaults.headers.common['Access-Control-Allow-Methods'] = 'GET, POST, PUT, DELETE, OPTIONS'
// axios.defaults.headers.common['Access-Control-Allow-Headers'] = 'Content-Type, Authorization'

export default axios.create({});