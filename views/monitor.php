<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Status da Vaga Inteligente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<h1>Monitoramento das Vagas</h1>
<a href="?route=logout" style="margin-bottom: 20px; color: #dc3545; text-decoration: none;"><?php echo htmlspecialchars($username); ?> (Sair)</a>
<div id="status-container">
    Carregando status...
</div>

<script>
function atualizarStatus() {
    const container = document.getElementById('status-container');
    
    fetch('dados.json')
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao carregar dados.json: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            const statusClass = data.status === 'LIVRE' ? 'status-livre' : 'status-ocupada';

            container.innerHTML = `
                <p>Vaga: <strong>${data.vaga}</strong></p>
                <span class="${statusClass}">${data.status}</span>
                <p class="ultima-atualizacao">Última atualização: ${new Date().toLocaleTimeString()}</p>
            `;
        })
        .catch(error => {
            console.error('Erro de requisição:', error);
            container.innerHTML = `<p style="color: red;">Erro ao carregar dados: ${error.message}</p>`;
        });
}

atualizarStatus();
setInterval(atualizarStatus, 5000); 

</script>

</body>
</html>