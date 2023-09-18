document.getElementById('hautButton').addEventListener('click', function(){
    window.scrollTo(0, 0);
})
//visualise les donnes des etudiants
let etudiants = document.getElementById("etudiant");
etudiants.addEventListener("click",function(etudiant){
    etudiant.preventDefault();
    window.location='donneeetu.php';
})
//visua.ise les donnees des secretaires
let secretaires = document.getElementById("secretaire");
secretaires.addEventListener("click",function(secret){
    secret.preventDefault();
    window.location=('donneeset.php');
})
//visualise les donnes des professeurs
let professeurs = document.getElementById("professeur");
professeurs.addEventListener("click",function(prof){
    prof.preventDefault();
    window.location=('donneeprof.php');
})
//visualise les donnees des stagiaire
let stagiaires = document.getElementById("stagiare");
stagiaires.addEventListener("click",function(stage){
    stage.preventDefault();
    window.location=('donneestage.php');
})
//visualise le montant enter (les inscriptions)
let argent_entrer = document.getElementById("montant_enter");
argent_entrer.addEventListener("click",function(money_enter){
    money_enter.preventDefault();
    window.location=('detailargent.php');
})
//visualise le montant sortie
let argent_sorti = document.getElementById("montant_sortie");
argent_sorti.addEventListener("click",function(depenses){
    depenses.preventDefault();
    window.location=('detailsdepense.php');
})