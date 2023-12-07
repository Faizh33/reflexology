/* Script responsivité barre de navigation*/

const burgerMenu = document.querySelector('.burger-menu');
const navLinks = document.querySelector('.nav-links');

burgerMenu.addEventListener('click', () => {
    navLinks.classList.toggle('show');
});


/* Script changement d'image sur page réflexologie */
function toggleImages(imgId1, imgId2) {
    const img1 = document.getElementById(imgId1);
    const img2 = document.getElementById(imgId2);

    if (img1.style.display === 'inline-block') {
        img1.style.display = 'none';
        img2.style.display = 'inline-block';
    } else {
        img1.style.display = 'inline-block';
        img2.style.display = 'none';
    }
}