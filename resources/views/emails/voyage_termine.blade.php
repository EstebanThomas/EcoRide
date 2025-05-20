<h2>Bonjour {{ $utilisateur->pseudo }},</h2>

<p>Nous vous informons que le covoiturage de <strong>{{ $voyage->lieu_depart }}</strong> à <strong>{{ $voyage->lieu_arrivee }}</strong> le <strong>{{ \Carbon\Carbon::parse($voyage->date_depart)->format('d/m/Y') }}</strong> est terminé.</p>

<p>Veuillez vous rendre dans votre espace afin de donner votre avis sur le déroulement du voyage.</p>

<p>Merci de votre compréhension,
EcoRide.</p>