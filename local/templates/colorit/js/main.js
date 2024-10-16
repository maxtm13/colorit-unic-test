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
    document.querySelectorAll('a[href^="#"]').forEach(anchor=>    {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    $(".menu-btn").click(function (){
        $(".header__wrapper-mobile .header__menu").show()
        $('body').css({"overflow": "hidden"});
    })
    let mobileMenu = $(".header__wrapper-mobile .header__menu")

    $(mobileMenu).find('li.parent>a').click(function (e) {
         e.preventDefault();
        console.log('clc')
         const menuItem = e.target.closest('.parent')
        if ($(menuItem).hasClass('active')) {
            console.log($(menuItem).find('li.parent'));
            $(menuItem).find('li.parent').removeClass('active');
            $(menuItem).find('li.parent').off('click');
            $(menuItem).removeClass('active');
            // console.log('remove eventList', $(menuItem.find('li.parent')));
        } else {
            $(menuItem).addClass('active')
            $('li.parent.active li.parent').click(function (e){
                if ($(this).hasClass('active')) $(this).removeClass('active')
                else $(this).addClass('active')
                console.log($(($(this).hasClass('active'))));
                console.log($(this));
            })
        }
    });
    // console.log('dsffgdfssdgsdf')
    // $('li.parent.active li.parent').click(function (e){
    //     console.log('ddddddddsssssssss');
    // })
});
