const mysql = require('mysql');
const navbarController = require('./navBarController');

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'freefrom'
});

exports.paginaDesc = (req, res) => {
  const id = req.params.id;
  const user = req.session.user;

  navbarController(req, (navBar) => {
    if (user) {
      connection.query('SELECT * FROM produto WHERE id_produto = ?', [id], (error, results, fields) => {
        if (error) throw error;
        if (results == "") {
          res.redirect('/_404');
        } else {
          connection.query('SELECT * FROM vendedor WHERE id_vendedor = ?', [results[0].id_vendedor], (error, result, fields) => {
            if (error) throw error;
            connection.query('SELECT SUM(quantidade) AS total FROM compra WHERE id_produto = ?', [id], (err, resultado) => {
              if (resultado == undefined) {
                resultado = null;
                res.render('_descricaoProduto', { produtos: results, vendedor: result, vendidos: resultado, comprado: false, user: user, id: id, compredo: false, resulta: 0, navBar: navBar });
              } else {
                connection.query("SELECT SUM(quantidade) AS total FROM itens_produto WHERE id_usuario = ? AND id_produto = ?", [user[0].id_usuario, id], (er, resulta) => {
                  if (er) throw er;

                  let total = resulta[0].total;

                  if (total == null) {
                    total = 0;
                  }

                  if (resulta[0].total >= results[0].qtd_estoque) {
                    res.render('_descricaoProduto', { produtos: results, vendedor: result, vendidos: resultado[0].total, comprado: false, user: user, id: id, compredo: true, resulta: total, navBar: navBar });
                  } else if (resulta[0].total > 0) {
                    res.render('_descricaoProduto', { produtos: results, vendedor: result, vendidos: resultado[0].total, comprado: false, user: user, id: id, compredo: false, resulta: total, navBar: navBar });
                  } else {
                    res.render('_descricaoProduto', { produtos: results, vendedor: result, vendidos: resultado[0].total, comprado: false, user: user, id: id, compredo: false, resulta: total, navBar: navBar });
                  }
                });
              }
            });
          });
        }
      });
    } else {
      connection.query('SELECT * FROM produto WHERE id_produto = ?', [id], (error, results, fields) => {
        if (error) throw error;
        if (results == "") {
          res.redirect('/_404');
        } else {
          connection.query('SELECT * FROM vendedor WHERE id_vendedor = ?', [results[0].id_vendedor], (error, result, fields) => {
            if (error) throw error;
            connection.query('SELECT SUM(quantidade) AS total FROM compra WHERE id_produto = ?', [id], (err, resultado) => {
              if (resultado == undefined) {
                resultado = null;
                res.render('_descricaoProduto', { produtos: results, vendedor: result, vendidos: resultado, comprado: false, user: false, id: id, compredo: false, resulta: 0, navBar: navBar });
              } else {
                res.render('_descricaoProduto', { produtos: results, vendedor: result, vendidos: resultado[0].total, comprado: false, user: false, id: id, compredo: false, resulta: 0, navBar: navBar });
              }
            });
          });
        }
      });
    }
  }, 'produto');
}
