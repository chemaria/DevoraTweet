import Chart from "chart.js/auto";

const response = await fetch("http://127.0.0.1:8000/api/api-call");
const tweetData = await response.json();
const { datos } = tweetData;

console.log(datos);

const totalTweetDays = {};
datos.forEach((element) => {
    if (String(element.tweet_created_at).slice(8, -8) in totalTweetDays) {
        totalTweetDays[String(element.tweet_created_at).slice(8, -8)] =
            ++totalTweetDays[String(element.tweet_created_at).slice(8, -8)];
    } else {
        totalTweetDays[String(element.tweet_created_at).slice(8, -8)] = 1;
    }
    // let dateString = String(element.tweet_created_at).slice(8, -8);
    // date.push(parseInt(dateString));
});
console.log(totalTweetDays);

const data = {
    datasets: [
        {
            label: "Numero de Tweets Octubre #farina",
            backgroundColor: "rgb(255, 99, 132)",
            borderColor: "rgb(255, 99, 132)",
            data: totalTweetDays,
        },
    ],
};

const config = {
    type: "bar",
    data: data,
    options: {},
};

new Chart(document.getElementById("myChart"), config);
