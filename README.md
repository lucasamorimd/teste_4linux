## API-TESTE 4LINUX

**Instruções**
## teste_api
-docker-compose up -d --build
-docker-compose run zf composer install
-Na imagem da api já sobe um banco de dados mysql
-Basta acessar e criar o banco de dados
-Dump do banco de dados contido no diretório teste_api/data/4linux.sql
-No diretório teste_api/config/autoload/local.php inserir o user_name como 'root'
-para testar abrir http://localhost:8081/api/agendamento
-deverá retornar um json (provavelmente com a mensagem "Nenhum agendamento encontrado")

## endpoints
Lista de todos os agendamentos
-(GET) /api/agendamento 

Seleciona o agendamento por ID
-(GET) /api/agendamento/{id} 

Salva o agendamento enviado
-(POST) /api/agendamento  

Lista todos os consultores
-(GET) /api/consultores 

Seleciona consultor por ID
-(GET) /api/consultores/{id} 

Lista todos os serviços
-(GET) /api/servicos 

Seleciona serviço por ID
-(GET) /api/servicos/{id} 

Seleciona todos os serviços do consultor enviado
-(GET) /api/servicos-consultor/{id_consultor} 

Para fazer uma busca utilizando outra coluna da tabela, basta modificar o dado enviado nos endpoints de
seleção por ID para {dado.nome_da_coluna}. Observação: Não funcionará com e-mail devido ao . contido nos endereços de email.



