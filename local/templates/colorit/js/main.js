$(document).ready(function () {
    console.log("Ready!")
    const search = document.querySelector('.search_btn')
    const searchBox = document.querySelector('.header__search_wrapper')

    search.addEventListener('click', (p)=>{
        p.preventDefault();
        searchBox.classList.toggle('active')
    })
    const body = document.getElementsByTagName('body');
    body.addEventli

});