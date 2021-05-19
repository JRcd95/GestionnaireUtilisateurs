<?php
require_once 'GroupsManager.php';
require_once 'UsersManager.php';
class Register {

    private $bdd;

    public function __construct() {
        $chaineCnx = 'mysql:host=localhost;dbname=users';
        $this->bdd = new PDO($chaineCnx, 'root', '', [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
    }

    public function listUsers() {
        $bdd = $this->bdd;
        $query = "SELECT * FROM users;";
        $req = $bdd->prepare($query);
        $req->execute();

        while ($row = $req->fetch(PDO::FETCH_ASSOC)){
            $user = new Users();
            $user->setFirstName($row['firstName']);
            $user->setLastName($row['lastName']);

            $users[] = $user;
        }

        return $users;
    }

    public function listGroups() {
            $bdd = $this->bdd;
            $query = "SELECT * FROM groups;";
            $req = $bdd->prepare($query);
            $req->execute();

            while ($row = $req->fetch(PDO::FETCH_ASSOC)){
                $group = new Groups();
                $group->setName($row['name']);

                $groups[] = $group;
            }

        return $groups;
    }

    public function addUsers(){
        if (isset($_POST["firstName"], $_POST["lastName"]) && !empty($_POST["firstName"]) && !empty($_POST["lastName"])) {

                $bdd = $this->bdd;
                $query = "INSERT INTO users VALUES(:firstName, :lastName)";
                $stat = $bdd->prepare($query);
                $stat->bindValue(':firstName', $_POST['firstName'], PDO::PARAM_STR);
                $stat->bindValue(':lastName', $_POST['lastName'], PDO::PARAM_STR);

                $stat->execute();

                Header("Location:app.php");

        } else {
            Header("Location:app.php");
        }
    }




}