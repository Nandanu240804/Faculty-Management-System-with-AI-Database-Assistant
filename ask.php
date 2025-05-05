<?php
header('Content-Type: application/json');

// Get the raw POST data
$data = file_get_contents("php://input");

// Decode the JSON data
$data = json_decode($data, true);

// Extract the question from the data
$question = $data['question'] ?? '';

// Validate the question
if (empty($question)) {
    echo json_encode(['answer' => 'Please provide a valid question.']);
    exit;
}

// Flask API URL
$api_url = 'http://127.0.0.1:5000/query';

// Prepare the request options
$options = [
    'http' => [
        'header' => "Content-Type: application/json\r\n",
        'method' => 'POST',
        'content' => json_encode(['question' => $question]),
    ],
];

// Create a stream context
$context = stream_context_create($options);

// Send the request to the Flask backend
$response = file_get_contents($api_url, false, $context);

// Handle errors in the response
if ($response === false) {
    echo json_encode(['answer' => 'Error: Unable to connect to the AI service.']);
    exit;
}

// Return the response from the Flask backend
echo $response;
?>