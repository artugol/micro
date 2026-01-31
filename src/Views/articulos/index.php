<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artículos - MicroFramework</title>
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
        th { background: #007bff; color: white; }
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
        
        <h1>Lista de Artículos</h1>
        <a href="/articulos/crear" class="btn">+ Nuevo Artículo</a>
        
        <?php if (empty($articulos)): ?>
            <p>No hay artículos registrados.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articulos as $articulo): ?>
                        <tr>
                            <td><?= htmlspecialchars($articulo['id']) ?></td>
                            <td><?= htmlspecialchars($articulo['titulo']) ?></td>
                            <td><?= htmlspecialchars($articulo['descripcion']) ?></td>
                            <td>$<?= number_format($articulo['precio'], 2) ?></td>
                            <td><?= htmlspecialchars($articulo['stock']) ?></td>
                            <td class="actions">
                                <a href="/articulos/editar?id=<?= $articulo['id'] ?>" class="btn">Editar</a>
                                <a href="/articulos/eliminar?id=<?= $articulo['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Eliminar este artículo?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
