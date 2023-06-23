<?php
// user_behavior_data.php

// Simulated user behavior data
$userBehaviorData = [
  [
    'date' => '2023-06-01',
    'scrollRate' => 80,
    'engagementTime' => 120,
    'clickThroughRate' => 0.25,
    'pagesVisited' => 5,
  ],
  [
    'date' => '2023-06-02',
    'scrollRate' => 75,
    'engagementTime' => 100,
    'clickThroughRate' => 0.35,
    'pagesVisited' => 4,
  ],
  // Add more data entries as needed
];

// Encode data as JSON and send the response
header('Content-Type: application/json');
echo json_encode($userBehaviorData);
