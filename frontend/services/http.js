import axios from "axios";

const axiosInstance = axios.create({
    baseURL: "http://127.0.0.1:8000/api/",
    headers: {
        "Content-Type": "application/json",
        "X-Frontend-Token": "vue-access-123",
    },
});

export default axiosInstance;
