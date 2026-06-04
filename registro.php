<?php
require_once __DIR__ . '/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();
 $errors = [];
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $name = trim($_POST['name'] ?? '');
     $username = trim($_POST['username'] ?? '');
     $email = trim($_POST['email'] ?? '');
     $password = $_POST['password'] ?? '';
     $specialty = trim($_POST['specialty'] ?? '');
     if ($username === '' || $email === '' || $password === '') {
         $errors[] = 'Usuário, e-mail e senha são obrigatórios.';
     } else {
         $st = DB::pdo()->prepare('SELECT id FROM users WHERE username = ? LIMIT 1');
         $st->execute([$username]);
         if ($st->fetch()) {
             $errors[] = 'Nome de usuário já existe.';
         }
         $st = DB::pdo()->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
         $st->execute([$email]);
         if ($st->fetch()) {
             $errors[] = 'E-mail já cadastrado.';
         }
         if (empty($errors)) {
             $hash = password_hash($password, PASSWORD_DEFAULT);
             $ins = DB::pdo()->prepare('INSERT INTO users (name, username, email, password, specialty) VALUES (?, ?, ?, ?, ?)');
             $ins->execute([$name, $username, $email, $hash, $specialty]);
             $_SESSION['user_id'] = DB::pdo()->lastInsertId();
             header('Location: workspaces.php');
             exit;
         }
     }
 }
include __DIR__ . '/components/header.php';
?>

