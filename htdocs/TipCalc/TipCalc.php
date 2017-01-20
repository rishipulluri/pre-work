
<html>
	<head>
		<link rel = "stylesheet" type = "text/css" href = "styles.css">
		<meta charset = "utf-8">
		<meta name = "description" content = "Codepath Pre Work">
		<meta name = "author" content = "Rishi Pulluri">
	</head>
	<body>
		<?php
		function isPostRequest()
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}
		$percentage = $_POST['Percentage'] ?? '';
		$billTotal = $_POST['billTotal'] ?? '';
		$otherPercentage = $_POST['percentageOther'] ?? '';
		$numForSplit = $_POST['numForSplit'] ?? '';
		$currency = $_POST['Currency'] ?? '';


		?>

		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
	<h1>Tip Calculator:</h1><br>
	<p>Bill Total:</p>
	<input type= "text" name= "billTotal"><br>

	<p>Tip Percentage:</p>
	<?php
		$percentages = array(10, 15, 20);
		for($i = 0; $i < count($percentages); $i++)
		{
			echo('<input type = "radio" name = "Percentage" value = "' . $percentages[$i] . '" >' . $percentages[$i] . '%    ');
		}
		echo ('<br>');
		echo('<input type = "radio" name = "Percentage" id = "otherPercentage"');
		echo('<label for = "otherPercentage"> Other Percentage</label>');
		echo('<div class = "reveal-if-active">
				<input type= "text" style = "width: 50px" name= "percentageOther">%<br>
				</div><br>');
		// this is the split
		echo('Split: <input type = "text" style = "width: 50px" name = "numForSplit" value = 1> person(s)');
		// this is for currencies
		echo('<br>');
		echo('<br>');
		$currencies = array("Euros: EUR", "British Pound: GBP", "Swiss Fracs: CHF", "Australian Dollar: AUD");
		for($i = 0; $i < count($currencies); $i++)
		{
			echo('<input type = "radio" name = "Currency" value = "' . $currencies[$i] . '" >' . $currencies[$i] . '<br>');
		}

	?>

	<br>
	<br>

	<?php
	// This is a post request
	if(isPostRequest())
	{

		if(is_numeric($billTotal) && (is_numeric($percentage) || is_numeric($otherPercentage)) && is_numeric($numForSplit))
		{
			if($billTotal > 0 && $numForSplit > 0)
			{
				if(is_numeric($percentage))
				{
					echo($currency);
					switch($currency) {
						case "Euros: EUR":
							$billTotal = $billTotal * 1.11;
							break;
						case "British Pound: GBP":
							$billTotal = $billTotal * 1.27;
							break;
						case "Swiss Fracs: CHF":
							$billTotal = $billTotal * 1.02;
							break;
						case "Australian Dollar: AUD":
							$billTotal = $billTotal * 0.76;
							break;
						default:
							// user is automatically doing USD
							echo('Default is Dollars: USD');
							break;
					}
					$tip = ($percentage / 100) * $billTotal;
					$billTotal = $billTotal + $tip;
					$splitTotal = $billTotal/$numForSplit;
					echo('<p>Tip: ' . '$' . $tip . '</p>');
					echo('Bill Total: ' . '$' . $billTotal . '<br>');
					if($numForSplit > 1)
					{
						echo('The bill for each person is: ' . '$' . $splitTotal);
					}

				}
				else if(is_numeric($otherPercentage))
				{
					if($otherPercentage > 0)
					{
						$tip = ($otherPercentage / 100) * $billTotal;
						$billTotal = $billTotal + $tip;
						$splitTotal = $billTotal/$numForSplit;
						echo('<p>Tip: ' . '$' . $tip . '</p>');
						echo('Bill Total: ' . '$' . $billTotal . '<br>');
						if($numForSplit > 1)
						{
							echo('The bill for each person is: ' . '$' . $splitTotal);
						}
					}
					else
					{
						echo 'The custom percentage is a negative value';
					}

				}
			}
			else
			{
				echo 'The bill total is negative';
			}
		}
		else
		{
			echo 'The numbers you entered are not numeric values';
		}
	}
	else // this is not a post request
	{
	}
	?>
	<br>
	<input type = "submit" value = "Submit">
</form>
</body>
</html>
