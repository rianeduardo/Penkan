# PENKAN

PENKAN e uma plataforma web em PHP para organizar projetos de pentest em formato Kanban. A ideia e simples: criar workspaces, registrar cards por etapa do trabalho, mover tarefas entre colunas e manter notas do projeto em um lugar so.

O projeto foi feito com PHP, SQLite, HTML, CSS e JavaScript puro, pensando em uso local ou em um servidor PHP simples.

[Protótipo BASE no Figma](https://www.figma.com/design/OJsw4eMHVuVOVPupTlguys/Penkan?node-id=0-1&t=3PO3rn9GtcPyx47i-1)

---

## Como rodar?

```bash
git clone https://github.com/rianeduardo/PENKAN.git
```

```bash
php -S localhost:porta
```

E pronto! O banco de dados é local, feito com SQLite

---

## Funcionalidades

- Cadastro e login de usuario.
- Sessao autenticada para areas internas.
- Criacao, listagem, arquivamento e exclusao de workspaces.
- Acesso ao workspace clicando no card inteiro.
- Criacao de cards com titulo, descricao, preset e urgencia.
- Quadro Kanban com colunas: A fazer, Fazendo e Feito.
- Movimentacao de cards entre colunas.
- Exclusao de cards.
- Campo de notas por workspace.
- Persistencia local usando SQLite.
- Bloqueio de acesso direto ao arquivo `db.php`.

## Tecnologias

- PHP
- SQLite
- HTML5
- CSS3
- JavaScript

## Como Rodar

Requisitos:

- PHP com extensao PDO SQLite habilitada.
- Navegador web.

Na raiz do projeto, rode:

```bash
php -S localhost:8000
```

Depois acesse:

```text
http://localhost:8000
```

O banco fica em `data/db.sqlite`. Se ele nao existir, o proprio sistema cria as tabelas necessarias quando a aplicacao for usada.

## Estrutura do Projeto

```text
PENKAN/
  actions/
    create_card.php
    create_workspace.php
    delete_card.php
    delete_workspace.php
    move_card.php
    update_account.php
    update_workspace_notes.php
    update_workspace_status.php
  assets/
    app.js
    grafico.svg
    logoPenkan.svg
  components/
    footer.php
    header.php
  data/
    db.sqlite
  account.php
  db.php
  index.php
  login.php
  logout.php
  registro.php
  style.css
  verifica_sessao.php
  workspace.php
  workspaces.php
```

## Paginas Principais

| Arquivo | Funcao |
| --- | --- |
| `index.php` | Home do PENKAN, com fluxo, recursos e contato. |
| `registro.php` | Criacao de conta. |
| `login.php` | Autenticacao do usuario. |
| `logout.php` | Encerramento da sessao. |
| `account.php` | Visualizacao e atualizacao dos dados da conta. |
| `workspaces.php` | Listagem e gerenciamento dos workspaces. |
| `workspace.php` | Quadro Kanban, cards e notas do workspace. |
| `db.php` | Conexao, criacao e migracao basica do banco SQLite. |
| `verifica_sessao.php` | Centraliza a validacao de sessao nas paginas protegidas. |

## Organizacao dos Handlers

Os arquivos dentro de `actions/` recebem formularios e executam mudancas no banco. Eles nao exibem tela propria; apenas validam a sessao, conferem permissao sobre o workspace/card e redirecionam o usuario.

Essa separacao deixa a raiz mais limpa e evita misturar pagina visual com script de processamento.

## Banco de Dados

O PENKAN usa tres entidades principais:

```text
users
  -> workspaces
      -> cards
```

### `users`

| Campo | Descricao |
| --- | --- |
| `id` | Identificador do usuario. |
| `name` | Nome ou apelido. |
| `username` | Nome de usuario usado no login. |
| `email` | E-mail da conta. |
| `password` | Senha com hash. |
| `specialty` | Vetor primario / especialidade. |
| `created_at` | Data de criacao. |

### `workspaces`

| Campo | Descricao |
| --- | --- |
| `id` | Identificador do workspace. |
| `user_id` | Dono do workspace. |
| `title` | Titulo do workspace. |
| `description` | Descricao opcional. |
| `status` | `active` ou `archived`. |
| `notes` | Anotacoes gerais do projeto. |
| `created_at` | Data de criacao. |

### `cards`

| Campo | Descricao |
| --- | --- |
| `id` | Identificador do card. |
| `workspace_id` | Workspace ao qual o card pertence. |
| `user_id` | Usuario criador. |
| `title` | Titulo da tarefa. |
| `description` | Descricao da tarefa. |
| `preset` | Categoria do card. |
| `status` | `todo`, `doing` ou `done`. |
| `urgency` | Prioridade: `Low`, `Medium`, `High` ou `Critical`. |
| `created_at` | Data de criacao. |

## Fluxo de Uso

1. O usuario cria uma conta em `registro.php`.
2. O sistema salva a senha usando `password_hash`.
3. O usuario entra pelo `login.php`.
4. Depois do login, ele acessa `workspaces.php`.
5. Cada workspace abre um quadro em `workspace.php`.
6. Dentro do workspace, o usuario cria cards, move entre colunas e salva notas.

## Seguranca

- Senhas sao armazenadas com hash usando `password_hash`.
- Login valida senha com `password_verify`.
- Paginas internas usam `verifica_sessao.php`.
- Actions conferem se o workspace/card pertence ao usuario logado antes de alterar dados.
- `db.php` retorna acesso negado quando chamado diretamente pelo navegador.

## Melhorias Futuras

Essas sao as proximas ideias para deixar o PENKAN mais completo:

- Workspaces ilimitados com filtros, busca e melhor separacao por cliente/escopo.
- Gestao de vulnerabilidades com severidade, impacto, evidencia e status de correcao.
- Central de evidencias categorizadas para screenshots, payloads, logs e provas de conceito.
- Relatorios profissionais para exportacao em PDF/HTML.
- Metodologia PENKAN integrada com etapas de reconhecimento, exploracao, pos-exploracao e reporte.
- Historico e auditoria em tempo real para registrar alteracoes, movimentacoes e atualizacoes.
- Workspaces colaborativos ao vivo para equipes trabalharem no mesmo projeto.
- Edicao completa de cards existentes.
- Melhor tratamento de mensagens de erro e sucesso para o usuario.

## Status

Projeto em reta final, com foco em organizacao, autenticacao, CRUD basico e acabamento da experiencia do workspace.
