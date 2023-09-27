//on attent le chargement de la page
window.onload=()=>{
    //on cherche la zone de texte
    let message = document.querySelector("#MESSAGES");
    message.addEventListener("keyup",verifieEntree);
    //on cherche le bouton valide
    let valide = document.querySelector("#ENVOI");
    valide.addEventListener("click",ajoutMessage); 
}
  /**
     * cette function verifie si on a appuyer sur la touche entrer
    */
function verifieEntree(entre){
    if(entre.key=="Enter"){
        ajoutMessage();
    }
}
/**
 * cette function envoie le message en ajax dans un fichier php
*/
function ajoutMessage(){
//on recupere le message
    let message1 = document.querySelector("#MESSAGES").value
    //on verifie si le message n'est pas vide
    if(message1!=""){
        let donnees = {};
        donnees['message'] = message1;
        //on convertie les donnees en json
        let donneeJSON = JSON.stringify(donnees);
        //on envoie les donnes en methode en ajax
        //on lance ajax avec \\\xmlhttprequest
        let xmlhttp = new XMLHttpRequest();
      
        /**
        * on gere la reponse, on verifie si on recois le code 201
        */
        xmlhttp.onreadystatechange = function(){
            //on verifie si la requete est terminée 
            if(this.readyState == 4){
                if(this.status==201){
                    //l'enregistrement a fonctionnnée
                    //on efface le contenu du message
                    
                    document.querySelector("#MESSAGES").value = "";
                }else{
                    //cas de l'echec de l'enregistrement
                    let reponse = JSON.parse(this.response)
                    alert(reponse.message1)

                }
            }


        }
        //on ouvre la requete
        xmlhttp.open('POST', "ajax/ajaxDiscussion.php");

        //on envoi la requetes en inluant les donnees
        xmlhttp.send(donneeJSON);

    }else{
        alert('le contenu du message à  envoyer est vide');
    }
    
}
