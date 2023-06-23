const mysqls = require('mysql2');
const md5 = require('md5');
const validator = require('validator');

const connection = mysqls.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'freefrom'
  });


exports.paginaCadastro = (req, res) =>{
    res.render('_cadastro', {errado: false});
}

exports.postCadastro = (req, res) => {
  const usuario = req.body.usuario;
  const email = req.body.email;
  const senha = md5(req.body.senha);
  const dataNascimento = req.body.data;
  const sexo = req.body.sexo;
  const endereço = req.body.Endereço;
  const numero = req.body.Numero;
  const cidade = req.body.Cidade;
  const uf = req.body.UF;
  const cpf = req.body.cpf;

  var data = new Date(dataNascimento);
  var dataAtual = new Date();
  var dataLimite = new Date(dataAtual.getFullYear() - 16, dataAtual.getMonth(), dataAtual.getDate());
  var validaEmail;
  var validaSenha;
  var senhaErro;
  var validaData;
  var validaUF;

  var validaCpf = validarCPF(cpf);

  if(validator.isEmail(email)){
    validaEmail = true;
  }
  else{
    validaEmail = false;
  }

  if(req.body.senha.length >= 6 && req.body.senha.length <= 30){
    validaSenha = true;
  }
  else if(req.body.senha.length < 6){
    validaSenha = false;
    senhaErro = "Senha muito pequena, digite uma senha com no minimo 6 caracteres!!";
  }
  else if(req.body.senha.length > 30){
    validaSenha = false;
    senhaErro = "Senha muito grande!! Digite uma senha com no maximo 30 caracteres!!";
  }
  else{
    validaSenha = false;
    senhaErro = "Senha invalida!";
  }
  
  if(dataNascimento == null || dataNascimento == "" || dataNascimento == undefined || data >= dataAtual || data > dataLimite){
    validaData = false;
  }
  else if(!dataNascimento){
    validaData = false;
  }
  else{
    validaData = true;
  }

  if(uf == null || uf == "" || uf == undefined){
    validaUF = false;
  }
  else if(!uf){
    validaUF = false;
  }
  else{
    validaUF = true;
  }

  if(validaEmail && validaSenha && validaData && validaUF && validaCpf){
    const sql = 'INSERT INTO usuario (email, usuario, senha, data_nascimento, sexo, endereco, numero, cidade, uf, cpf) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
    const values = [email, usuario, senha, dataNascimento, sexo, endereço, numero, cidade, uf, cpf];
        connection.query('SELECT * FROM usuario WHERE email = ?', email, (error, results, fields) => {
            if (error) res.render('_Cadastro', {errado: true, error: 'Algo deu errado no seu cadastro!! Tente novamente'});

            if (results.length > 0) {
                // Usuário já existe no banco de dados
                res.render('_Cadastro', {errado: true, error: 'Usuario já cadastrado'})
            } else {
              connection.query('SELECT * FROM usuario WHERE usuario = ?', usuario, (erro, result, field) => {
                if(result.length > 0){
                  res.render('_Cadastro', {errado: true, error: 'Este nome ja esta sendo usado!!'});
                }else{
                  connection.query(sql, values, (err, result) => {
                    if (err) {
                        console.error('Erro ao inserir dados no banco de dados: ' + err.stack);
                        return;
                    }
                    connection.query("SELECT * FROM usuario WHERE id_usuario = ?", [result.insertId], (errors, results) => {
                      req.session.user = results;
                      res.redirect('/_Produtos');
                    })
                    });
                }
              })
            }
        });
    }
    else{
        if(!validaEmail){
            res.render('_Cadastro', {errado: true, error: 'Email inválido!!'});
        }
        if(!validaSenha){
          res.render('_Cadastro', {errado: true, error: senhaErro});
        }
        if(!validaData){
          var msg = "Data de nascimento não pode ser nula!!";
          if (data > dataAtual) {
            msg = 'A data selecionada é maior do que a data atual!!';
          }
          else if(data > dataLimite) {
            msg = 'Você tem menos de 16 anos!! Não pode se cadastrar até ter 16!.'
          }
          res.render('_Cadastro', {errado: true, error: msg});
        }
        if(!validaUF){
          res.render('_Cadastro', {errado: true, error: 'UF não pode ser nulo!!'});
        }
        if(!validaCpf){
          res.render('_Cadastro', {errado: true, error: 'CPF invalido!!'});
        }
    }
}

function validarCPF(cpf) {
  // Remover caracteres não numéricos
  cpf = cpf.replace(/\D/g, '');

  // Verificar se o CPF possui 11 dígitos
  if (cpf.length !== 11) {
    return false;
  }

  // Verificar se todos os dígitos são iguais
  if (/^(\d)\1+$/.test(cpf)) {
    return false;
  }

  // Validar o primeiro dígito verificador
  let soma = 0;
  for (let i = 0; i < 9; i++) {
    soma += parseInt(cpf.charAt(i)) * (10 - i);
  }
  let resto = (soma * 10) % 11;
  if (resto === 10 || resto === 11) {
    resto = 0;
  }
  if (resto !== parseInt(cpf.charAt(9))) {
    return false;
  }

  // Validar o segundo dígito verificador
  soma = 0;
  for (let i = 0; i < 10; i++) {
    soma += parseInt(cpf.charAt(i)) * (11 - i);
  }
  resto = (soma * 10) % 11;
  if (resto === 10 || resto === 11) {
    resto = 0;
  }
  if (resto !== parseInt(cpf.charAt(10))) {
    return false;
  }

  // CPF válido
  return true;
}