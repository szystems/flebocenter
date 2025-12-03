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
        
        $pdo = new PDO(
            'mysql:host=szclinicascom.ipagemysql.com;dbname=dbflebocenternuevo;charset=utf8mb4',
            'sz',
            'SPP7007aaa@@@'
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            $hasher = new \Illuminate\Hashing\BcryptHasher();
            
            if ($hasher->check($password, $user['password'])) {
                // Generar session ID
                $sessionId = \Illuminate\Support\Str::random(40);
                
                // Crear payload en formato Laravel (serializado)
                $guardName = 'web';
                $sessionData = [
                    '_token' => \Illuminate\Support\Str::random(40),
                    '_previous' => ['url' => 'https://www.flebocenter.com/dashboard'],
                    '_flash' => [
                        'old' => [],
                        'new' => [
                            'status' => 'Bienvenido a FLEBOCENTER'
                        ]
                    ],
                    'login_' . $guardName . '_' . sha1('Illuminate\\Auth\\SessionGuard') => $user['id'],
                    'password_hash_' . $guardName => $user['password'],
                    'url' => [
                        'intended' => 'https://www.flebocenter.com/dashboard'
                    ]
                ];
                
                // Serializar como Laravel lo hace
                $serialized = serialize($sessionData);
                $payload = base64_encode($serialized);
                
                // Insertar en BD
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
                
                // Cookie sin cifrar (Laravel la cifrará automáticamente)
                setcookie(
                    'app_session',
                    $sessionId,
                    [
                        'expires' => time() + (480 * 60),
                        'path' => '/',
                        'domain' => '.flebocenter.com',
                        'secure' => true,
                        'httponly' => true,
                        'samesite' => 'Lax'
                    ]
                );
                
                $loginSuccess = true;
                $loginType = 'success';
                $loginMessage = '<strong>✅ ¡Login Exitoso!</strong><br>' .
                               'Bienvenido, ' . htmlspecialchars($user['name']) . '<br>' .
                               'User ID: ' . $user['id'] . '<br>' .
                               'Session ID: ' . substr($sessionId, 0, 20) . '...<br>' .
                               '<br><strong>Redirigiendo al dashboard...</strong>';
                
                $redirectScript = '<script>setTimeout(function() { window.location.href = "/dashboard"; }, 1500);</script>';
                
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
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dashboardtemplate/design/assets/css/bootstrap.min.css">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="dashboardtemplate/design/assets/fonts/bootstrap/bootstrap-icons.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #ffffff;
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
        
        .logo-section {
        .logo-section {
            text-align: center;
            margin-bottom: 35px;
        }
        
        .logo-img {
            max-width: 200px;
            height: auto;
            margin-bottom: 20px;
        }
        h1 {
            color: #1e293b;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .subtitle {
            color: #64748b;
            font-size: 15px;
            font-weight: 400;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            color: #334155;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        label i {
            color: #0061f2;
            font-size: 16px;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        input[type="email"],
        input[type="password"] {
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 97, 242, 0.4);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            animation: slideIn 0.3s ease;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .alert-success {
            background: #d1fae5;
            border: 2px solid #6ee7b7;
            color: #065f46;
        }
        
        .alert-success i {
            color: #10b981;
            font-size: 24px;
        }
        
        .alert-error {
            background: #fee2e2;
            border: 2px solid #fca5a5;
            color: #991b1b;
        }
        
        .alert-error i {
            color: #ef4444;
            font-size: 24px;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e2e8f0;
        }
        
        .footer p {
            color: #94a3b8;
            font-size: 13px;
            margin: 0;
        }
        
        .loading {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Responsive */
        @media (max-width: 576px) {
            .login-container {
                padding: 35px 30px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .logo-icon {
                width: 70px;
                height: 70px;
            }
            
            .logo-icon i {
                font-size: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <div class="logo-icon">
                <i class="bi bi-heart-pulse-fill"></i>
            </div>
            <h1>FleboCenter</h1>
            <p class="subtitle">Sistema de Gestión Clínica</p>
        </div>

        <?php if ($loginMessage): ?>
            <div class="alert alert-<?php echo $loginType; ?>">
                <i class="bi bi-<?php echo $loginType === 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill'; ?>"></i>
    <div class="login-container">
        <div class="logo-section">
            <img src="assets/imgs/logos/logopng.png" alt="FleboCenter" class="logo-img">
            <h1>FleboCenter</h1>
            <p class="subtitle">Sistema de Gestión Clínica</p>
        </div>  <label for="email">
                    <i class="bi bi-envelope-fill"></i>
                    Correo Electrónico
                </label>
                <div class="input-wrapper">
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="tu-email@ejemplo.com"
                        value=""
                        required 
                        autofocus
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="password">
                    <i class="bi bi-lock-fill"></i>
                    Contraseña
                </label>
                <div class="input-wrapper">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="••••••••"
                        required
                    >
                </div>
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

    <script>
        // Auto-enfoque en el campo de email al cargar
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');
            if (emailInput && !emailInput.value) {
                emailInput.focus();
            }
        });
        
        // Agregar loading al botón al enviar
        const form = document.querySelector('form');
        const submitBtn = form.querySelector('.btn-login');
        form.addEventListener('submit', function() {
            submitBtn.innerHTML = '<span class="loading"></span> Iniciando sesión...';
            submitBtn.disabled = true;
        });
    </script>
</body>
</html>
