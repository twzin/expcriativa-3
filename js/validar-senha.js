document.getElementById('telefone').addEventListener('input', function() {
    var inputTelefone = document.getElementById('telefone');
    var telefone = inputTelefone.value.replace(/\D/g, ''); // Remove todos os caracteres que não são dígitos

    // Aplica a formatação (XX) XXXXX-XXXX
    telefone = telefone.replace(/(\d{2})(\d)/, '($1) $2');
    telefone = telefone.replace(/(\d{5})(\d)/, '$1-$2');

    inputTelefone.value = telefone;
});


document.getElementById('senha').addEventListener('input', function () {
    var senha = document.getElementById('senha').value;

    // Verifica comprimento
    if (senha.length >= 8) {
        document.getElementById('comprimento').style.color = 'green';
    } else {
        document.getElementById('comprimento').style.color = 'black';
    }

    // Verifica letra maiúscula
    if (/[A-Z]/.test(senha)) {
        document.getElementById('maiuscula').style.color = 'green';
    } else {
        document.getElementById('maiuscula').style.color = 'black';
    }

    // Verifica letra minúscula
    if (/[a-z]/.test(senha)) {
        document.getElementById('minuscula').style.color = 'green';
    } else {
        document.getElementById('minuscula').style.color = 'black';
    }

    // Verifica número
    if (/\d/.test(senha)) {
        document.getElementById('numero').style.color = 'green';
    } else {
        document.getElementById('numero').style.color = 'black';
    }

    // Verifica caractere especial
    if (/[!@#$%^&*?]/.test(senha)) {
        document.getElementById('caractere').style.color = 'green';
    } else {
        document.getElementById('caractere').style.color = 'black';
    }
});