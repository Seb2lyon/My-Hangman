<?php

include('includes/layout.php');

unset($_SESSION['level']);
unset($_SESSION['word']);
unset($_SESSION['nb_letters']);
unset($_SESSION['mystery']);
unset($_SESSION['alphabet']);
unset($_SESSION['played']);
unset($_SESSION['errors']);
unset($_SESSION['win']);
unset($_SESSION['loose']);

?>

		Accueil</title>

	</head>

	<body>

		<?php include('includes/header.php'); ?>

		<img class="potence" src="images/potence.jpg" alt="Potence" />

		<p class="rules">Le jeu du pendu est un célèbre jeu dont le but est de deviner un mot en proposant des lettres. 
		Mais vous avez droit à un nombre limité d'erreurs... et chaque nouvelle erreur rapproche le malheureux condamné de la potence!</p>

		<br />

		<p>Choisissez votre niveau de difficulté :</p>
		<ul>
			<li><a href="index.php?level=1">Facile :</a> vous avez le droit à 8 erreurs</li>
			<li><a href="index.php?level=2">Moyen :</a> vous avez le droit à 6 erreurs</li>
			<li><a href="index.php?level=3">Difficile :</a> vous avez le droit à 4 erreurs</li>
		</ul>

		<?php

		if($_GET != NULL)
		{
			if(isset($_GET['level']))
			{
				if($_GET['level'] == 1 OR $_GET['level'] == 2 OR $_GET['level'] == 3)
				{
					$_SESSION['level'] = $_GET['level'];
					header('location: partie.php');
				}
				else
				{
					echo "<p class='error'>Ce niveau n'existe pas</p>";
				}
			}
			else
			{
				echo "<p class='error'>ERREUR...</p>";
			}
		}

		include('includes/footer.php'); 

		?>

	</body>

</html>