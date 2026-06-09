<?php
require_once __DIR__ . '/db.php';
if (session_status() === PHP_SESSION_NONE)
    session_start();
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username === '' || $password === '') {
        $errors[] = 'Preencha usuário e senha.';
    } else {
        $stmt = DB::pdo()->prepare('SELECT id, password, name, username FROM users WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        $u = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($u && password_verify($password, $u['password'])) {
            $_SESSION['user_id'] = $u['id'];
            header('Location: workspaces.php');
            exit;
        } else {
            $errors[] = 'Credenciais inválidas.';
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
    <title>PENKAN | Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./assets/logoPenkan.svg" type="image/x-icon">
</head>

<body>
    <main class="paginaLogin">

        <div class="textosCadastro">
            <h1 class="tituloLogo">PENKAN</h1>

            <div class="frase">
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                    fill="#0be545">
                    <path
                        d="M168-192q-29.7 0-50.85-21.16Q96-234.32 96-264.04v-432.24Q96-726 117.15-747T168-768h624q29.7 0 50.85 21.16Q864-725.68 864-695.96v432.24Q864-234 842.85-213T792-192H168Zm0-72h624v-360H168v360Zm132-48-51-51 81-81-81-81 51-51 132 132-132 132Zm180 0v-72h240v72H480Z" />
                </svg>
                <p>ENTRE NA ONDA</p>
                <div class="inputTerminal">█</div>
            </div>
        </div>

        <div class="containerCadastro">
            <div class="caixaCadastro">

                <div class="cabecalhoFormulario">
                    <div class="wrap">
                        <div class="bolinhaIndicador"></div>
                        <span class="indicador">SYS.LOG.AUTH_REQUIRED</span>
                    </div>

                    <hr>

                    <h2>Autenticar acesso</h2>
                    <p>Entre para acessar seus workspaces e cards.</p>
                </div>

                <?php if (!empty($errors)): ?>
                    <div class="errors" style="color:#ff6b6b;margin-bottom:10px;">
                        <?php foreach ($errors as $e)
                            echo '<div>' . htmlspecialchars($e) . '</div>'; ?>
                    </div>
                <?php endif; ?>

                <form action="login.php" method="post" class="formCadastro">

                    <div class="labelRow">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                            fill="#BACBB4">
                            <path
                                d="M168-96q-29.7 0-50.85-21.15Q96-138.3 96-168v-432q0-29.7 21.15-50.85Q138.3-672 168-672h216v-120q0-29.7 21.15-50.85Q426.3-864 456-864h48q29.7 0 50.85 21.15Q576-821.7 576-792v120h216q29.7 0 50.85 21.15Q864-629.7 864-600v432q0 29.7-21.15 50.85Q821.7-96 792-96H168Zm0-72h624v-432H576q0 30-21.15 51T504-528h-48q-29.7 0-50.85-21.15Q384-570.3 384-600H168v432Zm72-72h240v-23q0-17.63-9.5-32.67Q461-310.7 444-319q-20-8-40.5-12.5T360-336q-23 0-43.5 4.5T276-318.53q-17 7.53-26.5 22.66Q240-280.74 240-263v23Zm336-48h144v-72H576v72Zm-173.5-89.5Q420-395 420-420t-17.5-42.5Q385-480 360-480t-42.5 17.5Q300-445 300-420t17.5 42.5Q335-360 360-360t42.5-17.5ZM576-408h144v-72H576v72ZM456-600h48v-192h-48v192Zm24 216Z" />
                        </svg>
                        <label for="username">USUÁRIO</label>
                    </div>

                    <input id="username" type="text" name="username" placeholder="hacker123" required class="entrada">
                    <div class="labelRow">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px"
                            fill="#BACBB4">
                            <path
                                d="M220-412q-28-28-28-68t28-68q28-28 68-28t68 28q28 28 28 68t-28 68q-28 28-68 28t-68-28Zm68 172q-100 0-170-70T48-480q0-100 70-170t170-70q65 0 120 32.5t88 87.5h344l120 120-180 168-84-60-72 60-96-72h-20q-24 68-85.5 106T288-240Zm0-72q63 0 111-40.5T454-456h98l70 52 71-59 81 58 82-76-46-47H449q-19-53-62.5-86.5T288-648q-70 0-119 49t-49 119q0 70 49 119t119 49Z" />
                        </svg>
                        <label for="password">SENHA</label>
                    </div>

                    <input id="password" type="password" name="password" placeholder="Sua senha" required
                        class="entrada">

                    <button type="submit" class="btnPrimario botaoSalvar">

                        <div class="labelRow">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                                fill="#000000">
                                <path
                                    d="M480-144v-72h264v-528H480v-72h264q29.7 0 50.85 21.15Q816-773.7 816-744v528q0 29.7-21.15 50.85Q773.7-144 744-144H480Zm-72-168-51-51 81-81H144v-72h294l-81-81 51-51 168 168-168 168Z" />
                            </svg>
                            <p>AUTENTICAR</p>
                        </div>

                    </button>

                </form>

                <p class="textoEntrar">
                    Não tem uma conta?
                    <a href="registro.php">Criar conta</a>
                </p>

            </div>
        </div>

    </main>

    <?php include __DIR__ . '/components/footer.php'; ?>
</body>

</html>