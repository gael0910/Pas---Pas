document.addEventListener('DOMContentLoaded',function(){

// séléction de la class loader de la div chargement
let loader = document.querySelector('.loader'); 
loader.classList.add('endlight');

// affichage de la navigation avec le menu burger
function toggleMenu(){
    
    let boat = document.querySelector('.boat');
    let burger = document.querySelector('.burger');
    
    
    burger.addEventListener('click', ()=>{
        
    boat.classList.toggle('open_boat');
     
        
            
});
}
toggleMenu();

// affichage de protection des données

function toggleFooter(){
    
    let footer = document.getElementById('prive');
    let foot = document.getElementById('foot'); 
    foot.addEventListener('click', ()=>{
        
        footer.classList.toggle('open_footer');
    });
}
toggleFooter();

});