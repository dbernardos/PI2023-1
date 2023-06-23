function logout() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
      }
    };
    xhttp.open("POST", "logout.php", true);
    xhttp.send();

    location.href="../login/indexlogin.php"
  }