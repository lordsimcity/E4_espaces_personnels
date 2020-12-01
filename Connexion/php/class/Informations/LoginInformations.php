<?php

namespace Connection\ConnectionChecks;

class LoginInformations {

    private $_userEmail;
    private $_userPassword;

    public function __construct(array $data) {

        $this->hydrate($data);

    }

    protected function hydrate(array $data) : bool {

        /*
        * Vérification du nombre d'informations passées en paramètre (= au nombre d'attribut).
        */
        if (count($data) == 2) {

            foreach($data as $key => $value) {

                $method = "set".ucfirst($key);
                
                if (method_exists($this,$method)) {
                    $this->$method($value);
                }

            }

            return true;

        } else {

            return false;

        } 

    }

    // Setters de la classe LoginInformations

    protected function setUserEmail($value) : void {

        if(is_string($value) && strlen($value) <= 45) {

            $this->_userEmail = $value;

        }

    }

    protected function setUserPassword($value) : void {

        if(is_string($value) && strlen($value) <= 16) {

            $this->_userPassword = $value;

        }

    }

    // ==================================================

    // Getters de la classe LoginInformations

    public function getUserEmail() {

        return $this->_userEmail;

    }

    public function getUserPassword() {

        return $this->_userPassword;

    }

    // ==================================================

}