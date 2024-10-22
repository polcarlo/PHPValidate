<?php
function validate_id($id) {
    if (empty($id)) {
        return "Error required";
    } elseif (!is_numeric($id)) {
        return "Error format";
    } else {
        return $id;
    }
}

function validate_name($name) {
    if (empty($name)) {
        return "Error required";
    } elseif (mb_strlen($name) > 100) {
        return "Error limit over";
    } else {
        return $name;
    }
}

function validate_birthday($birthday) {
    if (empty($birthday)) {
        return "Error required";
    } else {
        if (preg_match('/^\d{4}[\/-]\d{2}[\/-]\d{2}$/', $birthday)) {
            $separator = strpos($birthday, '/') !== false ? '/' : '-';
            $parts = explode($separator, $birthday);
            if (checkdate((int)$parts[1], (int)$parts[2], (int)$parts[0])) {
                return $birthday;
            } else {
                return "Error format";
            }
        } else {
            return "Error format";
        }
    }
}

function validate_gender($gender) {
    $gender = trim($gender);
    if ($gender === '') {
        return "";
    }
    $gender_lower = strtolower($gender);
    if ($gender_lower == 'male' || $gender_lower == 'female') {
        return $gender;
    } else {
        return "Error format";
    }
}

function validate_phone_number($phone_number) {
    if (empty($phone_number)) {
        return "Error required";
    } else {
        $digits_only = str_replace('-', '', $phone_number);
        if (preg_match('/^\d{10,11}$/', $digits_only)) {
            if (preg_match('/^\d{10,11}$|^\d{2,3}-\d{3,4}-\d{4}$/', $phone_number)) {
                return $phone_number;
            } else {
                return "Error format";
            }
        } else {
            return "Error format";
        }
    }
}
?>
