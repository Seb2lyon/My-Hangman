<?php

session_start();

if(!isset($_SESSION['level']) OR $_SESSION['level'] == NULL)
{
	header('Location: index.php');
}


if(!isset($_SESSION['word']))
{
	try
	{
	 	$bdd = new PDO('mysql:host=localhost;dbname=id1013912_seb2lyon;charset=utf8', 'id1013912_seb2lyon', 'PatSeb6974');
		$bdd->exec('SET NAMES utf8');
	}
	catch(Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

	$request = $bdd->query('SELECT COUNT(*) AS number_words FROM dictionary');
	$data = $request->fetch();
	$words_max = $data['number_words'];
	$request->closeCursor();

	$random = rand(1, $words_max);

	$request = $bdd->prepare('SELECT word FROM dictionary WHERE id = :id');
	$request->execute(array('id'=>$random));
	$data = $request->fetch();
	$_SESSION['word'] = $data['word'];
	$request->closeCursor();

	$_SESSION['nb_letters'] = strlen($_SESSION['word']);

	for ($i=0; $i < $_SESSION['nb_letters']; $i++)
	{
		$_SESSION['mystery'][$i] = '_';
	}

	$_SESSION['alphabet'] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$_SESSION['played']   = '00000000000000000000000000';

	switch ($_SESSION['level']) 
	{
		case 1:
			$_SESSION['errors'] = 8;
			break;

		case 2:
			$_SESSION['errors'] = 6;
			break;

		case 3:
			$_SESSION['errors'] = 4;
			break;
	}

	$_SESSION['loose'] = 0;
	$_SESSION['win'] = 0;
}

if($_GET != NULL)
{
	if(isset($_GET['letter']))
	{
		if(preg_match('#' . $_GET['letter'] . '#', $_SESSION['alphabet']))
		{
			for ($i=0; $i < 26; $i++) 
			{ 
				if($_SESSION['alphabet'][$i] == $_GET['letter'])
				{
					if($_SESSION['played'][$i] == 0)
					{
						$good = 0;

						$_SESSION['played'][$i] = 1;

						for ($i=0; $i < $_SESSION['nb_letters']; $i++) 
						{ 
							if($_SESSION['word'][$i] == $_GET['letter'])
							{
								$_SESSION['mystery'][$i] = $_GET['letter'];

								$good = 1;
							}
						}

						if($good == 0)
						{
							$_SESSION['errors'] = $_SESSION['errors'] - 1;
						}

						header('Location: partie.php');
					}
					else
					{
						header('Location: partie.php');
					}
				}
			}
		}
		else
		{
			header('Location: partie.php');
		}
	}
	else
	{
		header('Location: partie.php');
	}
}

if($_SESSION['loose'] == 1 OR $_SESSION['win'])
{
	if(isset($_GET['letter']))
	{
		header('Location: index.php');
	}
}

$mystery = implode(0, $_SESSION['mystery']);

if($_SESSION['errors'] <= 0 AND preg_match('#_#', $mystery))
{
	$_SESSION['loose'] = 1;
}

if($_SESSION['errors'] >= 0 AND !preg_match('#_#', $mystery))
{
	$_SESSION['win'] = 1;
}

include('includes/layout.php');

?>

		Partie</title>

	</head>

	<body>

		<?php include('includes/header.php'); ?>

		<?php

		if($_SESSION['loose'] == 1)
		{
			echo '<p class="rules2">Le mot mystère était :</p>';
		}
		else
		{
			echo '<p class="rules2">Mot mystère :</p>';
		}

		?>

		<section class="word">

			<table class="mystery">

				<tr>

					<?php

						if($_SESSION['loose'] == 1)
						{
							for ($i=0; $i < $_SESSION['nb_letters']; $i++) 
							{ 
								echo '<td>' . $_SESSION['word'][$i] . '</td>';
							}
						}
						else
						{
							for ($i=0; $i < $_SESSION['nb_letters']; $i++) 
							{ 
								echo '<td>' . $_SESSION['mystery'][$i] . '</td>';
							}
						}						

					?>

				</tr>

			</table>

			<br />

			<table class="alphabet">

				<tr>

					<?php

						for ($i=0; $i < 7; $i++) 
						{ 
							if($_SESSION['played'][$i] == 0)
							{
								if($_SESSION['win'] == 1 OR $_SESSION['loose'] == 1)
								{
									echo '<td class="not_played">' . $_SESSION['alphabet'][$i] . '</td>';
								}
								else
								{
									echo '<td class="not_played"><a href="partie.php?letter=' . $_SESSION['alphabet'][$i] . '">' . $_SESSION['alphabet'][$i] . '</a></td>';
								}
							}
							else
							{
								echo '<td class="played">' . $_SESSION['alphabet'][$i] . '</td>';
							}
						}

					?>

				</tr>
				<tr>

					<?php

						for ($i=7; $i < 14; $i++) 
						{ 
							if($_SESSION['played'][$i] == 0)
							{
								if($_SESSION['win'] == 1 OR $_SESSION['loose'] == 1)
								{
									echo '<td class="not_played">' . $_SESSION['alphabet'][$i] . '</td>';
								}
								else
								{
									echo '<td class="not_played"><a href="partie.php?letter=' . $_SESSION['alphabet'][$i] . '">' . $_SESSION['alphabet'][$i] . '</a></td>';
								}
							}
							else
							{
								echo '<td class="played">' . $_SESSION['alphabet'][$i] . '</td>';
							}
						}

					?>

				</tr>
				<tr>

					<?php

						for ($i=14; $i < 21; $i++) 
						{ 
							if($_SESSION['played'][$i] == 0)
							{
								if($_SESSION['win'] == 1 OR $_SESSION['loose'] == 1)
								{
									echo '<td class="not_played">' . $_SESSION['alphabet'][$i] . '</td>';
								}
								else
								{
									echo '<td class="not_played"><a href="partie.php?letter=' . $_SESSION['alphabet'][$i] . '">' . $_SESSION['alphabet'][$i] . '</a></td>';
								}
							}
							else
							{
								echo '<td class="played">' . $_SESSION['alphabet'][$i] . '</td>';
							}
						}

					?>

				</tr>
				<tr>

					<td></td>

					<?php

						for ($i=21; $i < 26; $i++) 
						{ 
							if($_SESSION['played'][$i] == 0)
							{
								if($_SESSION['win'] == 1 OR $_SESSION['loose'] == 1)
								{
									echo '<td class="not_played">' . $_SESSION['alphabet'][$i] . '</td>';
								}
								else
								{
									echo '<td class="not_played"><a href="partie.php?letter=' . $_SESSION['alphabet'][$i] . '">' . $_SESSION['alphabet'][$i] . '</a></td>';
								}
							}
							else
							{
								echo '<td class="played">' . $_SESSION['alphabet'][$i] . '</td>';
							}
						}

					?>

					<td></td>

				</tr>

			</table>

		</section>

		<section class="hangman"> 

			<?php 

			if($_SESSION['win'] == 1)
			{
				echo '<img src="images/gagne.gif" class="hangman_img" alt="Pendu" />';
			}
			else if($_SESSION['errors'] == 0)
			{
				echo '<img src="images/' . $_SESSION['level'] . '-' . $_SESSION['errors'] . '.gif" class="hangman_img" alt="Pendu" />';
			}
			else
			{
				echo '<img src="images/' . $_SESSION['level'] . '-' . $_SESSION['errors'] . '.jpg" class="hangman_img" alt="Pendu" />';
			}

			if($_SESSION['win'] == 1)
			{
				echo '<p class="win">BRAVO, vous avez gagné !!!</p>';
			}
			else if($_SESSION['loose'] == 1)
			{
				echo '<p class="loose">Dommage, vous avez perdu...</p>';
			}
			else
			{
				if($_SESSION['errors'] > 1)
				{
					echo '<p class="trys">Il vous reste ' . $_SESSION['errors'] . ' essais</p>'; 
				}
				else
				{
					echo '<p class="trys">Il vous reste ' . $_SESSION['errors'] . ' essai</p>'; 
				}
			}

			if($_SESSION['win'] == 1)
			{
				echo '<img src="images/gagne.gif" class="hangman_img_mobile" alt="Pendu" />';
			}
			else if($_SESSION['errors'] == 0)
			{
				echo '<img src="images/' . $_SESSION['level'] . '-' . $_SESSION['errors'] . '.gif" class="hangman_img_mobile" alt="Pendu" />';
			}
			else
			{
				echo '<img src="images/' . $_SESSION['level'] . '-' . $_SESSION['errors'] . '.jpg" class="hangman_img_mobile" alt="Pendu" />';
			}


			?>

		</section>

		<?php

		if($_SESSION['win'] == 0 AND $_SESSION['loose'] == 0)
		{
			echo '<p><a href="index.php">Annuler la partie</a></p>';
		}
		else
		{
			echo '<p><a href="index.php">Faire une autre partie</a></p>';
		}

		?>

		<br /><br />

		<?php include('includes/footer.php'); ?>

	</body>

</html>
