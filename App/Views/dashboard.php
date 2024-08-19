<!-- App/Views/dashboard.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($session->get('user_name')); ?></h1>
    
    <?php if ($flash = $session->getFlash('success')): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($flash); ?></div>
    <?php endif; ?>

    <!-- Resto del contenido del dashboard -->
</body>
</html>