<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PENKAN | Criar conta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <div class="containerCadastro">
                <div class="textosCadastro">
                <h1 class="tituloLogo">PENKAN</h1>
                <div class="frase">
                <p><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#0be545"><path d="M168-192q-29.7 0-50.85-21.16Q96-234.32 96-264.04v-432.24Q96-726 117.15-747T168-768h624q29.7 0 50.85 21.16Q864-725.68 864-695.96v432.24Q864-234 842.85-213T792-192H168Zm0-72h624v-360H168v360Zm132-48-51-51 81-81-81-81 51-51 132 132-132 132Zm180 0v-72h240v72H480Z"/></svg>ENTRE NA ONDA</p>
                <div class="inputTerminal"></div>    
            </div>    
            </div>
                <div class="caixaCadastro">
                    <div class="cabecalhoFormulario">
                        <span class="indicador">SYS.REG_AUTH_REQUIRED</span>
                        <h2>Crie sua conta</h2>
                        <p>Cadastre-se para criar workspaces e cards.</p>
                    </div>
                    <?php if (!empty($errors)): ?>
                        <div class="errors" style="color:#ff6b6b;margin-bottom:10px;">
                            <?php foreach ($errors as $e) echo '<div>' . htmlspecialchars($e) . '</div>'; ?>
                        </div>
                    <?php endif; ?>
                    <form action="registro.php" method="post" class="formCadastro">
                        <label for="username"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#BACBB4"><path d="M168-96q-29.7 0-50.85-21.15Q96-138.3 96-168v-432q0-29.7 21.15-50.85Q138.3-672 168-672h216v-120q0-29.7 21.15-50.85Q426.3-864 456-864h48q29.7 0 50.85 21.15Q576-821.7 576-792v120h216q29.7 0 50.85 21.15Q864-629.7 864-600v432q0 29.7-21.15 50.85Q821.7-96 792-96H168Zm0-72h624v-432H576q0 30-21.15 51T504-528h-48q-29.7 0-50.85-21.15Q384-570.3 384-600H168v432Zm72-72h240v-23q0-17.63-9.5-32.67Q461-310.7 444-319q-20-8-40.5-12.5T360-336q-23 0-43.5 4.5T276-318.53q-17 7.53-26.5 22.66Q240-280.74 240-263v23Zm336-48h144v-72H576v72Zm-173.5-89.5Q420-395 420-420t-17.5-42.5Q385-480 360-480t-42.5 17.5Q300-445 300-420t17.5 42.5Q335-360 360-360t42.5-17.5ZM576-408h144v-72H576v72ZM456-600h48v-192h-48v192Zm24 216Z"/></svg>USUÁRIO</label>
                        <input type="text" name="username" placeholder="hacker123" required>
                        <label for="email"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#BACBB4"><path d="M168-192q-29.7 0-50.85-21.16Q96-234.32 96-264.04v-432.24Q96-726 117.15-747T168-768h624q29.7 0 50.85 21.16Q864-725.68 864-695.96v432.24Q864-234 842.85-213T792-192H168Zm312-240L168-611v347h624v-347L480-432Zm0-85 312-179H168l312 179Zm-312-94v-85 432-347Z"/></svg>SEU MELHOR E-MAIL</label>
                        <input type="email" name="email" placeholder="usuario@penkan.com" required>
                        <label for="password"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#BACBB4"><path d="M220-412q-28-28-28-68t28-68q28-28 68-28t68 28q28 28 28 68t-28 68q-28 28-68 28t-68-28Zm68 172q-100 0-170-70T48-480q0-100 70-170t170-70q65 0 120 32.5t88 87.5h344l120 120-180 168-84-60-72 60-96-72h-20q-24 68-85.5 106T288-240Zm0-72q63 0 111-40.5T454-456h98l70 52 71-59 81 58 82-76-46-47H449q-19-53-62.5-86.5T288-648q-70 0-119 49t-49 119q0 70 49 119t119 49Z"/></svg>SENHA</label>
                        <input type="password" name="password" placeholder="Sua senha" required>
                        <label for="name"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#BACBB4"><path d="M743.79-660q15.21 0 25.71-10.29t10.5-25.5q0-15.21-10.29-25.71t-25.5-10.5q-15.21 0-25.71 10.29t-10.5 25.5q0 15.21 10.29 25.71t25.5 10.5Zm-144 0q15.21 0 25.71-10.29t10.5-25.5q0-15.21-10.29-25.71t-25.5-10.5q-15.21 0-25.71 10.29t-10.5 25.5q0 15.21 10.29 25.71t25.5 10.5ZM576-504h192q0-34-29.28-53T672-576q-37.44 0-66.72 19T576-504ZM118-166q-70-70-70-170v-288h480v288q0 100-70 170T288-96q-100 0-170-70Zm289-51q49-49 49-119v-216H120v216q0 70 49 119t119 49q70 0 119-49Zm265-119q-24.65 0-48.82-5Q599-346 576-357v-82q20 17 44.85 24 24.84 7 51.15 7 70 0 119-49t49-119v-216H504v120h-72v-192h480v288q0 100-70 170t-170 70Zm-456.21-84q15.21 0 25.71-10.29t10.5-25.5q0-15.21-10.29-25.71t-25.5-10.5q-15.21 0-25.71 10.29t-10.5 25.5q0 15.21 10.29 25.71t25.5 10.5Zm169.71-10.29q10.5-10.29 10.5-25.5t-10.29-25.71q-10.29-10.5-25.5-10.5t-25.71 10.29q-10.5 10.29-10.5 25.5t10.29 25.71q10.29 10.5 25.5 10.5t25.71-10.29ZM354.5-283q29.5-19 29.5-53H192q0 34 29.5 53t66.5 19q37 0 66.5-19ZM288-336Zm384-288Z"/></svg>APELIDO</label>
                        <input type="text" name="name" placeholder="Seu apelido (opcional)">

                        <div class="grupoEspecialidade">
                            <p>Vetor primário (especialidade)</p>
                            <div class="opcoes">
                                <label class="opcao">
                                    <input type="radio" name="specialty" value="webapp" checked>
                                    <span class="opcaoCaixa">Web App Sec</span>
                                </label>
                                <label class="opcao">
                                    <input type="radio" name="specialty" value="network">
                                    <span class="opcaoCaixa">Network / Infra</span>
                                </label>
                                <label class="opcao">
                                    <input type="radio" name="specialty" value="cloud">
                                    <span class="opcaoCaixa">Cloud / IAM</span>
                                </label>
                                <label class="opcao">
                                    <input type="radio" name="specialty" value="hardware">
                                    <span class="opcaoCaixa">Hardware / IoT</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btnPrimario botaoSalvar">INICIALIZAR ACESSO</button>
                    </form>
                    <p class="textoEntrar">Já tem uma conta? <a href="login.php">Autenticar</a></p>
                </div>
        </div>
    </main>
</body>

</html>