<?php 
$currentDirectory = getcwd();
if($currentDirectory != '/users/j/a/jadams7/www-root/cs008/final') {
	chdir('/users/j/a/jadams7/www-root/cs008/final');
	include 'top.php';
}
else {
	include 'top.php';
}

/*############################################################################################*/
/*############################################################################################*/
	print PHP_EOL . '<!-- SECTION 1: Initialize Variables -->' . PHP_EOL;
/* These variables will contain information for both sections 2 and 3. Remember to declare variables local to their scope. */
/*############################################################################################*/

	print PHP_EOL . '<!--SECTION 1a: Debugging Setup -->' . PHP_EOL;
/* Printing out the post array allows the developer to test if the form is properly working. This will eventually be wrapped in a debug statement, which will prevent the post array from printing in a normal state. For now when you submit the form it displays the contents of the post array. */
/*############################################################################################*/
        
/*############################################################################################*/
	// if($debug) {
		// print '<p>Post Array:</p><pre>';
		// print_r($_POST);
		// print '</pre>';
	//}
/*############################################################################################*/
/*############################################################################################*/
/*############################################################################################*/
	print PHP_EOL . '<!-- SECTION 1b: Form Variables -->' . PHP_EOL;
/* Initialize variables for each form element in the order that they appear on the form. */
/*############################################################################################*/
/*############################################################################################*/


	$firstName = "";
	$lastName = "";
	$email = "";

/*############################################################################################*/
/*############################################################################################*/
	print PHP_EOL . '<!--SECTION 1c: Form Error Flags -->' . PHP_EOL;
/* Initialize Error Flags for each form element in the order that they appear on the form. */
/*############################################################################################*/
/*############################################################################################*/

	$firstNameERROR = false;
	$lastNameERRROR = false;
	$emailERROR = false;

/*############################################################################################*/
/*############################################################################################*/
	print PHP_EOL . '<!-- SECTION 1d: Additional Variables -->' . PHP_EOL;
/*############################################################################################*/
/* Create an array that holds error messages created in section 2d, which will be displayed in 3c. */
	$errorMsg = array();

/* TODO: Create a mail information flag variable. */
	$mailed = false;

/*############################################################################################*/
/*############################################################################################*/
	print PHP_EOL . '<!-- SECTION 2: Form Submission Process -->' . PHP_EOL;
/*############################################################################################*/
	if(isset($_POST["btnSubmit"])) {

/*############################################################################################*/
/*############################################################################################*/
		print PHP_EOL . '<!-- SECTION 2a: Security -->' . PHP_EOL;

		// the url for this form
		$thisURL = $domain . $phpSelf;

		if(!securityCheck($thisURL)) {
			$msg = '<p>Sorry you cannot access this page.</p>';
			$msg = '<p>Security breach detected and reported.</p>';
			die($msg);
		}

/*############################################################################################*/
/*############################################################################################*/
		print PHP_EOL . '<!-- SECTION 2b: Sanitize (Clean) Data -->' . PHP_EOL;
/*############################################################################################*/
/*############################################################################################*/

		$firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
		$lastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
		$email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);

/*############################################################################################*/
/*############################################################################################*/
		print PHP_EOL . '<!-- SECTION 2c: Validation -->' . PHP_EOL;
