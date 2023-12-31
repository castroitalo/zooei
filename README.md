# Zooei
Zooei é um site [imageboard](https://pt.wikipedia.org/wiki/Imageboard) onde as pessoas podem discutir interesses de forma anônima desde que não quebre nenhuma regra imposta pelo site.

![zooei](https://github.com/devcastroitalo/zooei/blob/main/miscellaneous/images/print_homepage.png)

### Pré-requisito
- [Docker](https://www.docker.com/) instalado.

### Instalando o Zooei
- Docker:
    - Construa a imagem docker: `docker build ./docker -t zooei/stable:1.0`
    - Inicie o container docker com o docker compose: `docker compose up -d`
- Iniciando o projeto:
    - Entre no banco de dados do projeto e execute os scripts SQL (localizados na pasta **miscellaneous/database**) para criação do bando de dados e a inserção de dados base.
    - Entre no container docker: `docker container exec -it zooei-web-1 bash`
    - Instale as dependências do projeto com o composer: `composer update`
    - Crie um arquivo chamado **.env** na raiz do projeto usando o arquivo **.env.template** e preencha os campos.
    - Crie os diretórios de upload:
        - Dentro do container:
            - `cd public/assets/images`
            - `mkdir posts-images`
            - `chmod 753 posts-images/`

### Executando testes
Para executar os testes do zooei, basta rodar o seguinte comando:

```
vendor/bin/phpunit --testsuit unit --colors --testdox tests/
```

Para executar um teste de um arquivo específico basta informar o arquivo ao final do comando (no exemplo abaixo é executado os testes para a classe BoardModel):

```
vendor/bin/phpunit --testsuit unit --colors --testdox tests/src/models/BoardModelTest.php
```

### Para contribuir
Quer contribuir para o projeto? Leia [CONTRIBUTING](https://github.com/devcastroitalo/zooei/blob/main/CONTRIBUTING.md)

### Autores
- [Italo Mateus de Castro](https://github.com/devcastroitalo)

### Licença
Esse projeto usa a licença [GPLv3](https://www.gnu.org/licenses/quick-guide-gplv3.pt-br.html) - Veja [LICENSE](https://github.com/devcastroitalo/zooei/blob/main/LICENSE) para mais detalhes.
