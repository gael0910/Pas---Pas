'use strict';

window.requestAnimFrame = (function() {
return window.requestAnimationFrame || // La forme standardisée
window.webkitRequestAnimationFrame || // Pour Chrome et Safari
window.mozRequestAnimationFrame || //Pour Firefox
window.oRequestAnimationFrame || // Pour Opera
window.msRequestAnimationFrame  || // Pour Internet Explorer
function(callback){ //pour un autre
window.setTimeout(callback, 1000/60 );
};
});


document.addEventListener('DOMContentLoaded',function(){

let canvasDom = document.getElementById('canvas');
let ctx = canvasDom.getContext('2d');
let image = document.getElementById('photo1');
let circle;
let radial;
let Sequence;


circle = {

     diametreBall:25,
     posX : 400,
     posY : 200,
     vitesseX : 3,
     vitesseY : 2
};

image.addEventListener('load',displayImg);

function displayImg(){ 
    
    // affichage de l'image et dessin du soleil 
    
    ctx.drawImage(image,0, 0, canvasDom.width, canvasDom.height);
            
    ctx.beginPath();
    ctx.lineWidth = 3;
    ctx.strokeStyle = 'rgba(234,247,111,0.5)';
    ctx.arc(circle.posX, circle.posY, circle.diametreBall, 0, 2*Math.PI);
    ctx.shadowOffsetX= 20;
    ctx.shadowOffsetY= 5;
    ctx.shadowBlur = 100;
    ctx.shadowColor = 'rgba(255,255,153,0.2)';
    ctx.fillStyle = 'rgba(234,247,111,0.5)';
            
    ctx.fill();
    ctx.stroke();
    ctx.closePath();
    
}

// mise en place de la fonction window.requestAnimFrame () selon le modèle ci-dessus)
window.requestAnimFrame(function(){animate});

function displayRadial(){
    // dessin du dsoleil en dégradé et de la phrase
    
    radial = ctx.createRadialGradient(610,65,10,610,65,50);
    radial.addColorStop(1,'#DD4'); //Rouge
    radial.addColorStop(0,'#FF9966'); //Jaune
    ctx.beginPath();
    ctx.fillStyle = radial;
    ctx.arc(610,65,50,0,2*Math.PI);
    ctx.fill();
            
    ctx.font = 'bold 40px Verdana, Arial, sans-serif';
    ctx.strokeStyle = 'rgba(51,102,204,0.6)';
    ctx.fillStyle = 'rgba(51,255,204,0.6)';
    ctx.strokeText('Chaque matin le soleil se lève pour nous....', canvasDom.width/12, canvasDom.height/2);
    
}

function animate(){
     
//Vérification pour savoir si la balle à touché un bord
    if(circle.posX +circle.diametreBall>=canvasDom.width || circle.posX +circle.diametreBal
            <= 0+circle.diametreBall*2){
            circle.vitesseX *= -1;
    
        }

    if(circle.posY+circle.diametreBall>= canvasDom.height || circle.posY +circle.diametreBall>=225+circle.diametreBall*2){ 
            circle.vitesseY *= -1;
     
        } 
        
        circle.posX += circle.vitesseX; //Modification de la position X puis Y
        circle.posY -= circle.vitesseY;
        
            // on vide le canvas et on affiche l'image
        ctx.clearRect(0, 0, canvasDom.width, canvasDom.height);  
        displayImg();


    if(circle.posX +circle.diametreBall>=canvasDom.width/2 && circle.posY+circle.diametreBall <= 95  ){ 
            
    //   arrivé à la position souhaitée on arrête l'animation
        stopAnimate();
        
        ctx.clearRect(0, 0, canvasDom.width, canvasDom.height);
        
        displayImg();
                        
                            
    setTimeout(function(){
        // function pour lancer l'opacité et faire apparaître le soleil et la phrase
     
        let fadeTarget = document.getElementById('canvas');
        let fadeEffect = setInterval(function(){
                
        if (!fadeTarget.style.opacity) {
             fadeTarget.style.opacity = 0.1;
        }
            
        if (fadeTarget.style.opacity > 0.9) {
            clearInterval(fadeEffect);
            
        } else {
            
            fadeTarget.style.opacity = parseFloat(fadeTarget.style.opacity) + 0.08;
        }
        
            displayRadial();
            
            
}, 500);

},0.5);}


}

setTimeout(animation,2000);


 
function animation(){
    
         Sequence= window.setInterval(animate,1000/30);
          
}
          
function stopAnimate() {
  
         window.clearInterval(Sequence);
}


});
        

   



