<?php
/**
 * Login Manual DEFINITIVO - Con payload compatible con Laravel
 */

ob_start();

$loginSuccess = false;
$loginMessage = '';
$loginType = '';
$redirectScript = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    try {
        require_once __DIR__ . '/../vendor/autoload.php';
        
        // CONFIGURACIÓN: Cambiar según ambiente (local o producción)
        $isLocal = true; // Cambiar a false para producción
        
        if ($isLocal) {
            // Conexión LOCAL
            $pdo = new PDO(
                'mysql:host=127.0.0.1;dbname=dbflebocenternuevo;charset=utf8mb4',
                'root',
                'root123'
            );
        } else {
            // Conexión PRODUCCIÓN (iPage)
            $pdo = new PDO(
                'mysql:host=szclinicascom.ipagemysql.com;dbname=dbflebocenternuevo;charset=utf8mb4',
                'sz',
                'SPP7007aaa@@@'
            );
        }
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // DEBUG TEMPORAL
        echo "Email buscado: " . htmlspecialchars($email) . "<br>";
        echo "Usuario encontrado: " . ($user ? 'SÍ - ID: ' . $user['id'] . ' - ' . $user['name'] : 'NO') . "<br>";
        
        if ($user) {
            $hasher = new \Illuminate\Hashing\BcryptHasher();
            $passwordMatch = $hasher->check($password, $user['password']);
            echo "Password ingresado: " . htmlspecialchars($password) . "<br>";
            echo "Password correcto: " . ($passwordMatch ? '✅ SÍ' : '❌ NO') . "<br>";
            
            if ($passwordMatch) {
                $sessionId = \Illuminate\Support\Str::random(40);
                
                $guardName = 'web';
                $sessionData = [
                    '_token' => \Illuminate\Support\Str::random(40),
                    '_previous' => ['url' => 'https://www.flebocenter.com/dashboard'],
                    '_flash' => [
                        'old' => [],
                        'new' => ['status' => 'Bienvenido a FLEBOCENTER']
                    ],
                    'login_' . $guardName . '_' . sha1('Illuminate\\Auth\\SessionGuard') => $user['id'],
                    'password_hash_' . $guardName => $user['password'],
                    'url' => ['intended' => 'https://www.flebocenter.com/dashboard']
                ];
                
                $serialized = serialize($sessionData);
                $payload = base64_encode($serialized);
                
                $stmt = $pdo->prepare("
                    REPLACE INTO sessions (id, user_id, ip_address, user_agent, payload, last_activity)
                    VALUES (:id, :user_id, :ip, :user_agent, :payload, :last_activity)
                ");
                
                $stmt->execute([
                    'id' => $sessionId,
                    'user_id' => $user['id'],
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'payload' => $payload,
                    'last_activity' => time()
                ]);
                
                // Configurar cookie según ambiente
                $cookieName = $isLocal ? 'flebocenter_session' : 'app_session'; // Usar el mismo nombre que Laravel
                $cookieOptions = [
                    'expires' => time() + (480 * 60),
                    'path' => '/',
                    'domain' => $isLocal ? '' : '.flebocenter.com', // Sin dominio en local
                    'secure' => !$isLocal, // Solo HTTPS en producción
                    'httponly' => true,
                    'samesite' => 'Lax'
                ];
                
                $cookieSet = setcookie($cookieName, $sessionId, $cookieOptions);
                
                // DEBUG: Verificar cookie y sesión
                echo "<br>Cookie establecida: " . ($cookieSet ? '✅ SÍ' : '❌ NO') . "<br>";
                echo "Session ID: " . htmlspecialchars($sessionId) . "<br>";
                echo "User ID guardado en sesión: " . $user['id'] . "<br>";
                echo "<br><strong>Redirigiendo en 3 segundos...</strong><br>";
                
                $loginSuccess = true;
                $loginType = 'success';
                $loginMessage = '<strong>✅ ¡Login Exitoso!</strong><br>Bienvenido, ' . htmlspecialchars($user['name']) . '<br><br><strong>Redirigiendo al dashboard...</strong>';
                $redirectScript = '<script>setTimeout(function() { window.location.href = "/dashboard"; }, 3000);</script>';
                
            } else {
                $loginType = 'error';
                $loginMessage = '<strong>❌ Contraseña incorrecta</strong>';
            }
        } else {
            $loginType = 'error';
            $loginMessage = '<strong>❌ Usuario no encontrado</strong>';
        }
        
    } catch (Exception $e) {
        $loginType = 'error';
        $loginMessage = '<strong>❌ Error:</strong><br>' . htmlspecialchars($e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FleboCenter</title>
    <link rel="stylesheet" href="dashboardtemplate/design/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="dashboardtemplate/design/assets/fonts/bootstrap/bootstrap-icons.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-container {
            background: white;
            padding: 50px 45px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            max-width: 450px;
            width: 100%;
        }
        .logo-section { text-align: center; margin-bottom: 35px; }
        .logo-img { max-width: 200px; height: auto; margin-bottom: 20px; }
        h1 { color: #1e293b; font-size: 28px; font-weight: 700; margin-bottom: 8px; }
        .subtitle { color: #64748b; font-size: 15px; font-weight: 400; }
        .form-group { margin-bottom: 25px; }
        label { display: block; margin-bottom: 10px; color: #334155; font-weight: 600; font-size: 14px; }
        label i { color: #0061f2; font-size: 16px; margin-right: 8px; }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8fafc;
        }
        input:focus {
            outline: none;
            border-color: #0061f2;
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 97, 242, 0.1);
        }
        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #0061f2 0%, #6900c7 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 97, 242, 0.4);
        }
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
            animation: slideIn 0.3s ease;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .alert-success { background: #d1fae5; border: 2px solid #6ee7b7; color: #065f46; }
        .alert-error { background: #fee2e2; border: 2px solid #fca5a5; color: #991b1b; }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e2e8f0;
        }
        .footer p { color: #94a3b8; font-size: 13px; margin: 0; }
        @media (max-width: 576px) {
            .login-container { padding: 35px 30px; }
            h1 { font-size: 24px; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <img src="assets/imgs/logos/logopng.png" alt="FleboCenter" class="logo-img" onerror="this.style.display='none'">
            <!-- <h1>FleboCenter</h1> -->
            <p class="subtitle">Sistema de Gestión Clínica</p>
        </div>

        <?php if ($loginMessage): ?>
            <div class="alert alert-<?php echo $loginType; ?>">
                <?php echo $loginMessage; ?>
            </div>
            <?php echo $redirectScript; ?>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="email">
                    <i class="bi bi-envelope-fill"></i>
                    Correo Electrónico
                </label>
                <input type="email" id="email" name="email" placeholder="tu-email@ejemplo.com" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">
                    <i class="bi bi-lock-fill"></i>
                    Contraseña
                </label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right"></i>
                Iniciar Sesión
            </button>
        </form>

        <div class="footer">
            <p><i class="bi bi-shield-check"></i> Conexión segura • FleboCenter © <?php echo date('Y'); ?></p>
        </div>
    </div>
</body>
</html>
