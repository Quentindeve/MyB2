let cards = document.querySelectorAll(".card");
let cards_infos = extract_infos(cards);

// List of criterias items have to match. By default all products are shown.
let criterias = {
    name: "",
    description: "",
    price: NaN
}

let name_filter = document.getElementById("name-filter");
name_filter.addEventListener("keyup", (e) => {
    criterias.name = remove_accents(name_filter.value.toLowerCase());
    filter_by(criterias, cards_infos);
});

let desc_filter = document.getElementById("desc-filter");
desc_filter.addEventListener("keyup", (e) => {
    criterias.description = remove_accents(desc_filter.value.toLowerCase());
    filter_by(criterias, cards_infos);
});

let price_filter = document.getElementById("price-filter");
price_filter.addEventListener("keyup", (e) => {
    criterias.price = parseFloat(price_filter.value);
    filter_by(criterias, cards_infos);
});

// Price sorting
let price_sort = document.getElementById("price-sort");
price_sort.addEventListener("change", (e) => {
    let sorted = null;

    if (price_sort.value == "asc") {
        sorted = bubble_sort(cards_infos, true);
    }
    else {
        sorted = bubble_sort(cards_infos, false);
    }

    let container = document.getElementById("cards-container");
    let nodes = container.childNodes;
    console.log(sorted);
    // Removes all product cards from the DOM...
    for (let i = 0; i < nodes.length; i++) {
        container.removeChild(nodes[i]);
    }
    // And replaces them in the order provided by the bubble sort
    for (let i = 0; i < sorted.length; i++) {
        console.log(i);
        container.appendChild(sorted[i].node);
    }
});

// Removes all special characters from the input text.
// Useful for "filter by product name" feature. 
function remove_accents(text) {
    return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}

// Extracts all products infos and puts them in a more convenient data format.
function extract_infos(cards) {
    let returned = [];
    for (let i = 0; i < cards.length; i++) {
        const card = cards[i];
        returned.push({
            "name": remove_accents(card.getElementsByClassName("p-name")[0].textContent.toLowerCase()),
            "description": remove_accents(card.getElementsByClassName("p-desc")[0].textContent.toLowerCase()),
            "price": parseFloat(card.getElementsByClassName("p-price")[0].textContent.split(' ')[0]),
            "node": card
        });
    }

    return returned;
}

// Filters all products by passed criterias
function filter_by(criterias, cards) {
    for (let i = 0; i < cards.length; i++) {
        let card = cards[i];
        const name_match = card.name.includes(criterias.name);
        const description_match = card.description.includes(criterias.description);
        const price_match = (isNaN(criterias.price)) || criterias.price == card.price;

        // If the product matches all criterias
        if (name_match && description_match && price_match) {
            card.node.classList.add("shown");
            card.node.classList.remove("hidden");
        }

        else {
            card.node.classList.add("hidden");
            card.node.classList.remove("shown");
        }
    }
}

// Dumb O(n^2) sorting algorithm
// Sorts by ASCENDING if order == true, DESCENDING if order == false
function bubble_sort(cards, order) {
    for (let i = 0; i < cards.length; i++) {
        for (let j = i + 1; j < cards.length; j++) {
            const current_card = cards[i];
            const card_to_compare = cards[j];

            if (order) {
                if (current_card.price > card_to_compare.price) {
                    // Échange des cartes
                    cards[i] = card_to_compare;
                    cards[j] = current_card;
                }
            } else {
                if (current_card.price < card_to_compare.price) {
                    // Échange des cartes
                    cards[i] = card_to_compare;
                    cards[j] = current_card;
                }
            }
        }
    }
    return cards;
}