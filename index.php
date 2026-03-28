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
    <div class="pokemon-grid" id="pokemon-grid"></div>

    <script>
        async function loadPokemons() {
            try {
                const response = await fetch('https://pokeapi.co/api/v2/pokemon?limit=151');
                const data = await response.json();
                
                const grid = document.getElementById('pokemon-grid');
                
                for (const pokemon of data.results) {
                    const pokemonResponse = await fetch(pokemon.url);
                    const pokemonData = await pokemonResponse.json();
                    
                    const card = document.createElement('div');
                    card.className = 'pokemon-card';
                    card.innerHTML = `
                        <div class="id">#${String(pokemonData.id).padStart(3, '0')}</div>
                        <img src="${pokemonData.sprites.front_default}" alt="${pokemon.name}">
                        <div class="name">${pokemon.name}</div>
                    `;
                    grid.appendChild(card);
                }
            } catch (error) {
                console.error('Erro ao carregar Pokémon:', error);
            }
        }
        
        loadPokemons();
    </script>
</body>
</html>
