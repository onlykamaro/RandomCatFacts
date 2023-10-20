<?php

declare(strict_types=1);

class CatFacts
{
    private string $api = "https://catfact.ninja/fact";

    public function __construct()
    {
    }

    public function fetchData(): ?array
    {
        try {
            $response = file_get_contents($this->api);
            if (!$response) {
                throw new Exception("Failed to fetch data");
            }

            $data = json_decode($response, true);
            return $data;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function displayFacts(): void
    {
        $data = $this->fetchData();
        if ($data) {
            $fact = $data['fact'];
            if ($fact) {
                echo "Random Fact About Cats: " . PHP_EOL;
                echo "Fact: " . $fact . PHP_EOL;
            } else {
                echo "No fact found" . PHP_EOL;
            }
        } else {
            echo "Unable to fetch data" . PHP_EOL;
        }
    }
}

$catFacts = new CatFacts();
$catFacts->displayFacts();