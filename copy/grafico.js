// grafico1

function pickRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
function pickRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

const meta = pickRandomNumber(0, 100); 
const progresso = pickRandomNumber(0, meta);


if (progresso > meta) {
    progresso = meta;
}

// configuração do grafico

const config = {
    type: 'doughnut',
    data: {
        
        datasets: [{
            data: [meta, progresso],
            backgroundColor: ['#7380ec', 'white']
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

// grafico2
const config2 = {
    type: 'doughnut',
    data: {
        
        datasets: [{
            data: [meta, progresso],
            backgroundColor: ['white', '#f77882']
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

// grafico3
const config3 = {
    type: 'doughnut',
    data: {
        
        datasets: [{
            data: [meta, progresso],
            backgroundColor: [ 'white', '#41f1b6']
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
// exibição dos graficos

// grafico1
document.addEventListener('DOMContentLoaded', function() {
    var ctx1 = document.getElementById('myChart1').getContext('2d');
    new Chart(ctx1, config);
    atualizarPorcentagemGrafico1(meta, progresso); 
});

// grafico2
document.addEventListener('DOMContentLoaded', function() {
    var ctx1 = document.getElementById('myChart2').getContext('2d');
    new Chart(ctx1, config2);
    atualizarPorcentagemGrafico2(meta, progresso); 
});

// grafico3
document.addEventListener('DOMContentLoaded', function() {
    var ctx1 = document.getElementById('myChart3').getContext('2d');
    new Chart(ctx1, config3);
    atualizarPorcentagemGrafico3(meta, progresso); 
});


//exibir a porcentagem nos graficos

// grafico1
function atualizarPorcentagemGrafico1(meta, progresso) {
    const porcentagem = calcularPorcentagemGrafico1(meta, progresso); 
    
    const container = document.getElementById("pzin"); 
    container.textContent = `${porcentagem}%`; 
}

// grafico2
function atualizarPorcentagemGrafico2(meta, progresso) {
    const porcentagem2 = calcularPorcentagemGrafico1(meta, progresso); 
    
    const container = document.getElementById("pzin2"); 
    container.textContent = `${porcentagem2}%`; 
}
 
// grafico3
function atualizarPorcentagemGrafico3(meta, progresso) {
    const porcentagem3 = calcularPorcentagemGrafico1(meta, progresso); 
    
    const container = document.getElementById("pzin3"); 
    container.textContent = `${porcentagem3}%`; 
}

// calculo pra poncetagem no meio do grafico
function calcularPorcentagemGrafico1(meta, progresso) {
    return ((progresso / meta) * 100).toFixed(1); 
}
