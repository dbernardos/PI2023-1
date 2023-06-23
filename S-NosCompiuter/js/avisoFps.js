class SelectHandler {
    constructor() {
      this.selectElement = document.getElementById("btnFps");
      this.selectElement.addEventListener("change", this.handleOptionChange.bind(this));
      this.avisoExibido = false;
    }
    
    handleOptionChange() {
      var opcaoSelecionada = this.selectElement.value;
      
      if ((opcaoSelecionada == "144" || opcaoSelecionada == "240" || opcaoSelecionada == "360") && !this.avisoExibido) {
        alert("Aviso! O FPS acima de 60 pode não ser atingido nos casos em que os jogos selecionados sejam campanha!");
        this.avisoExibido = true;
      }
    }
  }
  
  // Instancia a classe SelectHandler
  const selectHandler = new SelectHandler();