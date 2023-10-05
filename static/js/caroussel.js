let slideIndex = 0;
const images = [image0, image1];
console.log(`Length: ${images.length}`);

function showSlide(n) {
    let slide = document.querySelector('.carousel img');
    const index = n % images.length;

    console.log(`Index: ${index}, Image: ${images[index]}`);
    slide.src = images[index];
}

document.querySelector("#carousel-left").addEventListener("mouseup", (e) => {
    console.log("enflure");
    slideIndex--;
    showSlide(slideIndex);
});

document.querySelector("#carousel-right").addEventListener("mouseup", (e) => {
    console.log("enflure");
    slideIndex++;
    showSlide(slideIndex);
});

// Afficher la première image au chargement de la page
showSlide(slideIndex);