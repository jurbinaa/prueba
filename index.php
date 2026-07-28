<?php
declare(strict_types=1);

$server   = $_SERVER['SERVER_SOFTWARE'] ?? 'nginx';
$phpVer   = phpversion();
$hostname = gethostname() ?: 'desconocido';
$ip       = $_SERVER['SERVER_ADDR'] ?? 'desconocido';
$port     = $_SERVER['SERVER_PORT'] ?? '?';
$now      = date('Y-m-d H:i:s');
$uptime   = @shell_exec('uptime -p') ?: null;

// Un ejemplo simple usando enums (PHP 8.1+) solo para mostrar que corre bien
enum Estado: string {
    case OK = 'operativo';
    case DEGRADADO = 'degradado';
}
$estado = Estado::OK;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ulaloud — CI/CD funcionando</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
            background: #0f0f1a;
            color: #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 2rem;
        }
        .container {
            text-align: center;
            max-width: 640px;
        }
        h1 {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #a855f7, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }
        .subtitle {
            color: #64748b;
            font-size: 1rem;
            margin-bottom: 2rem;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
            text-align: left;
            background: #171725;
            border: 1px solid #2a2a3d;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .info-item { font-size: 0.95rem; color: #94a3b8; }
        .info-item span {
            display: block;
            color: #e2e8f0;
            font-weight: 600;
            font-family: ui-monospace, monospace;
            margin-top: 0.15rem;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border-radius: 999px;
            background: rgba(74, 222, 128, 0.12);
            border: 1px solid rgba(74, 222, 128, 0.35);
            color: #4ade80;
            font-weight: 600;
            font-size: 0.95rem;
        }
        .badge::before { content: "●"; font-size: 0.7rem; }
        .footer {
            margin-top: 2rem;
            font-size: 0.8rem;
            color: #475569;
        }
        code {
            background: #1e293b;
            padding: 0.15rem 0.4rem;
            border-radius: 4px;
            color: #a855f7;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ulaloud</h1>
        <p class="subtitle">Deploy vía Git CI/CD — <code><?= htmlspecialchars($estado->value) ?></code></p>

        <div class="info-grid">
            <div class="info-item">Servidor
                <span><?= htmlspecialchars($server) ?></span>
            </div>
            <div class="info-item">PHP
                <span><?= htmlspecialchars($phpVer) ?></span>
            </div>
            <div class="info-item">Hostname
                <span><?= htmlspecialchars($hostname) ?></span>
            </div>
            <div class="info-item">Puerto
                <span><?= htmlspecialchars((string)$port) ?></span>
            </div>
            <div class="info-item">Fecha de carga
                <span><?= htmlspecialchars($now) ?></span>
            </div>
            <div class="info-item">Uptime
                <span><?= htmlspecialchars(trim($uptime ?? 'n/d')) ?></span>
            </div>
        </div>

        <div class="badge">Deploy exitoso — CI/CD activo</div>

        <p class="footer">
            Cada <code>git push</code> a <code>main</code> + restart del servidor
            actualiza esta página automáticamente.
        </p>
    </div>
</body>
</html>