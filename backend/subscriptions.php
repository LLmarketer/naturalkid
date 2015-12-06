<?php
    header('Access-Control-Allow-Origin: *');

    class NKSubscription {
        protected $database;//attribute change class depending on the methods
        public function __construct($url,$user,$pwd,$db)
        {//the construct inside a class is the first method that will execute when i call the class
            $this->database = new mysqli($url,$user,$pwd,$db);
            if ($this->database->connect_error) {
                echo("Sorry, I can't connect to database. Please, send your details to contact@naturalkid.co.uk");
                die("Sorry, I can't connect to database");

            }
        }

        public function writeData($name,$email,$gender){
            $this->database->query("insert into subscriptionsql(name,email,gender) values('$name','$email','$gender')");
            if ($this->database->error) {
                echo("Sorry, try again. If the problem persist please contact with the admin server.");
                die($this->database->error);
            }
            $this->database->close();
            echo 'La subscripción se realizo con exito';

        }
    }

    if(isset($_POST['action'])){
        $database = new NKSubscription ('localhost','root','prueba','naturalkid');//arguments of the class]

        switch ($_POST['action']) {//it realizes an action depending on teh content of an action
            case 'subscribe':
                if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['gender'])) {
                    $database->writeData($_POST['name'], $_POST['email'], $_POST['gender']);
                    break;
                }
        }

    }


?>