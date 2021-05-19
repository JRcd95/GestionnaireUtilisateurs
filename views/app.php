<?php
    require_once '../classes/RegisterManager.php';

    $register = new Register();

    if (isset($_POST["firstName"], $_POST["lastName"]) && !empty($_POST["firstName"]) && !empty($_POST["lastName"])) {
        $register->addUsers();
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
                           <select class="form-control" name="nameGroup">
                               <?php
                                   $groups= $register->listGroups();
                                   foreach($groups as $g) {
                                       ?>
                                       <option><?= $g->getName()?></option>
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
                           <th>Groupe</th>
                       </tr>
                       <?php
                           $users = $register->listUsers();
                           foreach($users as $u) {
                               ?>
                               <tr>
                                   <td><?= $u->getLastName()?></td>
                                   <td><?= $u->getFirstName()?></td>
                                   <td><?= $u->getGroup()?></td>

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