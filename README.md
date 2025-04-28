

# 📚 desafio-cadastro-cliente

Projeto de desafio técnico para desenvolvedor Full Stack (PHP / MySQL).

Criação de um módulo de cadastro de clientes utilizando **PHP puro**, **MySQL** e **Docker**.

---

## 🚀 Como rodar o projeto

### 1. Clone o repositório

```bash
git clone https://github.com/pauloflausino/desafio-cadastro-cliente.git
cd desafio-cadastro-cliente
```

---

### 2. Copie o arquivo `.env.example` para `.env` (opcional)

Se quiser usar variáveis de ambiente:

```bash
cp .env.example .env
```

---

### 3. Suba os containers com Docker

**(Certifique-se de que o Docker esteja instalado e rodando.)**

```bash
docker-compose up --build
```

- Isso vai criar dois containers:
  - Um para a aplicação PHP/Apache.
  - Um para o banco de dados MySQL.

---

### 4. Acesse o sistema

Após o Docker subir, o sistema estará disponível em:

```
http://localhost:8000/cadastro_cliente.php
```

---

### 5. Inicializar o banco de dados (criar tabela)

Execute o comando abaixo para criar a tabela `clientes` no banco:

```bash
docker exec -i desafio_mysql_db mysql -u root -psenha desafio < sql/init.sql
```

✅ Agora o banco estará pronto para uso!

---

## ✍️ Como testar o cadastro de cliente

Você pode usar **Postman** ou outro cliente HTTP.

1. Crie uma requisição **POST** para:

```
http://localhost:8000/cadastro_cliente.php
```

2. No **Body**, selecione **raw** e escolha o formato **JSON**.

3. Envie o seguinte corpo:

```json
{
  "nome": "João Silva",
  "email": "joao@example.com"
}
```

4. Você deve receber uma resposta:

```json
{
  "message": "Cliente cadastrado com sucesso!"
}
```

---

## 📦 Estrutura do projeto

```
desafio-cadastro-cliente/
├── README.md
├── .env.example
├── Dockerfile
├── docker-compose.yml
├── src/
│   └── cadastro_cliente.php
├── sql/
│   └── init.sql
```

---

## 🛡️ Considerações de Segurança

- Usado **PDO** para prevenir injeção de SQL.
- Validação básica de entrada (nome e email).
- Tratamento de erros e respostas adequadas.

---

## 👨‍💻 Tecnologias usadas

- PHP 8.1
- MySQL 8.0
- Docker / Docker Compose
- Postman 

