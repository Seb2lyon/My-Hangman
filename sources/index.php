<?php

session_start();

/*********************************************************************/
/*                        -- My Hangman --                           */
/*    This web application was designed and developped by Seb2lyon   */
/*                   First released in 06.24.2015                    */
/*                           ----------                              */
/*         This version is the last updated one - version 1.1        */
/*                           06.03.2017                              */
/*                           ----------                              */
/*                            Enjoy :D                               */
/*********************************************************************/

unset($_SESSION['level']);
unset($_SESSION['word']);
unset($_SESSION['nb_letters']);
unset($_SESSION['mystery']);
unset($_SESSION['alphabet']);
unset($_SESSION['played']);
unset($_SESSION['errors']);
unset($_SESSION['win']);
unset($_SESSION['loose']);

if(isset($_GET['level']))
{
	if($_GET['level'] == 1 OR $_GET['level'] == 2 OR $_GET['level'] == 3)
	{
		$_SESSION['level'] = $_GET['level'];
		header('location: partie.php');
	}
}


?>

<!DOCTYPE html>

<html>

	<head>

		<meta charset="UTF-8" />
		<meta name="viewport " content="width=device-width" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="icon" type="image/png" href="images/favicon.png" />
		<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" /><![endif]-->
		<!--[if lt IE 9]>
			<script src=" http://html5shiv.googlecode.com/svn/trunk/html5.js"></script >
		<![endif]-->

		<title>Jeu du pendu - Accueil</title>

	</head>

	<body>

		<h1>JEU DU PENDU</h1>

		<img class="arabesque" src="images/arabesque.png" alt="Arabesque" />

		<br />

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
				if($_GET['level'] != 1 AND $_GET['level'] != 2 AND $_GET['level'] != 3)
				{
					echo "<p class='error'>Ce niveau n'existe pas</p>";
				}
			}
			else
			{
				echo "<p class='error'>ERREUR...</p>";
			}
		}

		?>

		<footer>

			<p>Seb2lyon - version 1.1 - 06/03/2017<a href="http://seb2lyon.info.free.fr">Accueil</a><a href="https://github.com/Seb2lyon/My-Hangman">Sources (GitHub)</a><a href="https://www.gnu.org/licenses/gpl.txt">Licence GPL v.3</a></p>

		</footer>

	</body>

</html>
