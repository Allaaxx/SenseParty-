// grafico3
function pickRandomNumber3(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

let meta3 = pickRandomNumber3(50, 100); // Define uma meta inicial aleatória
let progresso3 = pickRandomNumber3(0, meta3); // Define um progresso inicial aleatório

// Verifica se o progresso é maior que a meta e ajusta, se necessário
if (progresso3 > meta3) {
    progresso3 = meta3;
}

// Calcula a porcentagem de progresso em relação à meta, garantindo que não ultrapasse 100%
const porcentagemProgresso3 = Math.min((progresso3 / meta3) * 100, 100);
const porcentagemMeta3 = 100 - porcentagemProgresso3;

// Configuração do gráfico 3
const config3 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [porcentagemMeta3, porcentagemProgresso3],
            backgroundColor: ['white', '#41f1b6']
        }]
    },
    options: {
        responsive: true,
        legend: {
            display: false  // Desativar a legenda
        },
        title: {
            display: true,
            text: 'Progresso da Meta 3'
        },
        animation: {
            duration: 1000,
            easing: 'easeInOutQuad'
        }
    }
};

// Exibição do gráfico 3
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('myChart3').getContext('2d');
    const chart3 = new Chart(ctx, config3);
    atualizarPorcentagemGrafico3(meta3, progresso3);

    // Função para simular o aumento do progresso
    setInterval(() => {
        progresso3 += pickRandomNumber3(1, 5); // Aumenta o progresso aleatoriamente
        if (progresso3 > meta3) {
            progresso3 = meta3; // Certifica-se de que o progresso não exceda a meta
        }

        meta3 -= pickRandomNumber3(0, 2); // Reduz a meta aleatoriamente
        if (meta3 < 0) {
            meta3 = 0; // Certifica-se de que a meta não seja menor que zero
        }

        // Calcula a porcentagem de progresso em relação à meta, garantindo que não ultrapasse 100%
        const porcentagemProgresso3 = Math.min((progresso3 / meta3) * 100, 100);
        const porcentagemMeta3 = 100 - porcentagemProgresso3;

        // Atualiza os dados do gráfico e a porcentagem exibida
        chart3.data.datasets[0].data = [porcentagemMeta3, porcentagemProgresso3];
        chart3.update();

        atualizarPorcentagemGrafico3(meta3, progresso3);
    }, 2000); // A cada 2 segundos (2000 milissegundos)
});

// Exibição da porcentagem no gráfico 3
function atualizarPorcentagemGrafico3(meta, progresso) {
    const porcentagem = calcularPorcentagemGrafico3(meta, progresso); 
    const container = document.getElementById("pzin3"); 
    container.textContent = `${porcentagem}%`; 

    const container2 = document.getElementById("progresso3"); 
    container2.textContent = `R$ ${progresso}`; 
}

// Cálculo para a porcentagem no meio do gráfico 3
function calcularPorcentagemGrafico3(meta3, progresso3) {
    return ((progresso3 / meta3) * 100).toFixed(1);
}
