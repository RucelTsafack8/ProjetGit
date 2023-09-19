
function recupererPrix() {
    var select = document.getElementById("CHOIX_FORMATION");
    var prix = document.getElementById("PRIX_FORMATION");
    var valeur = select.options[select.selectedIndex].value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'inscriptionetuds.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      if (xhr.status === 200) {
        prix.innerHTML = "Le prix est de " + xhr.responseText + "€.";
      } else {
        prix.innerHTML = "";
      }
    };
    xhr.send('produit=' + encodeURIComponent(valeur));
  }