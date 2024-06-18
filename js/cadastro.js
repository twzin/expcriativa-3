function cadastrar() {
    var form = document.getElementById("formCadastro");
    var dados = new FormData(form);
    var senha = dados.get("senha");
    var email = dados.get("email");
    var user = dados.get("usuario");
    var telefone = dados.get("telefone");

    if (!user) {
        document.getElementById('usuario').style.borderColor = 'red';
        return;
    }

    if (!email) {
        document.getElementById('email').style.borderColor = 'red';
        return;
    }

    if (!telefone) {
        document.getElementById('telefone').style.borderColor = 'red';
        return;
    }

    if (!senha) {
        document.getElementById('senha').style.borderColor = 'red';
        return;
    }

    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const regexTelefone = /^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/;
    const regexSenhaForte = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (!regexEmail.test(email)) {
        var email_invalido = document.getElementById('email_invalido');
        email_invalido.textContent = "E-Mail inválido!";
        return;
    } else {
        var email_invalido = document.getElementById('email_invalido');
        email_invalido.textContent = "";
    }

    if (!regexTelefone.test(telefone)) {
        var telefone_invalido = document.getElementById('telefone_invalido');
        telefone_invalido.textContent = "Telefone inválido";
        return;
    } else {
        var telefone_invalido = document.getElementById('telefone_invalido');
        telefone_invalido.textContent = "";
    }

    if (!regexSenhaForte.test(senha)) {
        return;
    }

    // Função para verificar se o email já está cadastrado
    async function verificarEmailETelefone(email, telefone) {
        return fetch("php/verifica_email.php", {
            method: "POST",
            body: JSON.stringify({ email: email, telefone: telefone})
        }).then(response => response.json());
    }

    fetch('php/enviar_cert.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro ao obter o certificado');
        }
        return response.json();
    })
    .then(data => {
    var certificadoDecodificado = atob(data.conteudoBase64);

    // Extrair a chave pública do certificado
    var cert = forge.pki.certificateFromPem(certificadoDecodificado);
    var chavePublicaPem = forge.pki.publicKeyToPem(cert.publicKey);

    var criptografia = new JSEncrypt();
    criptografia.setPublicKey(chavePublicaPem);

    var chaveAES = CryptoJS.lib.WordArray.random(32); 

    var iv = CryptoJS.lib.WordArray.random(16); 

    var chaveAEScriptografada = criptografia.encrypt(chaveAES.toString());

    var emailCriptografado = CryptoJS.AES.encrypt(email, chaveAES, {
        iv: iv,
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7 
    }).toString();

    var usuarioCriptografado = CryptoJS.AES.encrypt(user, chaveAES, {
        iv: iv,
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7 
    }).toString();

    var senhaHash = CryptoJS.SHA256(senha).toString();

    var senhaCriptografada = CryptoJS.AES.encrypt(senhaHash, chaveAES, {
        iv: iv,
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7 
    }).toString();

    var telefoneCriptografado = CryptoJS.AES.encrypt(telefone, chaveAES, {
        iv: iv,
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7 
    }).toString();

    verificarEmailETelefone(email, telefone).then(response => {
        if (response.emailExists) {
            var email_invalido = document.getElementById('email_invalido');
            email_invalido.textContent = "E-Mail já cadastrado!";
            return;
        } else if (response.telefoneExists) {
            var telefone_invalido = document.getElementById('telefone_invalido');
            telefone_invalido.textContent = "Telefone já cadastrado!";
            return;
        } else {
            // Agora, incluímos a chave AES criptografada nos dados a serem enviados no segundo fetch
            dados.append("chaveAES", chaveAEScriptografada);
            dados.append("IV", CryptoJS.enc.Base64.stringify(iv));
            dados.set("email", emailCriptografado);
            dados.set("usuario", usuarioCriptografado);
            dados.set("senha", senhaCriptografada);
            dados.set("telefone", telefoneCriptografado);

            // Enviamos os dados, incluindo a chave AES criptografada, no segundo fetch
            fetch("php/cadastra.php", {
                method: "POST",
                body: dados
            });
        }
    });
})
.catch(error => {
    console.error('Erro:', error);
});
}
