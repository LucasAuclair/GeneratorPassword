<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générateur de mots de passe</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <main class="container">
        <h1>Générateur de mots de passe</h1>

        <!-- Section Génération -->
        <div class="section">
            <h2>Générateur de mots de passe</h2>
            <p class="hint">Générez des mots de passe hautement sécurisés.</p>
            
            <span class="label">Mot de passe fort :</span>
            <div class="output-box">{{ $password }}</div>

            <div class="links">
                <span class="label">Changer la longueur :</span>
                <a href="/password/12">12 caractères</a>
                <a href="/password/24">24 caractères</a>
                <a href="/password/32">32 caractères</a>
                <a href="/">Réinitialiser (16)</a>
            </div>
        </div>

        <!-- Section vérification -->
        <div class="section">
            <h2>Validateur de force</h2>
            <form action="{{ route('password.audit') }}" method="POST">
                @csrf
                <input type="text" name="user_password" placeholder="Saisissez un mot de passe à tester..." required value="{{ $result['password'] ?? '' }}">
                <button type="submit">Analyser la résistance</button>
            </form>

            <!-- Affichage du résultat -->
            @if(isset($result))
                <div class="result" style="border-left-color: {{ $result['color'] }};">
                    <div class="result-title">Résultat : <span style="color: {{ $result['color'] }}">{{ $result['label'] }}</span></div>
                    
                    @if(!empty($result['feedback']))
                        <ul>
                            @foreach($result['feedback'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="success">✓ Ce mot de passe respecte les critères de sécurité.</p>
                    @endif
                </div>
            @endif
        </div>

        <footer>
            Génération de mots de passe et vérification de sécurité avec Laravel.
        </footer>
    </main>

</body>
</html>
