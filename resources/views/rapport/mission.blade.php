<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport Mission</title>
    <style>
        body { font-family: sans-serif; }
        p { font-size: 14px; margin: 8px 0; }
    </style>
</head>
<body>
    <h2>Rapport de Mission</h2>
    <p><strong>Mission :</strong> {{ $mission->missions }}</p>
    <p><strong>Client :</strong> {{ $mission->client }}</p>
    <p><strong>Lieu :</strong> {{ $mission->lieu }}</p>
    <p><strong>Date début :</strong> {{ $mission->datedebut }}</p>
    <p><strong>Date fin :</strong> {{ $mission->datefin }}</p>
    <p><strong>Durée :</strong> {{ $mission->duree }} jours</p>
</body>
</html>
