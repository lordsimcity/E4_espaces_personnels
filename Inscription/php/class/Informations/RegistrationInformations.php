<?php

namespace Registration\Informations;


/**
 * La classe RegistrationInformations permettra le stockage des informations de l'utilisteur qui
 * souhaite s'inscrire.
 */


class RegistrationInformations {

    // Attributs de la class
    private $_lastName;
    private $_firstName;
    private $_userEmail;
    private $_password;

    // Constructeur de la classe
    public function __construct(array $data) {

        $this->hydrate($data);

    }

    /* 
    * La fonction hydrate permet d'hydrater les attributs de la classe en appelant des méthodes 
    * par l'appel de méthodes spécialisées.
    */

    protected function hydrate(array $data) : bool {

        /*
        * Vérification du nombre d'informations passées en paramètre (doit être égal au nombre d'attribut).
        */
        if (count($data) == 4) {

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

    // Setters de la classe RegistrationInformations

    protected function setLastName($value) : void {

        if(is_string($value) && strlen($value) <= 45) {

            $this->_lastName = $value;

        }

    }

    protected function setFirstName($value) : void {

        if(is_string($value) && strlen($value) <= 45) {

            $this->_firstName = $value;

        }

    }

    protected function setUserEmail($value) : void {

        if(is_string($value) && strlen($value) <= 45) {

            $this->_userEmail = $value;

        }

    }

    protected function setPassword($value) : void {

        if(is_string($value) && strlen($value) <= 16) {

            $this->_password = $value;

        }

    }

    // ==================================================

    // Getters de la classe RegistrationInformations

    public function getLastName() {

        return $this->_lastName;

    }

    public function getFirstName() {

        return $this->_firstName;

    }

    public function getUserEmail() {

        return $this->_userEmail;

    }

    public function getPassword() {

        return $this->_password;

    }

    // ==================================================

}