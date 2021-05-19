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

        $query = "SELECT * FROM users;";
        $req = $this->bdd->prepare($query);
        $req->execute();

        while ($row = $req->fetch(PDO::FETCH_ASSOC)){
            $user = new Users();
            $user->setFirstName($row['firstName']);
            $user->setLastName($row['lastName']);
            $user->setGroup($row['nameGroup']);

            $users[] = $user;
        }

        return $users;
    }

    public function listGroups() {
            $query = "SELECT * FROM groups;";
            $req = $this->bdd->prepare($query);
            $req->execute();

            while ($row = $req->fetch(PDO::FETCH_ASSOC)){
                $group = new Groups();
                $group->setName($row['name']);

                $groups[] = $group;
            }

        return $groups;
    }

    public function addUsers(){

        $query = "INSERT INTO users VALUES(:firstName, :lastName, :nameGroup)";
        $stat = $this->bdd->prepare($query);
        $stat->bindValue(':firstName', $_POST['firstName'], PDO::PARAM_STR);
        $stat->bindValue(':lastName', $_POST['lastName'], PDO::PARAM_STR);
        $stat->bindValue(':nameGroup', $_POST['nameGroup'], PDO::PARAM_STR);

        $stat->execute();

    }

    public function addGroups($name){
        $query = "INSERT INTO groups VALUES(:name)";
        $stat = $this->bdd->prepare($query);
        $stat->bindValue(':name', $name, PDO::PARAM_STR);

        $stat->execute();
    }




}