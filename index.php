<?php
		/* ************************************************************************** */
		/*                                                                            */
		/*                                                        :::      ::::::::   */
		/*   index.php                                          :+:      :+:    :+:   */
		/*                                                    +:+ +:+         +:+     */
		/*   By: tloudoux <tloudoux@student.42.fr>          +#+  +:+       +#+        */
		/*                                                +#+#+#+#+#+   +#+           */
		/*   Created: 2023/04/27 18:55:14 by tloudoux          #+#    #+#             */
		/*   Updated: 2023/04/27 18:55:14 by tloudoux         ###   ########.fr       */
		/*                                                                            */
		/* ************************************************************************** */

// Setup des variable global 
// Tableau donné dans la consigne. 
$travels = [

	0 => ['departure' => 'Paris', 'arrival' => 'Nantes', 'departureTime'=> '11:00', 'arrivalTime'=> '12:34', 'driver'=>'Thomas'],
	
	1 => ['departure' => 'Orléans', 'arrival' => 'Nantes', 'departureTime'=> '05:15', 'arrivalTime'=> '09:32', 'driver'=>'Mathieu'],
	
	2 => ['departure' => 'Dublin', 'arrival' => 'Tours', 'departureTime'=> '07:23', 'arrivalTime'=> '08:50', 'driver'=>'Nathanaël'],
	
	3 => ['departure' => 'Paris', 'arrival' => 'Orléans', 'departureTime'=> '03:00', 'arrivalTime'=> '05:26', 'driver'=>'Clément'],
	
	4 => ['departure' => 'Paris', 'arrival' => 'Nice', 'departureTime'=> '10:00', 'arrivalTime'=> '12:09', 'driver'=>'Audrey'],
	
	5 => ['departure' => 'Nice', 'arrival' => 'Nantes', 'departureTime'=> '10:40', 'arrivalTime'=> '13:00', 'driver'=>'Pollux'],
	
	6 => ['departure' => 'Nice', 'arrival' => 'Tours', 'departureTime'=> '11:00', 'arrivalTime'=> '16:10', 'driver'=>'Edouard'],
	
	7 => ['departure' => 'Tours', 'arrival' => 'Amboise', 'departureTime'=> '16:00', 'arrivalTime'=> '18:40', 'driver'=>'Priscilla'],
	
	8 => ['departure' => 'Nice', 'arrival' => 'Nantes', 'departureTime'=> '12:00', 'arrivalTime'=> '16:00', 'driver'=>'Charlotte'],
	
	];

// déclaration de la liste des villes de départ
	$departure = array();
	foreach ($travels as $key => $values) //On parcours toute la liste travels 
	{
		array_push($departure, $values['departure']); //on ajoute la ville de départ dans notre liste de ville 
		$departure = array_unique($departure); // on verifie si il y a un doublon et on le supprime 
	}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Devoir 1</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<form action="#" method="post">
		<label for="firstname">Nom :</label>
		<input type="text" name="name" placeholder="Nom" id="firstname">
		<label for="email">Email :</label>
		<input type="email" name="email" placeholder="exemple.email@domain.subdomain">
		<label for="phone">Numéro de Téléphone :</label>
		<input type="tel" name="phone" placeholder="Ton Numéro de Téléphone">
		<label for="departure">Ville de départ :</label>
		<select name="departure" id="departure">
		<option value="">--Choisissez une option--</option>
		<!-- création automatique du tableau déroulant en fonction des trajet disponible dans la base de donnée -->
		<?php 
		
		foreach($departure as $key => $value) // on parcours la liste des ville de départ disponible 
		{
			echo "<option value='". $value. "'>". $value . "</option>"; // on insert une option pour chaque ville disponible 
		}
		?>
		</select>
		<input type="submit" name="submit" value="Recherche">

	<?php 
	if (isset($_POST["submit"])) // si nous avons envoyer le formulaire
	{
		/*
		# j'ai choisi ici une condition switch-case car nous devons verifier chaque entré pour lancer le message
		# je trouve que le switch-case ajoute une lisibilité et une meilleure compréhention de ce que je veux faire.
		*/
		switch($_POST) 
		{
			case empty($_POST['name']) and empty($_POST['email']) and empty($_POST['phone']) and $_POST['departure'] == "":
				echo "<p class='error'>Vous devez remplir le formulaire !</p>";
				break;
			case empty($_POST['name']):
				echo "<p class='error'>Vous devez remplir le nom</p>";
				break;
			case empty($_POST['email']):
				echo "<p class='error'>Vous devez remplir l'email</p>";
				break;
			case empty($_POST['phone']):
				echo "<p class='error'>vous devez remplir le numéro de téléphone</p>";
				break;
			case $_POST['departure'] == "":
				echo "<p class='error'>vous devez séléctionner une ville de départ</p>";
				break;
			default:
				echo "<p class='res'> Bonjour " . $_POST['name'] . "</p>";
				echo '<p class="res">Les choix de covoiturage pour '. $_POST['departure'] .' :</p>';
				foreach($travels as $key => $values)
				{
					if($_POST['departure'] == $values['departure'])
					{
						echo "<p class='res'> destination : ". $values['arrival'] . " | Départ : " . $values['departureTime'] . " | Arrivé : " .  $values['arrivalTime'] . " | Conducteur : " . $values['driver'] . "</p>";
					}
				}
			break;
		}

	}
	?>
	</form>
</body>
</html>

