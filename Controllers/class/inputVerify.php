<?php
function sanitizeArray($data) {
    $sanitizedData = array();

    foreach ($data as $key => $value) {
        if (is_string($value)) {
            $sanitizedValue = htmlentities(trim(strip_tags(stripslashes($value))), ENT_NOQUOTES, "UTF-8");
        } else {
            $sanitizedValue = $value;
        }
        $sanitizedData[$key] = $sanitizedValue;
    }

    return $sanitizedData;
}

?>
