<!DOCTYPE html>
<html>
<head>
    <title>Bienvenue chez TaskFlow</title>
</head>
<body>
    <h1>Bonjour {{ $user->first_name }} {{ $user->last_name }},</h1>
    <p>Bienvenue dans l'équipe ! Votre compte a été créé avec succès.</p>
    <p>Vous pouvez maintenant vous connecter avec les identifiants suivants :</p>
    <ul>
        <li><strong>Email :</strong> {{ $user->email }}</li>
        <li><strong>Mot de passe :</strong> {{ $password }}</li>
    </ul>
    <p>Nous vous recommandons de changer votre mot de passe dès votre première connexion.</p>
    <p>Cordialement,<br>L'équipe TaskFlow</p>
</body>
</html>
