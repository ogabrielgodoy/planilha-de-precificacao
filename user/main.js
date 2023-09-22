// Exibe o loading
function Notificacao() {
    alert('Clique em "OK" para CONFIRMAR a criação da sua planilha.')

    var div = document.getElementById("DivInvisivel");
    if (div.style.display === "none") {
        div.style.display = "block";
    } else {
        div.style.display = "none";
    }

}