/* Validation section. Check each value for possible errors. This may include empty values, incorrect responses, and invalid data entry. You will use a series of statements using if, else if, else if, etc to accomplish the task of error checking form data (see above section 1c and 1d). The logic statements should appear as the information in your form appears so that error messages will appear next to the corresponding entry. Note: errorMSg (section 3b) and emailERROR (section 3c) will be used in later sections.
/*############################################################################################*/

	

	if($firstName == "") {
		$errorMsg[] = 'Please enter your first name.';
		$firstNameERROR = true;
	}
	elseif(!verifyAlpha($firstName)) {
		$errorMsg[] = 'Our website needs to integrate your language\'s symbols or your first name contains an invalid character.<br>For now please romanize your first name, and we will add your language\'s native symbols shortly.';
		$firstNameERROR = true;
	}

	if($lastName == "") {
		$errorMsg[] = 'Please enter your last name.';
		$lastNameERROR = true;
	}
	elseif(!verifyAlpha($lastName)) {
		$errorMsg[] = 'Our website needs to integrate your language\'s symbols or your last name contains an invalid character.<br>For now please romanize your last name, and we will add your language\'s native symbols shortly.';
		$lastNameERROR = true;
	}

	if($email == "") {
		$errorMsg[] = 'Please enter an e-mail address.';
		$emailERROR = true;
	}
	elseif(!verifyEmail($email)) {
		$errorMsg[] = 'That is not a valid e-mail address.';
		$emailERROR = true;
	}


/*############################################################################################*/
		print PHP_EOL . '<!-- SECTION 2d: Process Form - Form Passed Validation -->' . PHP_EOL;
/*############################################################################################*/

		if(!$errorMsg) {
			if($debug) {
				print '<p>Form is valid.</p>';
			}


/*############################################################################################*/
			print PHP_EOL . '<!-- SECTION 2e: Save Data -->' . PHP_EOL;
/*############################################################################################*/
			
			/* This block saves the data to a CSV file. */

			/* Array used to hold form values that will be saved to a CSV file. */

			$dataRecord = array();

			/* Assign values to the dataRecord array */

			$dataRecord[] = $firstName;
			$dataRecord[] = $lastName;
			$dataRecord[] = $gender;

			/* Setup csv file to save data */

			$myFolder = 'data/';
			$myFileName = 'registration';
			$fileExt = '.csv';
			$newFileName = $myFolder . $myFileName . $fileExt;

			/* Open file and append information. */

			$file = fopen($newFileName, 'a');

			/* Write the forms information. */

			fputcsv($file, $dataRecord);

			/* Close the file. */

			fclose($file);

/*############################################################################################*/
/*############################################################################################*/
			print PHP_EOL . '<!-- SECTION 2f: Create Message -->' . PHP_EOL;
/* Build a message to display on the screen in section 3a and to mail to the person filling out the form (section 2g). */
/*############################################################################################*/
/*############################################################################################*/

	$message = '<h2 class ="center">Welcome to Viridian!</h2>' . PHP_EOL;
	$message .= '<p class ="center">Our mission is to be the most innovative research institution on Earth.</p>' . PHP_EOL;
	$message .= '<h3>Your Information: </h3>';

	foreach ($_POST as $htmlName => $value) {
		if($htmlName != "btnSubmit") {
			$message .= '<p>Thank you signing up! Check your email for a confirmation letter. We hope you have a nice day!</p>';
			// breaks up the form names into words.
			// For example, txtFirstName becomes First Name
			$camelCase = preg_split('/(?=[A-Z])/', substr($htmlName,3));
			foreach ($camelCase as $oneWord) {
				$message .= $oneWord . ' ';
			}
			$message .= ' = ' . htmlentities($value, ENT_QUOTES, "UTF-8") . '</p>';
		}
	}

	$message .= '<p>Thank you for signing up to receive the Viridian Newsletter. If you have questions, comments, suggestions, research, or editorials, then please send us an e-mail at editor@viridian.com</p>';

/*############################################################################################*/
/*############################################################################################*/
			print PHP_EOL . '<!-- SECTION 2g: Mail to User -->' . PHP_EOL;
/* Send a message, which contains the form's data built in section 2f. */
/*############################################################################################*/
/*############################################################################################*/
	
	$to = $email;
	$cc = '';
	$bcc = '';

	$from = '<newsletter@viridian.com>';

	$subject = 'Newsletter Registration';

	$mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
	
		} // end form is valid

	} // ends if form was submitted.



/*############################################################################################*/
/*############################################################################################*/
	print PHP_EOL . '<!-- SECTION 3: Initialize Display -->' . PHP_EOL;
/*############################################################################################*/
?>
	<article>
