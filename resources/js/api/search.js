export default {
    fetchResult(url, params) {
        return axios
            .get(url, { params: params })
            .then(response => response)
            .catch(error => error);
    },
};
