Penkan — Minimal local Kanban for pentesters

Resumo
- Aplicação PHP + SQLite mínima para organizar workspaces e cards focada em pentesters/hackers.
- Autenticação por usuário (`username`) + senha.
- Conta inclui: `username`, `name`, `email`, `specialty` (vetor primário).
- Workspaces: título, descrição, status (`active` / `archived`), notas livres.
- Cards: título, descrição, preset, urgência, status (A fazer / Fazendo / Feito).

Arquivos principais
- `db.php` — helper SQLite; cria `data/db.sqlite` automaticamente e aplica migrações.
- `index.php`, `login.php`, `registro.php`, `logout.php` — páginas públicas / auth.
- `workspaces.php`, `workspace.php` — listar workspaces e visualizar workspace com quadro Kanban.
- `create_workspace.php`, `update_workspace_status.php`, `delete_workspace.php` — gerenciam workspaces.
- `create_card.php`, `move_card.php`, `delete_card.php` — gerenciam cards.
- `update_workspace_notes.php` — salva notas do workspace.
- `account.php`, `update_account.php` — ver/atualizar dados da conta.
- `components/header.php` — header com menu e sessão.
- `assets/app.js` — JS mínimo para modal.

Como rodar localmente
1. Navegue até a pasta do projeto:

```powershell
cd "c:\Users\Windows 10\Documents\PENKAN"
```

2. Inicie o servidor PHP embutido:

```powershell
php -S localhost:8000
```

3. Abra no navegador: `http://localhost:8000`

Observações
- O banco SQLite será criado em `data/db.sqlite` na primeira execução.
- Não há integração com serviços externos — tudo roda localmente.
- Este é um protótipo simples focado em funcionalidade (UI mínima).

Próximos passos sugeridos
- Adicionar edição de cards (detalhes), ordenação por prioridade, filtros por preset/urgency.
- Melhorar UI e adicionar persistência de sessão mais robusta.

***
Feito por automação — se quiser, eu ajusto qualquer detalhe (campos de card, presets, ou UI).