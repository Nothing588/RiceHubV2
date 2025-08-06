<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newApp = [
        "name" => $_POST['name'],
        "bundleIdentifier" => $_POST['bundleIdentifier'],
        "developerName" => "Community",
        "version" => $_POST['version'],
        "versionDate" => date("c"),
        "downloadURL" => $_POST['downloadURL'],
        "iconURL" => $_POST['iconURL'] ?? "",
        "localizedDescription" => [
            "en" => $_POST['description'] ?? "Submitted by the community."
        ]
    ];

    $jsonFile = __DIR__ . '/json/community.json';

    
    if (!file_exists(dirname($jsonFile))) {
        mkdir(dirname($jsonFile), 0755, true);
    }

    
    if (!file_exists($jsonFile)) {
        file_put_contents($jsonFile, json_encode([], JSON_PRETTY_PRINT));
    }

    $apps = json_decode(file_get_contents($jsonFile), true);

  
    foreach ($apps as $app) {
        if ($app['bundleIdentifier'] === $newApp['bundleIdentifier']) {
            echo "❌ App with this bundle ID already exists.";
            exit;
        }
    }

    $apps[] = $newApp;

    file_put_contents($jsonFile, json_encode($apps, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

    echo "✅ App submitted successfully. <a href='submit.html'>Submit another</a>";
} else {
    echo "❌ Invalid request.";
}
?>
