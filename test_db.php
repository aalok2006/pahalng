<?php
require_once __DIR__ . '/bootstrap.php';
use PahalNGO\ContactSubmission;

echo "Testing Eloquent...\n";

try {
    $submission = ContactSubmission::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'message' => 'This is a test message from script.',
        'ip_address' => '127.0.0.1',
        'submitted_at' => date('Y-m-d H:i:s')
    ]);
    
    if ($submission->exists) {
        echo "Successfully inserted contact submission with ID: " . $submission->id . "\n";
    } else {
        echo "Failed to insert.\n";
    }

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
