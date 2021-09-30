// OUVERTURE ET FERMETURE DU MENU EN VERSION MOBILE


const navMenu = document.getElementById('nav-menu'),
    navToggle = document.getElementById('nav-toggle'),
    navClose = document.getElementById('nav-close')


if(navToggle){
    navToggle.addEventListener('click', () =>{
        navMenu.classList.add('show-menu')
    })
}


if(navClose){
    navClose.addEventListener('click', () =>{
        navMenu.classList.remove('show-menu')
    })
}

const navLink = document.querySelectorAll('.nav__link')

function linkAction(){
    const navMenu = document.getElementById('nav-menu')
    navMenu.classList.remove('show-menu')
}
navLink.forEach(n => n.addEventListener('click', linkAction))


// CHANGEMENT DE FOND DE LA BARRE DE NAVIGATION LORS DU SCROLL


function scrollHeader(){
    const header = document.getElementById('header')

    if(this.scrollY >= 30) header.classList.add('scroll-header'); else header.classList.remove('scroll-header')
}
window.addEventListener('scroll', scrollHeader)


// AFFICHER MENU FILTRE


const filterContent = document.getElementsByClassName('filter__content'),
    filterHeader = document.querySelectorAll('.filter__header')
// AFFICHER / MASQUER COMPETENCES
function toggleFilter(){
    let itemClass = this.parentNode.className

    for(let i = 0; i < filterContent.length; i++){
        filterContent[i].className = 'filter__content filter__close'
    }
    if(itemClass === 'filter__content filter__close'){
        this.parentNode.className = 'filter__content skills_open'
    }
}

filterHeader.forEach((el) =>{
    el.addEventListener('click', toggleFilter)
})