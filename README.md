# Lista Pokémon

Aplicação PHP que exibe os 151 pokémons da primeira geração em um grid interativo.

## Tecnologias

- PHP 8.2
- Apache
- PokeAPI

## Como executar

```bash
docker-compose up --build
```

Acesse: http://localhost:8080

## Deploy

A aplicação está disponível online em: https://pokemon-lista-erickmiglio.vercel.app/

## Estrutura

- `index.php` - Página principal com a lista de pokémons
- `Dockerfile` - Configuração do container PHP
- `docker-compose.yml` - Orquestração dos serviços
