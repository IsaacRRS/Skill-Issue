# 🎬 Sistema de Gerenciamento de Filmes e Séries

Bem-vindo ao repositório do **Sistema de Gerenciamento de Filmes e Séries**! Este projeto foi desenvolvido para ajudar os usuários a gerenciar suas listas de filmes e séries favoritas, avaliar conteúdos e, para administradores, gerenciar atividades e informações dos usuários.

---

## 📅 Cronograma do Projeto

| Data        | Descrição                             |
|-------------|---------------------------------------|
| 12/11/2024  | Definição da equipe e tema do projeto |
| 14/11/2024  | Concepção das tasks                   |
| 16/11/2024  | Criação do design                     |
| 20/11/2024  | Arquitetura de experiência do usuário |
| 28/11/2024  | Desenvolvimento                       |

---

## 👥 Equipe de Desenvolvimento

| Nome             | Função                   |
|------------------|--------------------------|
| Fabio Hiranoyama | Product Owner - Back-end |
| Isaac Ribeiro    | Front-end                |
| João Lucas       | Back-end                 |
| Juan Gabriel     | Back-end                 |
| Marcus Santos    | Front-end                |

---

## 🔗 Link do Repositório GitHub

Acesse o repositório [aqui](https://github.com/IsaacRRS/Skill-Issue).

---

## 📖 Visão Geral

O sistema de gerenciamento de filmes e séries foi projetado para permitir que:

- Usuários façam login e gerenciem suas listas de filmes e séries favoritas.
- Usuários avaliem conteúdos com notas e comentários.
- Administradores gerenciem todas as informações e atividades dos usuários.

---

## 🌐 Descrição Geral do Sistema

### 1. Endpoints de Autenticação

- **POST**: Cadastra um novo usuário.
- **POST**: Realiza o login 
- **POST**: Realiza o logout do usuário.

### 2. Endpoints de Listas de Filmes e Séries

- **GET**: Recupera lista completa de séries ou filmes
- **POST**: Adiciona um filme ou série à lista.
- **PUT**: Edita os detalhes de um item da lista.
- **DELETE**: Remove um item da lista.

### 3. Endpoints de Administração

- **GET**: Lista todos os usuários cadastrados no sistema.
- **PUT**: Permite ao administrador editar detalhes de usuário e suas listas.
- **DELETE**: Permite ao administrador remover itens de qualquer lista de usuário.
- **DELETE**: Permite ao administrador excluir a conta de um usuário.

---

## ✅ Requisitos Funcionais

### 1. Autenticação de Usuário

#### 1.1. Cadastro

- O usuário deve criar uma conta utilizando um endereço de e-mail válido e uma senha para acessar o sistema.

#### 1.2. Login

- O login é realizado mediante a inserção de e-mail e senha.
- Após o login, o usuário tem acesso às suas listas e funcionalidades.

#### 1.3. Fluxo de Administrador

- Administradores possuem acesso a todas as informações e atividades dos usuários, podendo:
  - Editar as listas de filmes e séries dos usuários.
  - Remover filmes e séries das listas de qualquer usuário.
  - Excluir contas de usuários.

### 2. Listas de Filmes e Séries

#### 2.1. Adicionar Filme ou Série

- O usuário pode adicionar filmes e séries à sua lista, incluindo informações detalhadas como título, ano, descrição e status (assistido ou não).

#### 2.2. Editar Detalhes

- As informações de um item na lista podem ser modificadas, como título, descrição, ano e status.

#### 2.3. Remover Filme ou Série

- O usuário pode excluir filmes e séries de sua lista a qualquer momento.

### 3. Avaliação e Notas

#### 3.1. Dar Nota

- O usuário pode avaliar filmes e séries com uma escala predefinida de 1 a 5 estrelas.

#### 3.2. Atualizar Nota

- A nota pode ser alterada pelo usuário a qualquer momento.

#### 3.3. Comentários

- É possível adicionar comentários pessoais ou críticas a cada item da lista, de forma opcional.

---

## 📋 Requisitos Não Funcionais

1. **Autenticação Obrigatória**: O usuário deve estar logado para utilizar as funcionalidades de gerenciamento de listas e avaliações.

2. **Validação de Notas**: As notas de avaliação devem ser obrigatoriamente entre 1 e 5, podendo ser atualizadas posteriormente pelo usuário.

3. **Segurança**: Apenas administradores têm acesso aos endpoints administrativos, permitindo total controle sobre os dados do sistema.

---

## 🗂️ Diagramação e Prototipação de Banco de Dados

### 1. Tabela de Usuários

| Atributo  | Tipo    | Tam. | Máscara | Obrig. |
|-----------|---------|------|---------|--------|
| ID        | Inteiro | 11   | PK      | ✅      |
| Nome      | Texto   | 255  | -       | ✅      |
| Email     | Texto   | 255  | -       | ✅      |
| Senha     | Texto   | 255  | -       | ✅      |
| Is_admin  | Boolean | 1    | -       | ✅      |

### 2. Tabela de Filmes

| Atributo      | Tipo    | Tam. | Máscara | Obrig. |
|---------------|---------|------|---------|--------|
| ID            | Inteiro | 11   | PK      | ✅      |
| Nome          | Texto   | 255  | -       | ✅      |
| User_id       | Inteiro | 11   | FK      | ✅      |
| Status_Option | String  | 50   | -       | ✅      |
| Genre         | String  | 100  | -       | ✅      |
| Rating        | Int     | 1    | -       | ✅      |
| Release_year  | Int     | 4    | -       | ✅      |
| Description   | Texto   | -    | -       | ✅      |

### 3. Tabela de Séries

| Atributo      | Tipo    | Tam. | Máscara | Obrig. |
|---------------|---------|------|---------|--------|
| ID            | Inteiro | 11   | PK      | ✅      |
| Nome          | Texto   | 255  | -       | ✅      |
| User_id       | Inteiro | 11   | FK      | ✅      |
| Status_Option | String  | 50   | -       | ✅      |
| Genre         | String  | 100  | -       | ✅      |
| Rating        | Int     | 1    | -       | ✅      |
| Release_year  | Int     | 4    | -       | ✅      |
| Description   | Texto   | -    | -       | ✅      |
| Seasons       | Int     | 2    | -       | ✅      |
| Episodes      | Int     | 2    | -       | ✅      |

---

## 🛠️ Script SQL para Criação do Banco de Dados

```sql
-- Create the database
CREATE DATABASE skill_issue;

-- Use the database
USE skill_issue;

-- Create the 'users' table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE
);

-- Create the 'series' table
CREATE TABLE series (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    seasons INT NOT NULL,
    episodes INT NOT NULL,
    release_year INT NOT NULL,
    description TEXT,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    status_option VARCHAR(50),
    genre VARCHAR(100),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Create the 'movies' table
CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    genre VARCHAR(100),
    rating INT CHECK (rating >= 1 AND rating <= 5),
    status_option VARCHAR(50),
    release_year INT NOT NULL,
    description TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

---

## 📝 Como Executar o Projeto

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/IsaacRRS/Skill-Issue.git
   ```

2. **Configure o banco de dados:**

   - Utilize o script SQL acima para criar o banco de dados `skill_issue`.
   - Configure a conexão no arquivo `db.php`.

3. **Instale as dependências necessárias.**

4. **Execute o servidor localmente.**

---

## 📚 Tecnologias Utilizadas

- **Front-end:** HTML, CSS, JavaScript
- **Back-end:** PHP
- **Banco de Dados:** MySQL

---

## 📌 Observações

- **Segurança:** As senhas são armazenadas utilizando hash para garantir a segurança dos usuários.
- **Validação de Dados:** O sistema realiza validações nos formulários para garantir a integridade dos dados inseridos.

---

