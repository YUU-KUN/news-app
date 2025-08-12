<?php
header('Content-Type: application/json');

$apiKey = "5097dd75f1374bf8af71d445ee2a5a34";
$url = "https://newsapi.org/v2/top-headlines?category=technology&language=en&pageSize=3&apiKey={$apiKey}";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

if ($response === false) {
    echo json_encode(["status" => false, "message" => "Failed to fetch data"]);
    exit;
}

$data = json_decode($response, true);
if (!isset($data['articles'])) {
    echo json_encode(["status" => false, "message" => "Invalid API response"]);
    exit;
}

$articles = array_map(function($article) {
    return [
        'title' => $article['title'],
        'description' => $article['description'],
        'url' => $article['url'],
        'image' => $article['urlToImage'],
        'source' => $article['source']['name'],
        'author' => $article['author'],
        'publishedAt' => $article['publishedAt'],
    ];
}, $data['articles']);

echo json_encode([
    "status" => true,
    "data" => $articles
]);
