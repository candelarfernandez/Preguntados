$(document).ready(function(){

    $.ajax({
        url: '/ranking/list',
        success: function (resp) {
            mostrarEnHTML(resp);
        }
    });

    function mostrarEnHTML(resp) {
        let tabla = $("#tablaRanking");
        resp.usuarios.forEach(function (usuario) {
            let fila = $("<tr>");
            let filaNombreDeUsuario = $("<td>").html('<a href="/user/mostrarPerfil?user=' + usuario.username + '">' + usuario.username + '</a>');
            let filaPuntajeUsuario = $("<td>").text(usuario.puntaje);
            fila.append(filaNombreDeUsuario);
            fila.append(filaPuntajeUsuario);
            tabla.append(fila);
        });
    }

});