// Calls the products_statitics.php endpoint with GET: "type"="notes".
async function get_notes() {
    const response = await fetch("http://127.0.0.1:8000/controller/products_statistics.php?type=notes");
    return await response.json();
}

// Calls the products_statitics.php endpoint with GET: "type"="categories".
async function get_categories() {
    const response = await fetch("http://127.0.0.1:8000/controller/products_statistics.php?type=categories");
    return await response.json();
}

const WIDTH = 500;
// Creates a doughnut graph with provided dataset, title and canvas.
function doughnut_graph(data, title, canvas) {
    const config = {
        type: "doughnut",
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },
                title: {
                    display: true,
                    text: title,
                }
            }
        }
    };

    let chart = new Chart(canvas, config);
    chart.resize(WIDTH, WIDTH);
}

// Creates the notes chart
async function notes_graph(canvas) {
    const json_response = await get_notes();

    let labels = [];
    let values = [];
    json_response.forEach((obj) => {
        labels.push(obj["product"]["name"]);
        values.push(obj["values"]["average"]);
    });


    const data = {
        labels: labels,
        datasets: [
            {
                label: "Note moyenne",
                data: values,
            }
        ]
    }

    doughnut_graph(data, "Note moyenne de chaque jeu", canvas);
}

// Creates the categories chart
async function categories_graph(canvas) {
    const json_response = await get_categories();

    let labels = [];
    let values = [];
    json_response.forEach((obj) => {
        labels.push(obj["name"]);
        values.push(obj["count"]);
    });


    const data = {
        labels: labels,
        datasets: [
            {
                label: "Nombre de jeux dans cette catégorie",
                data: values,
            }
        ]
    }

    doughnut_graph(data, "Répartition des jeux en fonction de leurs catégories", canvas);
}

// Main:
notes_graph(document.getElementById("notes-chart").getContext("2d"));
categories_graph(document.getElementById("categories-chart").getContext("2d"));