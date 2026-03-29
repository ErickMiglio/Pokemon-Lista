<?php
function getPokemonData($limit = 151) {
    $pokemons = [];
    $apiUrl = 'https://pokeapi.co/api/v2/pokemon?limit=' . $limit;
    
    $response = @file_get_contents($apiUrl);
    if ($response === false) {
        return [];
    }
    
    $data = json_decode($response, true);
    if (!isset($data['results'])) {
        return [];
    }
    
    foreach ($data['results'] as $pokemon) {
        $pokemonResponse = @file_get_contents($pokemon['url']);
        if ($pokemonResponse === false) {
            continue;
        }
        
        $pokemonData = json_decode($pokemonResponse, true);
        if (!$pokemonData) {
            continue;
        }
        
        $pokemons[] = [
            'id' => $pokemonData['id'],
            'name' => $pokemonData['name'],
            'image' => $pokemonData['sprites']['front_default']
        ];
    }
    
    return $pokemons;
}

$pokemons = getPokemonData();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primeira Geração de Pokémon</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ff5959 0%, #ffca3a 50%, #8ac926 100%);
            min-height: 100vh;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            margin-bottom: 30px;
            font-size: 2.5em;
        }
        .pokemon-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .pokemon-card {
            background: white;
            border-radius: 15px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
            transition: transform 0.2s;
        }
        .pokemon-card:hover {
            transform: scale(1.05);
        }
        .pokemon-card img {
            width: 96px;
            height: 96px;
        }
        .pokemon-card .name {
            margin-top: 10px;
            font-weight: bold;
            color: #333;
            text-transform: capitalize;
        }
        .pokemon-card .id {
            color: #888;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <h1>Primeira Geração de Pokémon</h1>
    <div class="pokemon-grid">
        <?php foreach ($pokemons as $pokemon): ?>
            <div class="pokemon-card">
                <div class="id">#<?php echo str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT); ?></div>
                <img src="<?php echo htmlspecialchars($pokemon['image']); ?>" alt="<?php echo htmlspecialchars($pokemon['name']); ?>">
                <div class="name"><?php echo htmlspecialchars($pokemon['name']); ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
