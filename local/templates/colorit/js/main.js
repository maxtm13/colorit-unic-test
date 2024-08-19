$(document).ready(function () {
    const search = document.querySelector('.search_btn')
    const searchBox = document.querySelector('.header__search_wrapper')
    const searchForm = document.querySelector('#title-search-input')
    search.addEventListener('click', (p)=>{
        p.preventDefault();
        p.stopPropagation();
            searchBox.classList.toggle('active');
    })
    const body = document.querySelector('body')
    document.addEventListener('keydown', (e)=>{
        if (e.code=='Escape') {
            searchBox.classList.remove('active')
        }
    })
    document.addEventListener('click', (e)=>{
        if (searchBox.classList.contains('active') && e.target!==searchForm) {
            searchBox.classList.remove('active')
        }
    })
});
