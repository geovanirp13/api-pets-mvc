# API Pets MVC

Neste projeto foi desenvolvida uma API que permite a realização de cadastro, listagem, edição e exclusão de usuários e pets.

## Métodos
Requisições para a API devem seguir os padrões:
| Método | Descrição |
|---|---|
| `GET` | Retorna informações de um ou mais registros. |
| `POST` | Utilizado para criar um novo registro. |
| `PUT` | Atualiza dados de um registro ou altera sua situação. |
| `DELETE` | Remove um registro do sistema. |


## Respostas

| Código | Descrição |
|---|---|
| `200` | Requisição executada com sucesso (success).|
| `400` | Erros de validação ou os campos informados não existem no sistema.|
| `401` | Dados de acesso inválidos.|
| `404` | Registro pesquisado não encontrado (Not found).|
| `405` | Método não implementado.|
| `410` | Registro pesquisado foi apagado do sistema e não esta mais disponível.|
| `422` | Dados informados estão fora do escopo definido para o campo.|
| `429` | Número máximo de requisições atingido. (*aguarde alguns segundos e tente novamente*)|

### Cadastrar Usuário - (POST) - http://127.0.0.1:8000/api/users

+ Request (application/json)

+ Parameters
  {
    "name": "Usuário Teste",
    "email": "usuarioteste@gmail.com",
    "password":"abc@1234",
    "zipcode":"17620005",
    "number": "1010"
  }

+ Response 200 (application/json)
[
  {
    "id": 25,
    "name": "Usuário Teste",
    "email": "usuarioteste@gmail.com",
    "zipcode": "17620005",
    "address": "Avenida Aristides Dinamarco - lado par ",
    "neighborhood": "Centro(Parnaso) ",
    "city": "Tupã",
    "state": "SP ",
    "number": "1010"
  }
]

### Listar Usuários - (GET) - http://127.0.0.1:8000/api/users
+ Request No Body

+ Response 200 (application/json)
{
  "id": 25,
  "name": "Usuário Teste",
  "email": "usuarioteste@gmail.com",
  "zipcode": "17620005",
  "address": "Avenida Aristides Dinamarco - lado par ",
  "neighborhood": "Centro(Parnaso) ",
  "city": "Tupã",
  "state": "SP ",
  "number": "1010"
}

### Listar Usuário Especifico - (GET) - http://127.0.0.1:8000/api/users/{id}
+ Request (id)

+ Response 200 (application/json)
{
  "id": 25,
  "name": "Usuário Teste",
  "email": "usuarioteste@gmail.com",
  "zipcode": "17620005",
  "address": "Avenida Aristides Dinamarco - lado par ",
  "neighborhood": "Centro(Parnaso) ",
  "city": "Tupã",
  "state": "SP ",
  "number": "1010"
}

### Editar Usuário - (PUT) - http://127.0.0.1:8000/api/users/{25}
+ Request
{
  "name": "Usuário Teste Alteração",
  "email": "usuarioteste@gmail.com",
  "password":"12345678",
  "zipcode":"17601000",
  "number": "2000"
}

+ Response 200 (application/json)
{
  "id": 25,
  "name": "Usuário Teste Alteração",
  "email": "usuarioteste@gmail.com",
  "zipcode": "17601000",
  "address": "Avenida Tamoios - até 890\/891 ",
  "neighborhood": "Centro ",
  "city": "Tupã",
  "state": "SP ",
  "number": "2000"
}

### Excluir Usuário - (DELETE) - http://127.0.0.1:8000/api/users/{id}
+ Request (id)

+ Response 200 (application/json)
{
  "msg": "Usuário deletado com sucesso!"
}

### Cadastrar Pet - (POST) - http://127.0.0.1:8000/api/pets
+ Request
{
	"name": "Beethoven",
	"description": "Chachorro",
	"age": 5,
	"user_id": 26
}

+ Response 200 (application/json)
{
  "id": 12,
  "name": "Beethoven",
  "description": "Chachorro",
  "age": 5,
  "user": {
    "id": 26,
    "name": "Usuário Teste",
    "email": "usuarioteste@gmail.com",
    "zipcode": "17620005",
    "address": "Avenida Aristides Dinamarco - lado par ",
    "neighborhood": "Centro(Parnaso) ",
    "city": "Tupã",
    "state": "SP ",
    "number": "1010"
  }
}

### Listar Pets - (GET) - http://127.0.0.1:8000/api/pets
+ Request
No Body

+ Response 200 (application/json)
[
  {
    "id": 12,
    "name": "Beethoven",
    "description": "Chachorro",
    "age": 5,
    "user": {
      "id": 26,
      "name": "Usuário Teste",
      "email": "usuarioteste@gmail.com",
      "zipcode": "17620005",
      "address": "Avenida Aristides Dinamarco - lado par ",
      "neighborhood": "Centro(Parnaso) ",
      "city": "Tupã",
      "state": "SP ",
      "number": "1010"
    }
  }
]

### Listar Pet Especifico - (GET) - http://127.0.0.1:8000/api/pets/{id}
+ Request (id)

+ Response 200 (application/json)
{
  "id": 12,
  "name": "Beethoven",
  "description": "Chachorro",
  "age": 5,
  "user": {
    "id": 26,
    "name": "Usuário Teste",
    "email": "usuarioteste@gmail.com",
    "zipcode": "17620005",
    "address": "Avenida Aristides Dinamarco - lado par ",
    "neighborhood": "Centro(Parnaso) ",
    "city": "Tupã",
    "state": "SP ",
    "number": "1010"
  }
}

### Editar Pet - (PUT) - http://127.0.0.1:8000/api/pets/{id}
+ Request
{
	"name": "Beethoven",
	"description": "Chachorro",
	"age": 10,
	"user_id": 27
}

+ Response 200 (application/json)
{
  "id": 12,
  "name": "Beethoven",
  "description": "Chachorro",
  "age": 10,
  "user": {
    "id": 27,
    "name": "Usuário de Souza Silva",
    "email": "usuariosilva@gmail.com",
    "zipcode": "17600010",
    "address": "Rua Coroados - até 1600\/1601 ",
    "neighborhood": "Centro ",
    "city": "Tupã",
    "state": "SP ",
    "number": "154"
  }
}

### Excluir Pet  - (DELETE) - http://127.0.0.1:8000/api/pets/{id}
+ Request
No Body

+ Response 200 (application/json)
{
  "msg": "Pet deletado com sucesso!"
}






