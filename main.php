<?php
include 'validation.php';

$csvFile = 'writers.csv';

if (!file_exists($csvFile)) {
    echo "CSV file not found: $csvFile" . PHP_EOL;
    exit(1);
}

if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    $headers = fgetcsv($handle);

    if ($headers === FALSE) {
        echo "CSV file is empty or invalid." . PHP_EOL;
        fclose($handle);
        exit(1);
    }

    while (($row = fgetcsv($handle)) !== FALSE) {
        $data = array_combine($headers, $row);

        $validatedData = [];

        foreach ($headers as $field) {
            $value = isset($data[$field]) ? $data[$field] : '';

            switch ($field) {
                case 'id':
                    $validatedData[] = validate_id($value);
                    break;
                case 'name':
                    $validatedData[] = validate_name($value);
                    break;
                case 'birthday':
                    $validatedData[] = validate_birthday($value);
                    break;
                case 'gender':
                    $validatedData[] = validate_gender($value);
                    break;
                case 'Phone-number':
                    $validatedData[] = validate_phone_number($value);
                    break;
                default:
                    $validatedData[] = $value;
            }
        }

        echo implode(',', $validatedData) . PHP_EOL;
    }

    fclose($handle);
} else {
    echo "Unable to open CSV file: $csvFile" . PHP_EOL;
    exit(1);
}
?>
