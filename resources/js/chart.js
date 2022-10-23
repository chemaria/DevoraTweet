const { default: axios } = require("axios");

axios
    .get("127.0.0.1:8000/api/api-call")
    .then((response) => {
        response.json();
    })
    .then((data) => {
        console.log(data);
    });
