<?php
require_once __DIR__ . '/bootstrap.php';

echo "Testing Validation...\n";

$data = [
    'email' => 'invalid-email',
    'name' => 'A'
];
$rules = [
    'email' => 'required|email',
    'name' => 'required|string|min:2'
];

$validator = validator($data, $rules);

if ($validator->fails()) {
    echo "Validation correctly failed.\n";
    print_r($validator->errors()->toArray());
} else {
    echo "Validation incorrectly passed.\n";
}

$data2 = [
    'email' => 'valid@example.com',
    'name' => 'Valid Name'
];

$validator2 = validator($data2, $rules);
if ($validator2->passes()) {
    echo "Validation correctly passed.\n";
} else {
    echo "Validation incorrectly failed.\n";
    print_r($validator2->errors()->toArray());
}
