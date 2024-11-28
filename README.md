# 🎬 Sistema de Gerenciamento de Filmes e Séries

Bem-vindo ao repositório do **Sistema de Gerenciamento de Filmes e Séries**! Este projeto foi desenvolvido para ajudar os usuários a gerenciar suas listas de filmes e séries favoritas, avaliar conteúdos e, para administradores, gerenciar atividades e informações dos usuários.

---

## 📅 Cronograma do Projeto

| **Data**        | **Descrição**                           |
|------------------|-----------------------------------------|
| **12/11/2024**   | Definição da equipe e tema do projeto   |
| **14/11/2024**   | Concepção das tasks                    |
| **16/11/2024**   | Criação do design                      |
| **20/11/2024**   | Arquitetura de experiência do usuário  |
| **28/11/2024**   | Desenvolvimento                        |

---

## 👥 Equipe de Desenvolvimento

| **Nome**          | **Função**                 |
|--------------------|----------------------------|
| Fabio Hiranoyama   | Product Owner - Back-end   |
| Isaac Ribeiro      | Front-end                  |
| João Lucas         | Back-end                   |
| Juan Gabriel       | Back-end                   |
| Marcus Santos      | Front-end                  |

---

## 🔗 Link do Repositório

[Acesse o repositório aqui!](https://github.com/IsaacRRS/Skill-Issue)

---

## 📖 Visão Geral

O **Sistema de Gerenciamento de Filmes e Séries** foi projetado para:

- Permitir que usuários gerenciem suas listas de filmes e séries favoritas.
- Avaliar e comentar conteúdos.
- Administradores tenham controle total das informações do sistema.

---

## 🌐 Endpoints do Sistema

### 🔒 Endpoints de Autenticação
- **`POST /api/register`**: Cadastra um novo usuário.
- **`POST /api/login`**: Realiza login e retorna um token de autenticação.
- **`POST /api/logout`**: Realiza logout do usuário.

### 📋 Endpoints de Listas
- **`POST /api/lista/adicionar`**: Adiciona um filme ou série à lista.
- **`PUT /api/lista/editar/{id}`**: Edita os detalhes de um item da lista.
- **`DELETE /api/lista/remover/{id}`**: Remove um item da lista.

### ⭐ Endpoints de Avaliação
- **`POST /api/lista/{id}/avaliar`**: Adiciona uma nota a um filme ou série.
- **`PUT /api/lista/{id}/avaliar`**: Atualiza a nota de um filme ou série.
- **`GET /api/lista/avaliados`**: Lista todos os itens avaliados.

### 🛠️ Endpoints de Administração
- **`GET /api/admin/usuarios`**: Lista todos os usuários cadastrados.
- **`PUT /api/admin/lista/editar/{id}`**: Edita detalhes de um item de qualquer lista.
- **`DELETE /api/admin/lista/remover/{id}`**: Remove itens de qualquer lista.
- **`DELETE /api/admin/usuario/remover/{id}`**: Exclui contas de usuários.

---

## ✅ Requisitos Funcionais

### 🔑 Autenticação
- Cadastro com e-mail válido e senha.
- Login para acessar as funcionalidades.
- Administradores podem:
  - Editar listas de usuários.
  - Remover itens de listas.
  - Excluir contas de usuários.

### 📋 Listas de Filmes e Séries
- Adicionar, editar e remover itens com detalhes como título, ano e status (assistido ou não).

### ⭐ Avaliação e Notas
- Avaliar itens com notas de 1 a 5 estrelas.
- Atualizar notas a qualquer momento.
- Adicionar comentários opcionais.

### 🖥️ Interface do Usuário
- **Dashboard**: Resumo das listas do usuário.
- **Pesquisa**: Busca por títulos ou gêneros.
- **Categorias**: 'Favoritos', 'Para Assistir' e 'Assistidos'.

---

## 📋 Requisitos Não Funcionais

1. O usuário deve estar logado para gerenciar listas e avaliações.
2. Um item só pode ser adicionado à lista uma vez.
3. As notas de avaliação devem estar entre 1 e 5.
4. Apenas administradores podem acessar endpoints administrativos.

---

## 🗂️ Estrutura do Banco de Dados

### 🧑‍💻 Tabela de Usuários
| **Atributo** | **Tipo**   | **Tamanho** | **Máscara** | **Obrigatório** |
|--------------|------------|-------------|-------------|------------------|
| `ID`         | Inteiro    | 11          | PK          | ✅               |
| `Nome`       | Texto      | 255         | -           | ✅               |
| `Email`      | Texto      | 16          | -           | ✅               |
| `Senha`      | Texto      | 15          | -           | ✅               |

### 🎥 Tabela de Filmes
| **Atributo** | **Tipo**   | **Tamanho** | **Máscara** | **Obrigatório** |
|--------------|------------|-------------|-------------|------------------|
| `ID`         | Inteiro    | 11          | PK          | ✅               |
| `Nome`       | Texto      | 255         | -           | ✅               |
| `Duração`    | Float      | 16          | -           | ✅               |
| `Estado`     | ENUM       | 10          | -           | ✅               |

### 📺 Tabela de Séries
| **Atributo**         | **Tipo**   | **Tamanho** | **Máscara** | **Obrigatório** |
|-----------------------|------------|-------------|-------------|------------------|
| `ID`                 | Inteiro    | 11          | PK          | ✅               |
| `Nome`               | Texto      | 255         | -           | ✅               |
| `Duração`            | Float      | 16          | -           | ✅               |
| `Estado`             | ENUM       | 10          | -           | ✅               |
| `Episodios`          | Inteiro    | 10          | -           | ✅               |
| `Episodios_assistidos` | Inteiro    | 10          | -           | ✅               |

---

🚀 **Pronto para mergulhar no código? Contribua ou explore o projeto!**