'use strict'


function navegarPagina() {
    console.log("llegue")


    $.ajax({
        url: "/probandoUnRouting",
        success: function(result) {
            document.getElementById("prin").removeChild()
            document.getElementById("prin").appendChild(result)
        }
    });
}

console.log("se cargo todo")