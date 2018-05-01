<?php
    $usernamePattern = "/^[0-9a-zA-Z\s]+$/";
    $passwordPattern = "/^[0-9a-zA-Z]+$/";
    $maxPasswordLength = 20;
    $maxUsernameLength = 100;
    $maxMessageLength = 1000;
    $maxSubjectLength = 500;
    // check the presence of the input value
    function has_presence($value) {
        $trimmed_value = trim($value);
        return isset($trimmed_value) && $trimmed_value !== "";
    }

    // no limitation on the minimum length
    // check the length of the input value
    function normalLength($value, $maxLength) {
        if (has_presence($value) && (strlen($value) <= (int)$maxLength)) {
            return true;
        } else {
            return false;
        }
    }

    // escape SQL key words
    function escapeSQL($connect, $value) {
        $value = mysqli_real_escape_string($connect, $value);
        return $value;
    }
?>
