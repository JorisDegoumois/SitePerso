<?php
header('Content-Type: text/html; charset=utf-8');
header('Content-Language: fr');

if (!empty($_POST['email']) && !empty($_POST['object']))
{
	$email = strtolower(trim($_POST['email']));
	$file = 'email_list.txt';

	if (filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$data = $_POST['email']."\n";

		if ($_POST['object'] == 'subscribe')
		{
			$fh = fopen($file, 'a');
			if ($fh)
			{
				fwrite($fh, $data);
				fclose($fh);
				$message = 'Vous êtes maintenant inscrit à notre newsletter.';
			}

		} else {

			$content = file_get_contents($file);
			$content = str_replace($data, '', $content);
			file_put_contents($file, $content);
			$message = 'Vous êtes maintenant désinscrit de notre newsletter.';
		}

	}	else {
		$message = 'Cette adresse email est invalide.';
	}
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>

	<title>Newsletter</title>

	<meta charset=UTF-8"/>
	
</head>

<body>

			<form id="frm_newsletter" method="post" action="index.php">

				<fieldset>
					<legend>Inscription à notre newsletter</legend>

					<?php if (!empty($message)): ?>
					<p>
						<?php echo $message; ?>
					</p>
					<?php endif; ?>

					<div>
						<label for="email">Votre adresse email</label>
						<input id="email" name="email" type="text" value="" />
					</div>
					
					<div>
						<label for="object">Objet</label>
						<select id="object" name="object">
							<option value="subscribe">Inscription</option>
							<option value="unsubscribe">Désinscription</option>
						</select>
					</div>

					<div>						
						<input class="button large" type="submit" name="subscribe_submit" value="Envoyer" />
					</div>

				</fieldset>

			</form>

</body> 
</html>