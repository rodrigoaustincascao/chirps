<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Tecnologias utilizadas:
- Stack TALL: Tailwind, Alpine, Laravel & Livewire,
- Docker e DevContainer para conteinerizar a aplicação e o banco de dados;

# Instruções para execução:
- Instale a extensão [Remote Containers](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers) para VSCODE e abra o projeto utilizando o **devcontainer**.
    - Open a Remote Window -> Reopen in Container;
        - Durante esse processo as imagens serão baixadas do Docker Hub;

**No terminal do container da aplicação:**
- Crie o arquivo de variáveis de ambiente a partir do exemplo.
```bash
cp .env.example .env 
```

- Ajuste as variáveis do novo arquivo `.env` .

```bash
# Alterar para
APP_DEBUG=true
APP_ENV=local
```

- Instale as dependências
```bash
composer start
```

- Gere a chave de segurança.
```bash
php artisan key:generate
```

- Execute as migrations
```bash
php artisan migrate --seed
```

- Inicializar o servidor
```bash
yarn dev
```
**Pronto!** 
 - App http://localhost:8081
