function login(){
    var form= document.getElementById("formCadastro");
    var dados = new FormData(form);
    var senha = dados.get("senha");
    var email = dados.get("email");

    var senhaHash = CryptoJS.SHA256(senha).toString();
    // dados.set("senha", senhaHash);
    
    async function verificaLogin(email, senhaHash, chave, iv) {
        return fetch("php/login.php", {
            method: "POST",
            body: JSON.stringify({ email: email, senha: senhaHash, chave: chave, iv: iv })
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

    var senhaCriptografada = CryptoJS.AES.encrypt(senhaHash, chaveAES, {
        iv: iv,
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7 
    }).toString();

    verificaLogin(emailCriptografado, senhaCriptografada, chaveAEScriptografada, iv.toString(CryptoJS.enc.Base64)).then(response => {
        if (!response.loginExiste) {
            var senha_invalida = document.getElementById('senha_invalida');
            senha_invalida.textContent = "Login ou senha incorretos";
            return;
        } else if(!response.contaAtivada){
            var senha_invalida = document.getElementById('senha_invalida');
            senha_invalida.textContent = "Sua conta não está atiavada, verifique seu email!";
            return;
        } else {
            window.location = ("\\theindependentden-master2\\2FA.html");
        }
    });
});

}
