function pickRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

let meta = pickRandomNumber(50, 100); // Define uma meta inicial aleatória
let progresso = pickRandomNumber(0, meta); // Define um progresso inicial aleatório

// Verifica se o progresso é maior que a meta e ajusta, se necessário
if (progresso > meta) {
    progresso = meta;
}

// Calcula a porcentagem de progresso em relação à meta, garantindo que não ultrapasse 100%
const porcentagemProgresso = Math.min((progresso / meta) * 100, 100);
const porcentagemMeta = 100 - porcentagemProgresso;

// Configuração do gráfico
const config = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [porcentagemMeta, porcentagemProgresso],
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
            text: 'Progresso da Meta 1'
        },
        animation: {
            duration: 1000,
            easing: 'easeInOutQuad'
        }
    }
};

// Exibição do gráfico
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('myChart1').getContext('2d');
    const chart = new Chart(ctx, config);
    atualizarPorcentagemGrafico1(meta, progresso);

    // Função para simular o aumento do progresso
    setInterval(() => {
        progresso += pickRandomNumber(1, 5); // Aumenta o progresso aleatoriamente
        if (progresso > meta) {
            progresso = meta; // Certifica-se de que o progresso não exceda a meta
        }

        meta -= pickRandomNumber(0, 2); // Reduz a meta aleatoriamente
        if (meta < 0) {
            meta = 0; // Certifica-se de que a meta não seja menor que zero
        }

        // Calcula a porcentagem de progresso em relação à meta, garantindo que não ultrapasse 100%
        const porcentagemProgresso = Math.min((progresso / meta) * 100, 100);
        const porcentagemMeta = 100 - porcentagemProgresso;

        // Atualiza os dados do gráfico e a porcentagem exibida
        chart.data.datasets[0].data = [porcentagemMeta, porcentagemProgresso];
        chart.update();

        atualizarPorcentagemGrafico1(meta, progresso);
    }, 2000); // A cada 2 segundos (2000 milissegundos)
});

// Exibição da porcentagem no gráfico
function atualizarPorcentagemGrafico1(meta, progresso) {
    const porcentagem = calcularPorcentagemGrafico1(meta, progresso);
    const container = document.getElementById("pzin");
    container.textContent = `${porcentagem}%`;
}

// Cálculo para a porcentagem no meio do gráfico
function calcularPorcentagemGrafico1(meta, progresso) {
    return Math.min((progresso / meta) * 100, 100).toFixed(1);
}



// // grafico2
// const config2 = {
//     type: 'doughnut',
//     data: {
        
//         datasets: [{
//             data: [meta, progresso],
//             backgroundColor: ['white', '#f77882']
//         }]
//     },
//     options: {
//         responsive: true,
//         legend: {
//             display: false  // Desativar a legenda
//         },
//         title: {
//             display: true,
//             text: 'Progresso da Meta 1'
//         },
//         animation: {
//             duration: 1000,
//             easing: 'easeInOutQuad'
//         }
//     }
// };

// // grafico3
// const config3 = {
//     type: 'doughnut',
//     data: {
        
//         datasets: [{
//             data: [meta, progresso],
//             backgroundColor: [ 'white', '#41f1b6']
//         }]
//     },
//     options: {
//         responsive: true,
//         legend: {
//             display: false  // Desativar a legenda
//         },
//         title: {
//             display: true,
//             text: 'Progresso da Meta 1'
//         },
//         animation: {
//             duration: 1000,
//             easing: 'easeInOutQuad'
//         }
//     }
// };
// // exibição dos graficos

// grafico1

