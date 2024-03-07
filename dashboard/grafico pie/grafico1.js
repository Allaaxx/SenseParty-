// // Funções para o Gráfico 1
// function calcularPorcentagemGrafico1(meta, progresso) {
//     return ((progresso / meta) * 100).toFixed(2); // Calcula a porcentagem e arredonda para 2 casas decimais
// }

// function atualizarPorcentagemGrafico1(meta, progresso) {
//     const porcentagem = calcularPorcentagemGrafico1(meta, progresso); // Calcula a porcentagem
    
//     const container = document.getElementById("valor1"); // Obtém uma referência ao elemento HTML onde deseja exibir a porcentagem
//     container.textContent = `${porcentagem}%`; // Atualiza o texto dentro do elemento <p>
// }

// function atualizarGrafico1(meta, progresso) {
//     const metaRestante = meta - progresso;
//     const metaAlcancada = progresso;

    // const config = {
    //     type: 'doughnut',
    //     data: {
    //         labels: ['Meta Restante', 'Meta Alcançada'],
    //         datasets: [{
    //             data: [metaRestante, metaAlcancada],
    //             backgroundColor: ['#FF5733', '#33FF57']
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         legend: {
    //             display: true,
    //             position: 'bottom'
    //         },
    //         title: {
    //             display: true,
    //             text: 'Progresso da Meta 1'
    //         },
    //         animation: {
    //             duration: 1000,
    //             easing: 'easeInOutQuad',
    //             onProgress: function(animation) {
    //                 var metaRestante = animation.currentStep / animation.numSteps * meta;
    //                 this.data.datasets[0].data[0] = metaRestante;
    //             }
    //         }
    //     }
    // };

    // var ctx1 = document.getElementById('myChart1').getContext('2d');
    // new Chart(ctx1, config);
// // }

// // Definição das metas e progresso para o gráfico 1
// const metaInicial1 = 300;
// const progressoInicial1 = 300;

// // Atualiza a porcentagem e o gráfico
// atualizarPorcentagemGrafico1(metaInicial1, progressoInicial1);
// atualizarGrafico1(metaInicial1, progressoInicial1);


document.addEventListener('DOMContentLoaded', function () {
    // Dados do gráfico
    const data = {
        labels: ['Red', 'Blue', 'Yellow'],
        datasets: [{
            data: [300, 50, 100],
            backgroundColor: ['#FF5733', '#337AFF', '#FFD700']
        }]
    };

    // Configurações do gráfico
    const config = {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            legend: {
                display: true,
                position: 'bottom'
            },
            title: {
                display: true,
                text: 'Exemplo de Doughnut Chart'
            }
        }
    };

    // Renderizar o gráfico
    var ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, config);
});
