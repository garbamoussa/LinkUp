<DOCTYPE html>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Multi Step Registration Form Using JQuery Bootstrap in PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<?php

require_once('../inc/config.php');
require_once('../inc/fonction.inc.php');

 // if ($login) {
//  // debug($_POST);

// // vérification de la longueur du pseudo :
// if (strlen($_POST['login']) < 4 || strlen($_POST['login']) > 20) {
//  $msg .='<div class="bg-danger">Le pseudo doit contenir entre 4 et 20 caractères</div>';
// }
// }


// vérifcation que le code postal est un numérique :
// if ($cdp != (!is_numeric($cdp))) {
//  $msg .='<div class="bg-danger">Le code postal n\'est pas valide</div>';
// }



if(isset($_POST["email"]))
{

// vérification de l'unicité de email :
  $email_verif = $mysqli->query("SELECT * FROM medecin WHERE email = '$_POST[email]'");

  if ($email_verif->num_rows > 0) { // s'il y a au moins 1 enregistrement, c'est que l'email est déja pris

    $msg .='<div class="bg-danger">Email indisponible. Veuillez en choisir un autre</div>';

  } else { // l'email n'existe pas, on peut donc enregistrer le membre


  


    // crytage du mot de passe :
    $_POST['password'] = md5($_POST['password']); // pa fonction md5 prédéfinie md5 permet de crypter un string.


foreach ($_POST as $indice => $valeur) {
      $_POST[$indice] = validate_input($valeur, ENT_QUOTES);    
       }
  
        // }


// insertion en base :
    $mysqli->query("INSERT INTO medecin (specialite, nom, prenom, adresse, ville, cdp, pays, tel, email, immat, statut, login, password, acceptation, inscription)

     VALUES ('$_POST[specialite]','$_POST[nom]','$_POST[prenom]', '$_POST[adresse]', '$_POST[ville]','$_POST[cdp]','$_POST[pays]', '$_POST[tel]','$_POST[email]',0,0,'$_POST[login]','$_POST[password]','$_POST[acceptation]',NOW())") or die($mysqli->error);


$msg = '
  <div class="alert alert-success">
  Vous étes inscrit
  </div>';

  header('location:../index.php'); //renvoie sur la racine concerne
        exit();


     // } //fin du fin (empty($msg))


   }// fin du else

} // fin du $_POST["email"]


echo $msg;

 ?>

  <style>
  .box
  {
   width:800px;
   margin:0 auto;
  }
  .active_tab1
  {
   background-color:#fff;
   color:#333;
   font-weight: 100;
  }
  .inactive_tab1
  {
   background-color: #f5f5f5;
   color: #333;
   cursor: not-allowed;
  }
  .has-error
  {
   border-color:#cc0000;
   background-color:#ffff99;
  }
  </style>


 </head>
 <body>
 <br />
  <div class="container box">
   <br />
   <form method="post" id="register_form" action="#" onsubmit="if(document.getElementById('acceptation').checked) { return true; }
 else { alert('Please indicate that you have read and agree to the Terms and Conditions and Privacy Policy'); return false; }">

   <form method="post" id="register_form">
    <ul class="nav nav-tabs">

     <li class="nav-item">
      <a class="nav-link active_tab1" id="list_contact_details" style="border:1px solid #ccc">Contact</a>
     </li>

     <li class="nav-item">
      <a class="nav-link inactive_tab1" id="list_login_details" style="border:1px solid #ccc">Inscription</a>
     </li>

    </ul>


    <div class="tab-content" style="margin-top:16px;">

 
  <div class="tab-pane active" id="contact_details">
      <div class="panel panel-default">
       <div class="panel-heading">Contact</div>
       <div class="panel-body">

  <form>
  <div class="form-row">
    <div class="form-group col-md-5">
     <!-- <label>Enter Nom</label> -->
         <input type="text" name="nom" id="nom" class="form-control" style="text-transform: uppercase;" placeholder="Entrez votre nom"/>
         <span id="error_nom" class="text-danger"></span>
    </div>
         <div class="form-group col-md-6">
         <!-- <label>Enter Prénom</label> -->
         <input type="text" name="prenom" id="prenom" class="form-control" style="text-transform: capitalize;" placeholder="Entrez votre prénom"/>
         <span id="error_prenom" class="text-danger"></span>
        </div>
      </div>


  <div class="form-row">
    <div class="form-group col-md-5">
         <!-- <label>Enter Addresse</label> -->
         <input type="text" name="adresse" id="adresse" class="form-control" placeholder="Entrez votre adresse" />
         <span id="error_adresse" class="text-danger"></span>
        </div>

        <div class="form-group col-md-3">
         <!-- <label>Enter Code postal</label> -->
         <input type="text" name="cdp" id="cdp" class="form-control" placeholder=" Code postal" />
         <span id="error_cdp" class="text-danger"></span>
        </div>
      </div>  

  <div class="form-row">
    <div class="form-group col-md-3">
         <!-- <label>Enter Ville</label> -->
         <input type="text" name="ville" id="ville" class="form-control" style="text-transform: capitalize;" placeholder="Ville"/>
         <span id="error_ville" class="text-danger"></span>
        </div>

        <div class="form-group col-md-5">
         <!-- <label>Enter Pays</label> -->
         <input type="text" name="pays" id="pays" class="form-control" style="text-transform: capitalize;" placeholder="Pays"/>
         <span id="error_pays" class="text-danger"></span>
        </div>
      </div>

  
  <div class="form-row">
    <div class="form-group col-md-6">             
         <!-- <label>Enter Email</label> -->
         <input type="text" name="email" id="email" class="form-control" placeholder="Email"/>
         <span id="error_email" class="text-danger"></span>
        </div>
      </div>

  <div class="form-row">
    <div class="form-group col-md-5">       
         <!-- <label>Enter Numero de telephone</label> -->
         <input type="text" name="tel" id="tel" class="form-control" style="text-transform: capitalize;" placeholder="Numero de telephone"/>
         <span id="error_tel" class="text-danger"></span>
        </div>
      

    <div class="form-group col-md-5">
         <!--<label>Enter Specialite </label> -->
         <input type="text" name="specialite" id="specialite" class="form-control"  placeholder="Entrez votre specialite"/>
         <span id="error_specialite" class="text-danger"></span>
    </div>
  </div>


  <div class="form-row">
    <div class="form-group col-md-11">
      <div align="center">
         <button type="button" name="btn_contact_details" id="btn_contact_details"  class="btn btn-success" >Next</button>
        </div>
      </div>
    </div>
        
      </form>
        <br />
       </div>
      </div>
   </div>

  <div class="tab-pane fade" id="login_details">
      <div class="panel panel-default">
       <div class="panel-heading">Login Details</div>
       <div class="panel-body">


        <div class="form-row">
           <div class="form-group col-md-6"> 
         <!-- <label>Login</label> -->
         <input type="text" name="login" id="login" class="form-control" placeholder="Identifiant"/>
         <span id="error_login" class="text-danger"></span>
        </div>


         <div class="form-group col-md-6"> 
         <!-- <label>Enter Password</label> -->
         <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe"/>
         <span id="error_password" class="text-danger"></span></div><br />

         
         <input type='checkbox' id='toggle' value='0' onchange='togglePassword(this);'>&nbsp; <span id='toggleText'>Show</span>



         <div><input type="checkbox" value="check" required="required" disabled="disabled" checked="checked" name="acceptation" id="acceptation">  J'ai lu et j'accepte les <A href="cvg/cvg.php"> conditions d'utilsation</A></div>
        </div>

        <!-- <div align="center">
         <button type="button" name="btn_login_details" id="btn_login_details" class="btn btn-info btn-lg">Next</button>
        </div> -->

        <div align="center">
         <button type="button" name="previous_btn_login_details" id="previous_btn_login_details" class="btn btn-success">Previous</button>
         <!--button type="button" name="btn_login_details" id="btn_login_details" class="btn btn-info btn-lg">Next</button-->
        <button type="button" name="btn_login_details" id="btn_login_details" class="btn btn-success">Register</button>
        </div>
        </div>


        <br />
       </div>
      </div>
    </div>
  
    </div>
   </form>
  </div>

<script>
// Show and Hide Password

 $("#toggle").change(function(){
  
  // Check the checkbox state
  if($(this).is(':checked')){
   // Changing type attribute
   $("#password").attr("type","text");
   
   // Change the Text
   $("#toggleText").text("Hide");
  }else{
   // Changing type attribute
   $("#password").attr("type","password");
  
   // Change the Text
   $("#toggleText").text("Show");
  }
 
 });

$(document).ready(function(){


   $('#btn_contact_details').click(function(){
  var error_specialite = '';
  var error_nom = '';
  var error_prenom = '';  
  var error_adresse = '';
  var error_ville = '';
  
  var error_cdp = '';
  var error_pays = '';
  var mobile_validation = /^\d{10}$/;
  var error_tel = '';
  var error_email = '';
  var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  var filtre = /^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/;
  
  
  if($.trim($('#specialite').val()).length == 0)
  {
   error_specialite = 'Specialite requise ';
   $('#error_specialite').text(error_specialite);
   $('#specialite').addClass('has-error');
  }
  else
  {
   error_specialite = '';
   $('#error_specialite').text(error_specialite);
   $('#specialite').removeClass('has-error');
  }

    if($.trim($('#nom').val()).length == 0)
  {
   error_nom = 'Nom est requis';
   $('#error_nom').text(error_nom);
   $('#nom').addClass('has-error');
  }
  else
  {
   error_nom = '';
   $('#error_nom').text(error_nom);
   $('#nom').removeClass('has-error');
  }

  if($.trim($('#prenom').val()).length == 0)
  {
   error_prenom = 'Prénom est requis';
   $('#error_prenom').text(error_prenom);
   $('#prenom').addClass('has-error');
  }
  else
  {
   error_prenom = '';
   $('#error_prenom').text(error_prenom);
   $('#prenom').removeClass('has-error');
  }

  if($.trim($('#adresse').val()).length == 0)
  {
   error_adresse = 'Adresse est requise';
   $('#error_adresse').text(error_adresse);
   $('#adresse').addClass('has-error');
  }
  else
  {
   error_adresse = '';
   $('#error_adresse').text(error_adresse);
   $('#adresse').removeClass('has-error');
  }

  if($.trim($('#ville').val()).length == 0)
  {
   error_ville= 'Ville est requise';
   $('#error_ville').text(error_ville);
   $('#ville').addClass('has-error');

  }
    else
    {
     error_ville = '';
   $('#error_ville').text(error_ville);
   $('#ville').removeClass('has-error');
  }

 if($.trim($('#cdp').val()).length == 0)
  {
   error_cdp = 'Code postal est requis';
   $('#error_cdp').text(error_cdp);
   $('#cdp').addClass('has-error');

  }
  else
  {
   if (!filtre.test($('#cdp').val()))
   {
    error_cdp = 'code postal invalide';
    $('#error_cdp').text(error_cdp);
    $('#cdp').addClass('has-error');


  }
  else
  {
   error_cdp = '';
   $('#error_cdp').text(error_cdp);
   $('#cdp').removeClass('has-error');
  }

}

  if($.trim($('#pays').val()).length == 0)
  {
   error_pays = 'Pays est requis';
   $('#error_pays').text(error_pays);
   $('#pays').addClass('has-error');
  }
  else
  {
   error_pays = '';
   $('#error_pays').text(error_pays);
   $('#pays').removeClass('has-error');
  }
  
  if($.trim($('#email').val()).length == 0)
  {
   error_email = 'Email est requis';
   $('#error_email').text(error_email);
   $('#email').addClass('has-error');
  }
  else
  {
   if (!filter.test($('#email').val()))
   {
    error_email = 'Email invalide';
    $('#error_email').text(error_email);
    $('#email').addClass('has-error');
   }
   else
   {
    error_email = '';
    $('#error_email').text(error_email);
    $('#email').removeClass('has-error');
   }
  }
    if($.trim($('#tel').val()).length == 0)
  {
   error_tel ='Numero de telephone requis';
   $('#error_tel').text(error_tel);
   $('#tel').addClass('has-error');
  }
     else
  {
   if (!mobile_validation.test($('#tel').val()))
   {
    error_tel = 'Numéro de telephone invalide';
    $('#error_tel').text(error_tel);
    $('#tel').addClass('has-error');
   } 
  else
  {
   error_tel= '';
   $('#error_tel').text(error_tel);
   $('#tel').removeClass('has-error');
  }
}

  

  if(error_specialite != '' ||  error_nom != '' || error_prenom != '' || error_adresse != '' || error_cdp != '' || error_ville != '' || error_pays != '' ||error_tel != '' || error_email != '') 
  {
   return false;
  }
  else
  

  {
   $('#list_contact_details').removeClass('active active_tab1');
   $('#list_contact_details').removeAttr('href data-toggle');
   $('#contact_details').removeClass('active');
   $('#list_contact_details').addClass('inactive_tab1');
   $('#list_login_details').removeClass('inactive_tab1');
   $('#list_login_details').addClass('active_tab1 active');
   $('#list_login_details').attr('href', '#login_details');
   $('#list_login_details').attr('data-toggle', 'tab');
   $('#login_details').addClass('active in');
  }
 });
 
 $('#previous_btn_login_details').click(function(){
  $('#list_login_details').removeClass('active active_tab1');
  $('#list_login_details').removeAttr('href data-toggle');
  $('#login_details').removeClass('active in');
  $('#list_personal_details').addClass('inactive_tab1');
  $('#list_contact_details').removeClass('inactive_tab1');
  $('#list_contact_details').addClass('active_tab1 active');
  $('#list_contact_details').attr('href', '#login_details');
  $('#list_contact_details').attr('data-toggle', 'tab');
  $('#contact_details').addClass('active in');
 });
  
 });
 
 

 $('#btn_login_details').click(function(){
  
  var error_login = '';
  var error_password = '';
  
  
  
   if($.trim($('#login').val()).length == 0)
  {
   error_login = 'Identifiant requis';
   $('#error_login').text(error_login);
   $('#login').addClass('has-error');

   }
  else
  {

    if($.trim($('#login').val()).length < 4 )
  {
   error_login = 'Identifiant doit contenir 4 caractères';
   $('#error_login').text(error_login);
   $('#login').addClass('has-error');

    }
  else
  {

    if($.trim($('#login').val()).length > 20)
  {
   error_login = 'Identifiant est limité à 20 caractères';
   $('#error_login').text(error_login);
   $('#login').addClass('has-error');

  }
  else
  {
   error_login = '';
   $('#error_login').text(error_login);
   $('#login').removeClass('has-error');
  }
  }

}

  if($.trim($('#password').val()).length == 0)
  {
   error_password = 'Mot de passe requis';
   $('#error_password').text(error_password);
   $('#password').addClass('has-error');
  }
  else
  {
   error_password = '';
   $('#error_password').text(error_password);
   $('#password').removeClass('has-error');
  }

  if(error_login != '' || error_password != '')
  {
   return false;
  }
  else
  {
   $('#btn_login_details').attr("disabled", "disabled");
   $(document).css('cursor', 'prgress');
   $("#register_form").submit();
  }
 
});
</script>
 </body>
</html>