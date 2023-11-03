const images = [
    'imagen1.jpg',
    'imagen2.jpg',
];

const imageContainer = document.querySelector('.article-images');

images.forEach((imagePath) => {
    const image = document.createElement('img');
    image.src = imagePath;
    imageContainer.appendChild(image);
});
