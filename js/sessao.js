// Função para verificar a sessão
function verificarSessao() {
    fetch("php/verifica_sessao.php")
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro ao verificar sessão: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        if (data.sessaoAtiva === false) {
            window.location.href = 'login.html';
        }
    });
}

// Chamar a função para verificar a sessão quando a página carregar
window.onload = function() {
    verificarSessao();
};



function sair() {
    // Faz uma requisição AJAX para o script PHP que finaliza a sessão
    fetch('php/finalizarSessao.php')
        .then(response => response.json())
        .then(data => {
            // Se a sessão foi finalizada com sucesso
            if (data.sessaoAtiva === false) {
                // Redireciona para a página de login
                window.location.href = 'login.html';
            } else {
                // Exibe uma mensagem de erro, se necessário
                console.error('Erro ao finalizar sessão.');
            }
        })
        .catch(error => {
            console.error('Erro ao tentar finalizar sessão:', error);
        });
}