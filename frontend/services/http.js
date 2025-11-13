import axios from "axios";

const axiosInstance = axios.create({
    baseURL: "https://sefaz-eh-massa.onrender.com/api/",
    headers: {
        "Content-Type": "application/json",
        "X-Frontend-Token": "vue-access-123",
    },
});

export default axiosInstance;
