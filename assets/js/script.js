/*formulário de busca*/
let searchform = document.querySelector('.search-form');
document.querySelector('#search-btn').onclick = () => {
    searchform.classList.toggle('active');
    navbar.classList.remove('active');
}

/*menu de navegação*/
let navbar = document.querySelector('.navbar');
document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
    searchform.classList.remove('active');
}

/*ao rolar a página*/
window.onscroll = () => {
    searchform.classList.remove('active');
    navbar.classList.remove('active');

    /*menu de navegação durante a scrollagem da página*/
    if(window.scrollY > 30) {
        document.querySelector('.header').classList.add('header-active');
    } else {
        document.querySelector('.header').classList.remove('header-active');
    }
}