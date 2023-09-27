// Zooms
const zoomables = document.getElementsByClassName("zoomable");

for (let i = 0; i < zoomables.length; i++) {
    const item = zoomables[i];
    item.addEventListener("mouseover", (e) => {
        item.classList.remove("unzoomed");
        if (!item.classList.contains("zoomed"))
            item.classList.add("zoomed");
    });

    item.addEventListener("mouseout", (e) => {
        item.classList.remove("zoomed");

        if (!item.classList.contains("unzoomed"))
            item.classList.add("unzoomed");
    })
}

// Themes
let is_dark = false;
const body = document.body;

document.getElementById("theme-switch").addEventListener("click", (e) => {
    is_dark = !is_dark;

    if (is_dark) {
        add_class_to_body("dark");
        body.classList.add("dark-body");
    }

    else {
        remove_class_to_body("dark");
        body.classList.remove("dark-body");
    }
});

function add_class_to_body(class_name) {
    var body = document.body;

    if (body) {
        var elements = body.querySelectorAll('*:not(.ignore)');
        for (var i = 0; i < elements.length; i++) {
            elements[i].classList.add(class_name);
        }
    }
}

function remove_class_to_body(class_name) {
    var body = document.body;

    if (body) {
        var elements = body.querySelectorAll('*:not(.ignore)');
        for (var i = 0; i < elements.length; i++) {
            elements[i].classList.remove(class_name);
        }
    }
}