# Sistema de Gestão de Tarefas 📋

Um sistema simples para gerenciamento de tarefas com funcionalidades para criação, edição e conclusão de tarefas. Construído com PHP puro.

## 🛠️ Funcionalidades

- Gerenciamento de tarefas:
  - Criação de novas tarefas
  - Atualização do status (pendente, em andamento, concluída)
  - Visualização de tarefas criadas
- Sistema de autenticação para usuários
- Banco de dados relacional para gerenciar tarefas e usuários

---

## 🚀 Como Configurar e Rodar o Projeto

### Pré-requisitos

Certifique-se de ter instalado:

- PHP >= 8.0
- Composer
- Node.js e npm
- Servidor MySQL

---

### Passo a Passo

1. **Clone o repositório**:
   ```bash
   git clone https://github.com/igorfCarv/Management-System.git
   cd nome-do-repositorio

2. **Configure o arquivo .env**:
   ```bash
   cp .env.example .env

3. **Atualize o arquivo .env com as configurações do seu banco de dados**:
   ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=management_system
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha

4. **Instale as dependências**:
   ```bash
   composer install
   npm install

5. **Configure o banco de dados: Rode o seguinte script SQL para criar o banco e as tabelas**:
   ```bash

    CREATE DATABASE management_system;

    -- Seleciona o banco de dados criado
    USE management_system;

    -- Criação da tabela `user`
    CREATE TABLE user (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

    -- Criação da tabela `task`
    CREATE TABLE task (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        finished_at TIMESTAMP NULL,
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
    );
6. **Inicie o servidor local**:
   ```bash
   php -S localhost:8000 



