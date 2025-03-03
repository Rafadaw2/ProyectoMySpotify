function modificarSrc(nombreCancion) {
    let cancion = document.getElementById('songName');
    const reproductor = document.getElementById('audioPlayer');
    reproductor.style.display = "block";
    if (cancion.value.length == 0) {
        reproductor.src = '/cancion/' + nombreCancion + '/play';
        reproductor.play();
    } else {
        reproductor.src = '/cancion/' + cancion.value + '/play';
        reproductor.play();
        cancion.value = "";
    }

}
function buscarSinLog() {
    const subcadena = document.getElementById('songName').value;
    fetch(`http://localhost:8000/playlistSistemCancionsPu/${subcadena}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la petición');
            }
            return response.text(); 
        })
        .then(html => {
        
            document.body.innerHTML = html;
        })
        .catch(error => {
            console.error('Hubo un problema con la petición:', error);
        });
}
function buscarConLog() {
    console.log('Llega')
    const subcadena = document.getElementById('songName').value;
    fetch(`/user/playlistSistemCancionsPri/${subcadena}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la petición');
            }
            return response.text(); 
        })
        .then(html => {
            console.log('responde')
            document.body.innerHTML = html;
        })
        .catch(error => {
            console.error('Hubo un problema con la petición:', error);
        });
}

function crearPlaylist(){
    let nombre=document.getElementById('nombre').value
    let visibilidad=document.getElementById('visibilidad').checked 
    let canciones=document.getElementsByClassName('songs')
    let idCanciones=[]
    for(let cancion of canciones){
        if(cancion.checked==true){
            idCanciones.push(cancion.id);
        }
        
    }
    console.log(idCanciones)

    fetch('http://localhost:8000/user/playlist/new', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          nombre: nombre,
          visibilidad: visibilidad,
          canciones: idCanciones
        })
      })
        .then(response => response.json())
        .then(data => {
            console.log("Respuesta del servidor:", data);
            
            if (data.redirect) {
                console.log("Redirigiendo a:", data.redirect);
                window.location.href = data.redirect; 
            } else {
                console.log("Playlist creada, pero sin redirección:", data);
            }
        })
        .catch(error => console.error('Error:', error));
}
document.getElementById("audioPlayer").addEventListener("click", function (event) {
    event.preventDefault();
});
document.getElementById("audioPlayer").addEventListener("error", function () {
    alert('La canción solicitada no esta disponible, pruebe con otra.')
});
document.getElementById("contLupa").addEventListener("click", function (event) {
    event.preventDefault();
});
