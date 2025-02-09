function modificarSrc(nombreCancion){
    let cancion=document.getElementById('songName');
    const reproductor=document.getElementById('audioPlayer');
    reproductor.style.display="block";
    if(cancion.value.length==0){
        reproductor.src='/cancion/'+nombreCancion+'.mp3/play';
        reproductor.play();
    }else{
        reproductor.src='/cancion/'+cancion.value+'.mp3/play';
        reproductor.play();
        cancion.value="";
    }
    
}
document.getElementById("audioPlayer").addEventListener("click", function(event) {
    event.preventDefault(); 
});
document.getElementById("audioPlayer").addEventListener("error", function() {
    alert('La canción solicitada no esta disponible, pruebe con otra.')
});
document.getElementById("contLupa").addEventListener("click", function(event) {
    event.preventDefault();
});
