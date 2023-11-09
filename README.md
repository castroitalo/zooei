# Zooei (EM DESEMVOLVIMENTO)
O maior imageboard brasileiro. Nossa missão é libertar as pessoas da régua moral das big techs.

![zooei](https://github.com/devcastroitalo/zooei/blob/main/public/assets/images/zooei.png)

### Pré-requisito
- [Docker](https://www.docker.com/) instalado.

### Instalando o Zooei
- Docker:
    - Construa a imagem docker: `sudo docker build -t zooei/stable:1.0`
    - Inicie o container docker com o docker compose: `sudo docker composer up -d`
- Iniciando o projeto:
    - Entre no banco de dados do projeto e execute os scripts SQL para criação do bando de dados e a inserção de dados base.
    - Entre no container docker: `sudo docker container exec -it zooei-web-1 bash`
    - Instale as dependências do projeto com o composer: `composer update`
    - Crie um arquivo chamado **.env** na raiz do projeto usando o arquivo **.env.template** e preencha os campos.

### Executando testes
Para executar os testes do zooei, basta rodar o seguinte comando:

```
vendor/bin/phpunit --testsuit unit --colors --testdox tests/
```

Para executar um teste de um arquivo específico basta informar o arquivo ao final do comando (no exemplo abaixo é executado os testes para a classe Boardodel):

```
vendor/bin/phpunit --testsuit unit --colors --testdox tests/src/models/BoardModelTest.php
```

### Para contribuir
Quer contribuir para o projeto? Leia [CONTRIBUTING](https://github.com/devcastroitalo/zooei/blob/main/CONTRIBUTING.md)

### Autores
- [Italo Mateus de Castro](https://github.com/devcastroitalo)

### Licença
Esse projeto usa a licença [GPLv3](https://www.gnu.org/licenses/quick-guide-gplv3.pt-br.html) - Veja [LICENSE](https://github.com/devcastroitalo/zooei/blob/main/LICENSE) para mais detalhes.
