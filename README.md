## Rodar aplicação

```sh
$ npm install
$ npm run dev
$ php artisan migrate
$ php artisan serve
```

## Outras execuções

- Criando uma tabela de jobs para filas (queue)
```sh
$ php artisan queue:table 
```
OBS: execute as migrations posteriormente


- Pra processar jobs pendentes (em desenvolvimento seria: queue:listen, mas ele não fica rodando pra sempre)
```sh
$ php artisan queue:work
```
- Executando jobs com 2 tentativas consecutivas de falhas (--tries:2) e (se quiser) um delay entre a execução de um job para outro (--delay=10).
```sh
$ php artisan queue:work --tries=2
```

- Executando jobs que falharam
-- Encontre a lista de jobs que falharam e anote o id
```sh
$ php artisan queue:failed
```

- Readicione o job na fila para processamento (depois execute o queue:work ou queue:listen novamente).
```sh
$ php artisan queue:retry <id-do-job>
```

--------------------------------------------------------

- Criando um Ouvinte de Evento
```sh
$ php artisan make:listener <nome-do-listener>
```

- Criando um Evento
```sh
$ php artisan make:event <nome-do-evento>
```
