<?php

namespace Components;

use Components\DbConnect;
use PDO;

/**
 * VALIDATOR
 * 
 * <p>for using the single validator method just create a new Validator Entity
 *  and call required method with $validatorObj->functionName($param) </p>
 * 
 * <p>for using the validator by validate() method, create a new Validator Entity
 * and call to the $validatorObj->validate($arrayWithRulesForValidation)</p>
 * 
 * <p>to make the validator work correctly, pass the arguments in the strict order:
 * [property name, property value, validator function name, error message, parameters[]]
 * 
 * <p>ALL THE FUNCTIONS RETURN 2 IF THERE WERE NO ERRORS DURING VALIDATION AND RETURN THE 
 * ERROR MESSAGE IF THE ERROR HAD HAPPENED BEFORE</p>
 *
 * @author suray
 */
class Validator {
    
    public function errorRequired(string $errText, string $string) {
        return ($string == '') ? $errText : 2;
    }
    
    public function errorMinLength(string $errText, string $string, int $min) {
        return (strlen($string) < $min) ? $errText : 2;
    }
    
    public function errorMaxLength(string $errText, string $string, int $max) {
        return (strlen($string) < $min) ? $errText : 2;
    }
    
    public function errorEmail(string $errText, string $email) {
        return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? 2 : $errText;
    }
    
    public function errorMatching (string $errText, string $mask, string $string) {
        return (preg_match("#$mask#", $string)) ? $errText : 2;
    }
    
    public function errorLettersAndNumbers (string $errText, string $string) {
        $mask = '([a-zA-Z0-9]+)';
        return (preg_match("#$mask#", $string)) ? $errText : 2;
    }
    
    public function errorNonIdentical (string $errText, $arg1, $arg2) {
        return ($arg1 != $arg2) ? $errText : 2;
    }
    
    public function errorUniqueFieldExcept(string $errText, $value, string $fieldToCheck, string $targetModelClass, string $fieldExcept, $valueExcept ) {
        require_once ROOT . '/models/' . $targetModelClass . '.php';
        
        $con = DbConnect::connect();
        
        $model = '\Models\\' . $targetModelClass;
              
        if($table = $model::getTable()) {
            
            $query = 'SELECT count(' . $fieldToCheck . ') FROM ' . $table . ' WHERE ' .
                    $fieldToCheck . '= :value AND ' . $fieldExcept . '!= ' .$valueExcept . ';';
            
            $sth = $con->prepare($query);
            $sth->bindValue(':value', $value);
            
            $sth->execute();
            $result = $sth->fetchColumn();
            
            return ($result>=1) ? $errText : 2;
        }
        
        return 'Unable to perform request';    
    }
    
    public function errorUniqueField(string $errText, $value, string $fieldToCheck, string $targetModelClass) {
        require_once ROOT . '/models/' . $targetModelClass . '.php';
        
        $con = DbConnect::connect();
        
        $model = '\Models\\' . $targetModelClass;
              
        if($table = $model::getTable()) {
            
            $query = 'SELECT count(' . $fieldToCheck . ') FROM ' . $table . ' WHERE ' .
                    $fieldToCheck . '= :value;';
            
            $sth = $con->prepare($query);
            $sth->bindValue(':value', $value);
            
            $sth->execute();
            $result = $sth->fetchColumn();
            
            return ($result>=1) ? $errText : 2;
        }
        
        return 'Unable to perform request';    
    }

    public function validate(array $rulesArray) {
        
        $errorArray = array();
        
        foreach ($rulesArray as $rule) {
            $countRule = count($rule);
            
            if($countRule < 4) {
                echo 'To few arguments for validator '. __METHOD__;
                return false;
            }
            
            $params = array();
            
            $params[0] = $rule[3];
            $params[1] = $rule[1];
            $propertyToCheck = $rule[0];
            $functionName = $rule[2];
            
            if($countRule > 4) {
                for($j=4;$j<$countRule;$j++) {
                    $params[] = $rule[$j];
                }
            }
            
            $result = call_user_func_array(array($this, $functionName), $params);
            
            if($result != 2) {
                $errorArray[$propertyToCheck][] = $result;
            }
            
        }
        
        return (!empty($errorArray)) ? $errorArray : 2;
    }
}
