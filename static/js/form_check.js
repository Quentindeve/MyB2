const form = document.getElementById("add-form");

form.addEventListener("submit", (e) => {
    e.preventDefault();
    let can_continue = true;
    form.childNodes.forEach((child) => {
        if (child.nodeName === "INPUT") {
            console.log(child);

            const type = child.type;
            if (child.classList.contains("number")) {
                const parsed = parseFloat(child.textContent);
                if (isNaN(parsed)) {
                    alert("Fils de pute");
                    can_continue = false;
                }
            }

        }
    });
    console.log(can_continue);
    return can_continue;
});