<?php
/*############################################################################################*/
/*############################################################################################*/
	print PHP_EOL . '<!-- SECTION 3a: Display Form -->' . PHP_EOL;
/* If it is the first time the user comes to the form or there are error messages to display, then the form will display. */
/*############################################################################################*/
/*############################################################################################*/
	if(isset($_POST["btnSubmit"]) AND empty($errorMsg)) {
		
		print '<h2>Thank you for subscribing!</h2>';

		print '<p class="center">For your records a copy of this form has ';

		if($mailed) {
			print "not ";
		}

		print 'been e-mailed to your e-mail address: '. PHP_EOL . '<br>' . $email . '</p>';

		print $message;

	}
	else {

		print '<p class="form-heading center">Welcome to Kampus Kitchen</p>';

/*############################################################################################*/
/*############################################################################################*/
		print PHP_EOL . '<!-- SECTION 3b: Error Messages -->' . PHP_EOL;
/* Display any error messages before printing out the form. */
/*############################################################################################*/


		if($errorMsg) {
			print '<div id="errors">' . PHP_EOL;
			print '<h2 class="highlight">Your form has the following mistakes that need to be fixed.</h2>' . PHP_EOL;
			print '<ol>' . PHP_EOL;

			foreach($errorMsg as $err) {
				print '<p class="highlight">' . $err . '</p>' . PHP_EOL;
			}

			print '</ol>' . PHP_EOL;
			print '</div>' . PHP_EOL;
		}

/*############################################################################################*/
/*############################################################################################*/
	print PHP_EOL . '<!-- SECTION 3c: HTML Form -->' . PHP_EOL;
/*Display the HTML form. Note: The action takes the user to the same page. $phpSelf contains a 
link to this web page. Also, value="<?php print $email; ?> this makes the form sticky by 
displaying either the initial default value (line xx) or the value the user types (line xx). 
Finally, the following code prints out a css class that we can modify using css to make it 
stand out from the background to highlight a mistake. 
<?php if($emailERROR) print 'class="mistake"'; ?> */
/*############################################################################################*/
/*############################################################################################*/
/*############################################################################################*/
/*############################################################################################*/
/*############################################################################################*/
?>


<form action = "<?php print $phpSelf; ?>" id = "frmRegister" method = "post">


	<fieldset class="contact">
		<legend class="center">Contact Information</legend>
		<p class="center">Fields with asterisks * are required.</p>














<?php 
	$highlight = 'alignField highlight';
	$noHighlight = 'alignField';
?>
		<p>
		<label class="<?php if($firstNameERROR) print $highlight; else print $noHighlight ?>" for="txtFirstName">* First Name: </label>
			<input class="alignInput" id="txtFirstName"
			maxlength="45" name="txtFirstName" onfocus="this.select()" 
			placeholder="First Name" tabindex="10"
			type="text" value="<?php print $firstName; ?>">
		</p>
		<p>
		<label class="<?php if($lastNameERROR) print $highlight; else print $noHighlight; ?>" for="txtLastName">* Last Name: </label>
			<input class="alignInput" id="txtLastName"
			maxlength="45" name="txtLastName" onfocus="this.select()" 
			placeholder="Last Name" tabindex="20"
			type="text" value="<?php print $lastName; ?>">
		</p>
		<p>
		<label class="<?php if($emailERROR) print $highlight; else print $noHighlight; ?>" for="txtEmail">* Email: </label>
			<input class="alignInput" id="txtEmail"
			maxlength="45" name="txtEmail" onfocus="this.select()" 
			placeholder="email@Viridian.com" tabindex="30"
			type="text" value="<?php print $email; ?>">
		</p>
	</fieldset> <!-- Ends contact -->

	<fieldset class="buttons center">
		<legend></legend>
		<input class = "button round" id="btnSubmit" name="btnSubmit" tabindex="900" type = "submit" value = "Register">
	</fieldset> <!-- Ends buttons -->
</form>
<?php
	} // ends body submit
?>
	</article>
<?php require 'footer.php'; ?>