![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white) ![SQLite](https://img.shields.io/badge/sqlite-%2307405e.svg?style=for-the-badge&logo=sqlite&logoColor=white) ![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white) 	![CSS](https://img.shields.io/badge/css-%23663399.svg?style=for-the-badge&logo=css&logoColor=white) ![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E) ![Git](https://img.shields.io/badge/git-%23F05033.svg?style=for-the-badge&logo=git&logoColor=white) ![GitHub](https://img.shields.io/badge/github-%23121011.svg?style=for-the-badge&logo=github&logoColor=white)

# Documentação de Requisitos de Software (DRS / SRS) — PENKAN

**Padrão de Referência:** ISO/IEC/IEEE 29148:2018  
**Versão:** 1.0  
**Status:** Em desenvolvimento

---

# 1. Introdução

## 1.1 Finalidade

Este documento especifica os requisitos, arquitetura, modelo de dados, regras de negócio, restrições e características técnicas do sistema PENKAN.

O PENKAN é uma plataforma web desenvolvida em PHP para gerenciamento de projetos de segurança ofensiva através da metodologia Kanban. O sistema foi projetado para auxiliar pentesters, estudantes e profissionais da área na organização de atividades, evidências e etapas de testes de invasão.

---

## 1.2 Escopo

O sistema permite:

- Cadastro e autenticação de usuários;
- Criação e gerenciamento de múltiplos workspaces;
- Organização de atividades utilizando Kanban;
- Registro de notas de projeto;
- Gerenciamento de cards com prioridades e categorias;
- Persistência local utilizando SQLite.

Fora do escopo atual:

- Colaboração em tempo real;
- Sincronização em nuvem;
- Integrações externas;
- Compartilhamento entre usuários;
- API pública.

---

## 1.3 Definições

| Termo     | Definição                                       |
| --------- | ----------------------------------------------- |
| Workspace | Projeto ou ambiente de trabalho do usuário      |
| Card      | Atividade individual dentro de um workspace     |
| Kanban    | Método visual de gerenciamento de tarefas       |
| Preset    | Categoria pré-definida de atividade             |
| SQLite    | Banco de dados embarcado utilizado pelo sistema |

---

## Protótipo e Design

O protótipo inicial da interface foi desenvolvido no Figma e serviu como referência para a implementação visual do sistema.

**Protótipo Figma:**  
[CLIQUE AQUI](https://www.figma.com/design/OJsw4eMHVuVOVPupTlguys/Penkan?node-id=0-1&t=3PO3rn9GtcPyx47i-1)

---

# Como Executar o Sistema

## Requisitos

Antes de executar o PENKAN, verifique se os seguintes requisitos estão instalados:

- PHP 8.0 ou superior
- Extensão PDO SQLite habilitada
- Navegador moderno compatível com HTML5
- Git (opcional, para clonagem do repositório)

---

## Obtenção do Projeto

Clone o repositório utilizando Git:

```bash
git clone https://github.com/rianeduardo/PENKAN.git
```

Acesse a pasta do projeto:

```bash
cd PENKAN
```

---

## Inicialização do Servidor

Na raiz do projeto, execute:

```bash
php -S localhost:8000
```

O servidor embutido do PHP será iniciado na porta 8000.

---

## Acesso à Aplicação

Abra o navegador e acesse:

```text
http://localhost:8000
```

---

## Banco de Dados

O PENKAN utiliza SQLite para persistência local.

Arquivo do banco:

```text
data/db.sqlite
```

Caso o banco ainda não exista, o próprio sistema realizará a criação automática das tabelas necessárias durante a primeira execução.

---

## Estrutura de Execução

```text
Usuário
   ↓
Navegador
   ↓
Servidor PHP Local
   ↓
Aplicação PENKAN
   ↓
SQLite
```

---

## Encerramento

Para interromper a execução do servidor local, utilize:

```text
CTRL + C
```

no terminal onde o servidor PHP estiver sendo executado.

---

# 2. Descrição Geral

## 2.1 Perspectiva do Produto

O PENKAN é uma aplicação web standalone executada localmente através de um servidor PHP.

A arquitetura é composta por:

- Frontend em HTML, CSS e JavaScript;
- Backend em PHP;
- Persistência em SQLite.

A aplicação pode ser executada localmente sem dependência de serviços externos.

---

## 2.2 Stakeholders

| Stakeholder         | Interesse                            |
| ------------------- | ------------------------------------ |
| Pentester           | Organizar projetos e tarefas         |
| Estudante           | Aprender metodologias de organização |
| Administrador Local | Manter o ambiente funcionando        |
| Desenvolvedor       | Evoluir e manter o sistema           |

---

## 2.3 Perfis de Usuário

### Usuário Registrado

Profissional ou estudante que utiliza o sistema para organizar atividades de segurança ofensiva.

### Administrador Local

Responsável pela manutenção do ambiente de execução.

---

## 2.4 Funções do Produto

- Cadastro de usuários;
- Login e logout;
- Criação de workspaces;
- Arquivamento de workspaces;
- Exclusão de workspaces;
- Criação de cards;
- Movimentação de cards;
- Exclusão de cards;
- Gerenciamento de notas;
- Persistência automática dos dados.

---

## 2.5 Restrições

- PHP 8.0 ou superior;
- Extensão PDO SQLite habilitada;
- Navegador compatível com HTML5;
- Banco de dados SQLite local;
- Funcionamento voltado para ambiente desktop.

---

# 3. Arquitetura do Sistema

## 3.1 Arquitetura Lógica

```text
Usuário
   ↓
Interface Web
   ↓
Páginas PHP
   ↓
Actions
   ↓
SQLite
```

## 3.2 Camadas

```text
Apresentação
├── HTML5
├── CSS3
└── JavaScript

Aplicação
└── PHP

Persistência
└── SQLite
```

---

# 4. Estrutura do Projeto

```text
PENKAN/
├── actions/
├── assets/
├── components/
├── data/
├── account.php
├── db.php
├── index.php
├── login.php
├── logout.php
├── registro.php
├── style.css
├── verifica_sessao.php
├── workspace.php
└── workspaces.php
```

---

# 5. Modelo de Dados

## Estrutura Hierárquica

```text
User
 └── Workspace
       └── Card
```

## Users

| Campo      | Descrição                |
| ---------- | ------------------------ |
| id         | Identificador único      |
| name       | Nome do usuário          |
| username   | Nome de usuário          |
| email      | E-mail                   |
| password   | Senha protegida por hash |
| specialty  | Especialidade            |
| created_at | Data de criação          |

Relacionamento:

```text
1 User → N Workspaces
```

## Workspaces

| Campo       | Descrição          |
| ----------- | ------------------ |
| id          | Identificador      |
| user_id     | Proprietário       |
| title       | Nome               |
| description | Descrição          |
| status      | active ou archived |
| notes       | Observações        |
| created_at  | Data de criação    |

Relacionamento:

```text
1 Workspace → N Cards
```

## Cards

| Campo        | Descrição                     |
| ------------ | ----------------------------- |
| id           | Identificador                 |
| workspace_id | Workspace associado           |
| user_id      | Criador                       |
| title        | Título                        |
| description  | Descrição                     |
| preset       | Categoria                     |
| status       | todo, doing ou done           |
| urgency      | Low, Medium, High ou Critical |
| created_at   | Data de criação               |

---

# 6. Regras de Negócio

| ID     | Regra                                                        |
| ------ | ------------------------------------------------------------ |
| RN-001 | Um usuário só pode visualizar seus próprios workspaces       |
| RN-002 | Um usuário só pode alterar seus próprios cards               |
| RN-003 | Todo workspace deve possuir um proprietário                  |
| RN-004 | Todo card deve pertencer a um workspace                      |
| RN-005 | Usuários não autenticados não podem acessar áreas protegidas |
| RN-006 | Workspaces arquivados permanecem armazenados                 |
| RN-007 | Cards só podem existir nos estados todo, doing ou done       |

---

# 7. Requisitos Funcionais

## RF-001 — Cadastro de Usuário

Descrição:
O sistema deve permitir o cadastro de novos usuários.

Entradas:
- Nome
- Username
- Email
- Senha

Critério de aceitação:
- Conta criada com sucesso.
- Usuário consegue realizar login.

---

## RF-002 — Login

Descrição:
O sistema deve autenticar usuários cadastrados.

Entradas:
- Username
- Senha

Critério de aceitação:
- Sessão criada.
- Redirecionamento para workspaces.

---

## RF-003 — Criar Workspace

Descrição:
Permitir a criação de workspaces personalizados.

Critério de aceitação:
- Workspace salvo no banco.
- Workspace exibido na listagem.

---

## RF-004 — Criar Card

Descrição:
Permitir criação de cards em um workspace.

Entradas:
- Título
- Descrição
- Preset
- Prioridade

Critérios de aceitação:
- Card salvo no banco.
- Card exibido na coluna correspondente.

---

## RF-005 — Movimentar Card

Descrição:
Permitir mover cards entre colunas.

Critério de aceitação:
- Novo status persistido no banco.

---

## RF-006 — Excluir Card

Descrição:
Permitir remoção de cards existentes.

---

## RF-007 — Gerenciar Notas

Descrição:
Permitir salvar anotações vinculadas ao workspace.

---

## RF-008 — Persistência

Descrição:
Todos os dados devem permanecer armazenados após reinicialização.

---

# 8. Requisitos Não Funcionais

| ID      | Requisito                                            | Categoria       |
| ------- | ---------------------------------------------------- | --------------- |
| RNF-001 | Senhas devem ser protegidas por hash                 | Segurança       |
| RNF-002 | Operações comuns devem responder em até 2 segundos   | Desempenho      |
| RNF-003 | Dados devem permanecer íntegros após reinicialização | Confiabilidade  |
| RNF-004 | Sistema deve funcionar em navegadores modernos       | Compatibilidade |
| RNF-005 | Interface deve manter boa usabilidade em desktop     | Usabilidade     |

---

# 9. Segurança

- Utilização de password_hash();
- Validação com password_verify();
- Controle de sessão por verifica_sessao.php;
- Verificação de propriedade dos workspaces;
- Verificação de propriedade dos cards;
- Bloqueio de acesso direto ao db.php.

---

# 10. Casos de Uso

| ID     | Caso de Uso     | Requisito |
| ------ | --------------- | --------- |
| UC-001 | Criar Conta     | RF-001    |
| UC-002 | Realizar Login  | RF-002    |
| UC-003 | Criar Workspace | RF-003    |
| UC-004 | Criar Card      | RF-004    |
| UC-005 | Mover Card      | RF-005    |
| UC-006 | Excluir Card    | RF-006    |
| UC-007 | Gerenciar Notas | RF-007    |

---

# 11. Fluxo de Uso

1. Usuário cria conta.
2. Sistema gera hash da senha.
3. Usuário realiza login.
4. Sistema cria sessão.
5. Usuário acessa workspaces.
6. Usuário cria projetos.
7. Usuário cria cards.
8. Usuário movimenta cards.
9. Sistema persiste todas as alterações.

---

# 12. Análise de Riscos

| Risco                           | Impacto | Mitigação                  |
| ------------------------------- | ------- | -------------------------- |
| Corrupção do SQLite             | Alto    | Backups periódicos         |
| Falhas de autenticação          | Alto    | Hash seguro e validações   |
| Incompatibilidade de versão PHP | Médio   | Definir requisitos mínimos |
| Exclusão acidental de dados     | Médio   | Confirmações e backups     |

---

# 13. Roadmap

- Edição completa de cards;
- Upload de evidências;
- Exportação de relatórios PDF;
- Dashboard de métricas;
- Histórico de alterações;
- Colaboração em tempo real;
- API REST;
- Integração com metodologias de pentest;
- Sistema avançado de vulnerabilidades.

---

# 14. Controle de Versão

O projeto utiliza Git para rastreamento das alterações.

Arquivos principais:

- index.php
- login.php
- registro.php
- workspaces.php
- workspace.php
- account.php
- db.php

---

# 15. Status Atual

O projeto encontra-se funcional para:

- Autenticação;
- CRUD de workspaces;
- CRUD de cards;
- Notas por workspace;
- Persistência SQLite;
- Organização Kanban.

As próximas etapas concentram-se na evolução para uma plataforma mais completa voltada à gestão de projetos de segurança ofensiva.
