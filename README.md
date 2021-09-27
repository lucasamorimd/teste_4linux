## API-TESTE 4LINUX

**Instruções para rodar a aplicação**
## Comandos
- docker-compose up -d --build
- docker-compose run zf composer install
## Configurações
- Na imagem da api já sobe um banco de dados mysql
- docker exec -it db-server /bin/sh
- mysql -u root
- colar o dump do banco.
- Dump do banco de dados contido no diretório data/4linux.sql
- entrar no diretório vendor/zendframework/zend-mvc/src/Controller/AbstractController.php
- Apagar o trigger_error (linha 251 até a linha 258)
- para testar, abrir http://localhost:8081/api/agendamento
- deverá retornar um json (provavelmente com a mensagem "Nenhum agendamento encontrado")

## endpoints
**Lista de todos os agendamentos**
- (GET) /api/agendamento 

**Seleciona o agendamento por ID**
- (GET) /api/agendamento/{id} 

**Salva o agendamento enviado**
- (POST) /api/agendamento  

**Lista todos os consultores**
- (GET) /api/consultores 

**Seleciona consultor por ID**
- (GET) /api/consultores/{id} 

**Lista todos os serviços**
- (GET) /api/servicos 

**Seleciona serviço por ID**
- (GET) /api/servicos/{id} 

**Seleciona todos os serviços do consultor enviado**
- (GET) /api/servicos-consultor/{id_consultor} 

Para fazer uma busca utilizando outra coluna da tabela, basta modificar o dado enviado nos endpoints de
seleção por ID para {dado.nome_da_coluna}. Observação: Não funcionará com e-mail devido ao . contido nos endereços de email.



