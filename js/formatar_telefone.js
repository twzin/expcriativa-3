function formatarTelefone() {
    var inputTelefone = document.getElementById('telefone');
    var telefone = inputTelefone.value.replace(/\D/g, ''); // Remove todos os caracteres que não são dígitos

    // Aplica a formatação (XX) XXXXX-XXXX
    telefone = telefone.replace(/(\d{2})(\d)/, '($1) $2');
    telefone = telefone.replace(/(\d{5})(\d)/, '$1-$2');

    inputTelefone.value = telefone;
}

// Adiciona um listener para formatar o telefone enquanto o usuário digita
document.getElementById('telefone').addEventListener('input', formatarTelefone);