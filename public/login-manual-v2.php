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
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login FleboCenter</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            max-width: 400px;
            width: 100%;
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }
        .subtitle {
            color: #666;
            text-align: center;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 600;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        input:focus {
            outline: none;
            border-color: #667eea;
        }
        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
        .alert-success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        .alert-error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🏥 FleboCenter</h1>
        <p class="subtitle">Iniciar Sesión</p>

        <?php if ($loginMessage): ?>
            <div class="alert alert-<?php echo $loginType; ?>">
                <?php echo $loginMessage; ?>
            </div>
            <?php echo $redirectScript; ?>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="email">📧 Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="szystems@hotmail.com"
                    required 
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">🔒 Contraseña</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required
                >
            </div>

            <button type="submit">🚀 Iniciar Sesión</button>
        </form>

        <p style="text-align: center; margin-top: 20px; font-size: 12px; color: #999;">
            FleboCenter © <?php echo date('Y'); ?>
        </p>
    </div>
</body>
</html>
