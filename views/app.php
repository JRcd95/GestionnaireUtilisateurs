<?php
    require_once '../database/connection.php';

if (isset($_POST["firstName"], $_POST["lastName"]) && !empty($_POST["firstName"]) && !empty($_POST["lastName"])) {

    $query = "INSERT INTO users VALUES(:firstName, :lastName)";
    $stat = $bdd->prepare($query);
    $stat->bindValue(':firstName', $_POST['firstName'], PDO::PARAM_STR);
    $stat->bindValue(':lastName', $_POST['lastName'], PDO::PARAM_STR);

    $stat->execute();

}
    ?>
<!DOCTYPE html>
<html>
   <head>
       <meta charset="UTF-8">
       <title>Gestionnaires Utilisateurs</title>
       <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
       <link href="../assets/css/style.css" rel="stylesheet">

   </head>
   <body>
       <nav class="navbar">
           <span class="navbar-brand mb-0 h1">Gestionnaires Utilisateurs</span>
       </nav>



       <div class="container">
           <div class="row">
               <div class="card">
                   <h3>Inscription</h3>
                   <form method="POST">
                       <div class="form-group">
                           <label for="nomUser">Nom</label>
                           <input type="text" class="form-control" id="nomUser" name="lastName" placeholder="Nom utilisateur">
                       </div>
                       <div class="form-group">
                           <label for="prenomUser">Prénom</label>
                           <input type="text" class="form-control" id="prenomUser" name="firstName" aria-describedby="emailHelp" placeholder="Prénom utilisateur">
                       </div>
                       <div class="form-group">
                           <label for="groupUser">Groupes</label>
                           <select class="form-control">
                               <?php
                                   $groups = $bdd->query("SELECT * FROM groups;")->fetchAll();
                                   foreach($groups as $g) {
                                       ?>
                                       <option><?= $g['name']?></option>
                                       <?php
                                   }
                               ?>
                           </select>
                       </div>
                       <button type="submit" class="btn " >Enregistrer</button>
                   </form>
               </div>
           </div>
       </div>

       <div class="container">
           <div class="row">
               <div class="card">
                   <h3>Liste des inscrits</h3>
                   <table>
                       <tr>
                           <th>Nom</th>
                           <th>Prénom</th>
                       </tr>
                       <?php
                           $users = $bdd->query("SELECT * FROM users;")->fetchAll();
                           foreach($users as $u) {
                               ?>
                               <tr>
                                   <td><?= $u['lastName']?></td>
                                   <td><?= $u['firstName']?></td>

                               </tr>
                               <?php
                           }
                       ?>
                   </table>
               </div>
           </div>
       </div>
       <script src="../assets/js/bootstrap.bundle.min.js" ></script>
   </body>
</html>