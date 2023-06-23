// Pega o valor do botão On/Off
var onOff = document.getElementById('onOff');

// Cria uma variavel para o botão
var selectGeral = document.getElementById('btnDesempenhoGeral');
var selectFps = document.getElementById('btnFps');
var selectGrafico = document.getElementById('btnGrafico');

// Desabilita os botões das opções avançadas
selectFps.disabled = true;
selectGrafico.disabled = true;

// Cria um evento para ao alterar o valor de On/Off os botões sejam ativados e desativados
onOff.addEventListener('change', function(){
    if(onOff.value == 'On'){
        selectGeral.disabled = true;
        selectFps.disabled = false;
        selectGrafico.disabled = false;
    
    } else {
        selectGeral.disabled = false;
        selectFps.disabled = true;
        selectGrafico.disabled = true;
    
    }
});

document.getElementById("form-pesquisa").addEventListener("submit", function(event) {
    if (softwares.length === 0) {
        console.log("A array está vazia.");
        // Exibe um aviso
        alert("Ao menos um software deve ser selecionado!");
        // Bloqueia o envio do formulário
        event.preventDefault();
    }
});

function validarCampo(event) {
    var campo = document.getElementById("orcamento").value;
    if (campo < 0) {
      alert("O orçamento não pode conter números negativos!");
      event.preventDefault(); //bloqueia envio do formulário
    }

    if (campo == 0) {
        alert("O campo orçamento deve ser preenchido!");
        event.preventDefault(); //bloqueia envio do formulário
      }
  }


