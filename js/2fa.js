function enviar() {
    var form= document.getElementById("form2FA");
    var dados = new FormData(form);
    var codigo = dados.get("codigo");
    
    async function verificaCodigo(codigo) {
        return fetch("php/2fa.php", {
            method: "POST",
            body: JSON.stringify({ codigo: codigo })
        }).then(response => response.json());
    }

    verificaCodigo(codigo).then(response => {
        if (!response.codigoExiste) {
            var codigo_invalido = document.getElementById('codigo_invalido');
            codigo_invalido.textContent = "Código Incorreto, voltando para a tela de login.";
            setTimeout(function() {
                window.location = ("\\theindependentden-master2\\login.html");
            }, 2000);
        } else {
            window.location = ("\\theindependentden-master2\\teste_sistema.html");
        }
    });
}