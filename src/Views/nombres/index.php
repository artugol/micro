<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nombres - MicroFramework</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #333; margin-bottom: 20px; }
        nav { margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid #007bff; }
        nav a { margin-right: 15px; color: #007bff; text-decoration: none; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        .btn { display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; margin-bottom: 20px; }
        .btn:hover { background: #0056b3; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #28a745; color: white; }
        tr:hover { background: #f8f9fa; }
        .actions a { margin-right: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <a href="/articulos">Artículos</a>
            <a href="/nombres">Nombres</a>
        </nav>
        
        <h1>Lista de Nombres</h1>
        <a href="/nombres/crear" class="btn">+ Nuevo Nombre</a>
        
        <?php if (empty($nombres)): ?>
            <p>No hay nombres registrados.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($nombres as $nombre): ?>
                        <tr>
                            <td><?= htmlspecialchars($nombre['id']) ?></td>
                            <td><?= htmlspecialchars($nombre['nombre']) ?></td>
                            <td><?= htmlspecialchars($nombre['apellidos']) ?></td>
                            <td><?= htmlspecialchars($nombre['email']) ?></td>
                            <td><?= htmlspecialchars($nombre['telefono']) ?></td>
                            <td class="actions">
                                <a href="/nombres/editar?id=<?= $nombre['id'] ?>" class="btn">Editar</a>
                                <a href="/nombres/eliminar?id=<?= $nombre['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Eliminar este registro?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
