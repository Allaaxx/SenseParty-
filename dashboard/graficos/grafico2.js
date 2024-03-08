// grafico2
function pickRandomNumber2(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

let meta2 = pickRandomNumber2(50, 100); // Define uma meta inicial aleatória
let progresso2 = pickRandomNumber2(0, meta2); // Define um progresso inicial aleatório

// Verifica se o progresso é maior que a meta e ajusta, se necessário
if (progresso2 > meta2) {
    progresso2 = meta2;
}

// Calcula a porcentagem de progresso em relação à meta, garantindo que não ultrapasse 100%
const porcentagemProgresso2 = Math.min((progresso2 / meta2) * 100, 100);
const porcentagemMeta2 = 100 - porcentagemProgresso2;

// Configuração do gráfico 2
const config2 = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [porcentagemMeta2, porcentagemProgresso2],
            backgroundColor: ['white', '#7380ec']
        }]
    },
    options: {
        responsive: true,
        legend: {
            display: false  // Desativar a legenda
        },
        title: {
            display: true,
            text: 'Progresso da Meta 2'
        },
        animation: {
            duration: 1000,
            easing: 'easeInOutQuad'
        }
    }
};

// Exibição do gráfico 2
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('myChart2').getContext('2d');
    const chart2 = new Chart(ctx, config2);
    atualizarPorcentagemGrafico2(meta2, progresso2);

    // Função para simular o aumento do progresso
    setInterval(() => {
        progresso2 += pickRandomNumber2(1, 5); // Aumenta o progresso aleatoriamente
        if (progresso2 > meta2) {
            progresso2 = meta2; // Certifica-se de que o progresso não exceda a meta
        }

        meta2 -= pickRandomNumber2(0, 2); // Reduz a meta aleatoriamente
        if (meta2 < 0) {
            meta2 = 0; // Certifica-se de que a meta não seja menor que zero
        }

        // Calcula a porcentagem de progresso em relação à meta, garantindo que não ultrapasse 100%
        const porcentagemProgresso2 = Math.min((progresso2 / meta2) * 100, 100);
        const porcentagemMeta2 = 100 - porcentagemProgresso2;

        // Atualiza os dados do gráfico e a porcentagem exibida
        chart2.data.datasets[0].data = [porcentagemMeta2, porcentagemProgresso2];
        chart2.update();

        atualizarPorcentagemGrafico2(meta2, progresso2);
    }, 2000); // A cada 2 segundos (2000 milissegundos)
});

// Exibição da porcentagem no gráfico 2
function atualizarPorcentagemGrafico2(meta, progresso) {
    const porcentagem = calcularPorcentagemGrafico2(meta, progresso); 
    const container = document.getElementById("pzin2"); 
    container.textContent = `${porcentagem}%`; 

    const container2 = document.getElementById("progresso2"); 
    container2.textContent = `R$ ${progresso}`; 
}
// Cálculo para a porcentagem no meio do gráfico 2
function calcularPorcentagemGrafico2(meta2, progresso2) {
    return ((progresso2 / meta2) * 100).toFixed(1);
}
