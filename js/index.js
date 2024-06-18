function email_rec_senha(){

    var form= document.getElementById("formRecuperar");
    var dados = new FormData(form);
    var email = dados.get("email");
    
    if (!email) {
        document.getElementById('loginemail').style.borderColor = 'red';
        return;
    }

    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    // Verifica se tem caracteres antes e depois do @ e se eh seguid por um .

    if (!regexEmail.test(email)){
        var email_invalido = document.getElementById('email_invalido');
        email_invalido.textContent = "E-Mail Inválido!";
        return;
    }

    if (regexEmail.test(email) && email) {
        window.location.href="verifique_email.html";
    }

    fetch("php/enviar_reset_senha.php", {
        method: "POST",
        body: dados
    });

}

function novaSenha(){
    
    var form = document.getElementById("formNovaSenha");
    var dados = new FormData(form);

    var senha = dados.get("nova_senha");

    if (senha) {
        var senhaHash = CryptoJS.MD5(senha).toString();
        dados.set("nova_senha", senhaHash);
    }

    fetch("php/reset-senha.php", {
        method: "POST",
        body: dados
    });
}
