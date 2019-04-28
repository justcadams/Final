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
	$allergies = "";
	$dietaryPref = "";
	$bAddress1 = "";
	$bAddress2 = "";
	$bCity = "";
	$bState = "";
	$bZipCode = "";
	$sAddress1 = "";
	$sAddress2 = "";
	$sCity = "";
	$sState = "";
	$sZipCode = "";
	$comments = "";

/*############################################################################################*/
/*############################################################################################*/
	print PHP_EOL . '<!--SECTION 1c: Form Error Flags -->' . PHP_EOL;
/* Initialize Error Flags for each form element in the order that they appear on the form. */
/*############################################################################################*/
/*############################################################################################*/

	$firstNameERROR = false;
	$lastNameERRROR = false;
	$emailERROR = false;
	$allergiesERROR = false;
	$dietaryPrefERROR = false;
	$bAddress1ERROR = false;
	$bAddress2ERROR = false;
	$bCityERROR = false;
	$bStateERROR = false;
	$bZipCodeERROR = false;
	$sAddress1ERROR = false;
	$sAddress2ERROR = false;
	$sCityERROR = false;
	$sStateERROR = false;
	$sZipCodeERROR = false;
	$commentsERROR = false;

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
		$allergies = htmlentities($_POST["txtAllergies"], ENT_QUOTES, "UTF-8");
		$dietaryPref = htmlentities($_POST["txtDietaryPreference"], ENT_QUOTES, "UTF-8");
		$bAddress1 = htmlentities($_POST["txtBillingAddress1"], ENT_QUOTES, "UTF-8");
		$bAddress2 = htmlentities($_POST["txtBillingAddress2"], ENT_QUOTES, "UTF-8");
		$bCity = htmlentities($_POST["txtBillingCity"], ENT_QUOTES, "UTF-8");
		$bState = htmlentities($_POST["txtBillingState"], ENT_QUOTES, "UTF-8");
		$bZipCode = htmlentities($_POST["txtBillingZip"], ENT_QUOTES, "UTF-8");
		$sAddress1 = htmlentities($_POST["txtShippingAddress1"], ENT_QUOTES, "UTF-8");
		$sAddress2 = htmlentities($_POST["txtShippingAddress2"], ENT_QUOTES, "UTF-8");
		$sCity = htmlentities($_POST["txtShippingCity"], ENT_QUOTES, "UTF-8");
		$sState = htmlentities($_POST["txtShippingState"], ENT_QUOTES, "UTF-8");
		$sZipCode = htmlentities($_POST["txtShippingZip"], ENT_QUOTES, "UTF-8");
		$comments = htmlentities($_POST["txtComments"], ENT_QUOTES, "UTF-8");

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

	if(!verifyAlpha($allergies)) {
		$errorMsg[] = 'Your allergies field contains an unrecognized character.';
		$genderERROR = true;
	}

	if(!verifyAlpha($dietaryPref)) {
		$errorMsg[] = "Your dietary preference contains an unrecognized character.";
	}

	if(!verifyAlphaNum($bAddress1)) {
		$errorMsg[] = 'Billing address line 1 contains an unrecognized character.';
		$bAddress1ERROR = true;
	}

	if(!verifyAlphaNum($bAddress2)) {
		$errorMsg[] = 'Billing address line 2 contains an unrecognized character.';
		$bAddress2ERROR = true;
	}

	if(!verifyAlpha($bCity)) {
		$errorMsg[] = 'Billing city contains an unrecognized character.';
		$bCityERROR = true;
	}

	if(!verifyAlpha($bState)) {
		$errorMsg[] = 'Billing state contains an unrecognized character.';
		$bStateERROR = true;
	}

	if(!verifyInteger($bZipCode)) {
		$errorMsg[] = 'Billing zip code contains an unrecognized character.';
		$bZipCodeERROR = true;
	}

	if(!verifyAlphaNum($sAddress1)) {
		$errorMsg[] = 'Shipping address line 1 contains an unrecognized character.';
		$sAddress1ERROR = true;
	}

	if(!verifyAlphaNum($sAddress2)) {
		$errorMsg[] = 'Shipping address line 2 contains an unrecognized character.';
		$sAddress2ERROR = true;
	}

	if(!verifyAlpha($sCity)) {
		$errorMsg[] = 'Shipping city contains an unrecognized character.';
		$sCityERROR = true;
	}

	if(!verifyAlpha($sState)) {
		$errorMsg[] = 'Shipping state contains an unrecognized character.';
		$sStateERROR = true;
	}

	if(!verifyInteger($sZipCode)) {
		$errorMsg[] = 'Shipping zip code contains an unrecognized character.';
		$sZipCodeERROR = true;
	}

	if(!verifyAlphaNum($comments)) {
		$errorMsg[] = 'Your comments contain an unrecognized character.';
		$commentsERROR = true;
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
			$dataRecord[] = $email;
			$dataRecord[] = $bAddress1;
			$dataRecord[] = $bAddress2;
			$dataRecord[] = $bCity;
			$dataRecord[] = $bState;
			$dataRecord[] = $bZipCode;
			$dataRecord[] = $sAddress1;
			$dataRecord[] = $sAddress2;
			$dataRecord[] = $sCity;
			$dataRecord[] = $sState;
			$dataRecord[] = $sZipCode;
			$dataRecord[] = $comments;

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
			$message .= '<p>';
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

		print '<p class="form-heading center">Welcome to Campus Kitchen</p>';

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
		<p>
			Gender: <label class="radio-field<?php if($genderERROR) print $highlight; else print $noHighlight; ?>"><input class="alignInput" type="radio" id="radGenderMale" name="txtGender" value="Male" tabindex="40" <?php if ($gender == "Male") echo ' checked="checked" '; ?>> Male</label>
			<label class="radio-field<?php if($genderERROR) print $highlight; else print $noHighlight; ?>"><input class="alignInput" type="radio" id="radGenderFemale" name="txtGender" value="Female" tabindex="41" <?php if ($gender == "Female") echo ' checked="checked" '; ?>> Female</label>
			<label class="radio-field<?php if($genderERROR) print $highlight; else print $noHighlight; ?>"><input class="alignInput" type="radio" id="radGenderNot" name="txtGender" value="Not" tabindex="44" <?php if ($gender == "Not") echo ' checked="checked" '; ?>> Not Specified</label>
			<label class="radio-field<?php if($genderERROR) print $highlight; else print $noHighlight; ?>"><input class="alignInput" type="radio" for="radGenderIdentify" name="txtGender" tabindex="42" <?php if (verifyAlpha($gender) && $gender != 'Female' && $gender != 'Male' && $gender != 'Not' && $gender != "") echo ' checked="checked"'; ?>>Identity <input class="alignInput" id="radGenderIdentify" maxlength="45" name="txtGender" onfocus="this.select()" placeholder="Identity" tabindex="43" type="text" value="<?php print $gender; ?>"></label>
		</p>
		<p>
		<label class="<?php if($bAddress1ERROR) print $highlight; else print $noHighlight; ?>" for="txtEmail">Billing Address Line 1: </label>
			<input class="alignInput" id="txtBillingAddress1"
			maxlength="45" name="txtBillingAddress1" onfocus="this.select()" 
			placeholder="120 Colchester Av" tabindex="50"
			type="text" value="<?php print $bAddress1; ?>">
		</p>
		<p>
		<label class="<?php if($bAddress2ERROR) print $highlight; else print $noHighlight; ?>" for="txtEmail">Billing Address Line 2: </label>
			<input class="alignInput" id="txtBillingAddress2"
			maxlength="45" name="txtBillingAddress2" onfocus="this.select()" 
			placeholder="Rm 341" tabindex="60"
			type="text" value="<?php print $bAddress2; ?>">
		</p>
		<p>
		<label class="<?php if($bCityERROR) print $highlight; else print $noHighlight; ?>" for="txtBillingCity">Billing City: </label>
			<input class="alignInput" id="txtBillingCity"
			maxlength="45" name="txtBillingCity" onfocus="this.select()" 
			placeholder="Burlington" tabindex="70"
			type="text" value="<?php print $bCity; ?>">
		</p>
		<p>
		<label class="<?php if($bStateERROR) print $highlight; else print $noHighlight; ?>" for="txtBillingState">Billing State: </label>
			<select class="alignInput" id="txtBillingState" form="frmRegister" tabindex="80">
				<option value=""<?php if($bState == '') print('selected="selected"');?>></option>
				<option value="AL" <?php if($bState == 'AL') print('selected="selected"');?>>Alabama</option>
				<option value="AK" <?php if($bState == 'AK') print('selected="selected"');?>>Alaska</option>
				<option value="AS" <?php if($bState == 'AS') print('selected="selected"');?>>American Samoa</option>
				<option value="AZ" <?php if($bState == 'AZ') print('selected="selected"');?>>Arizona</option>
				<option value="AR" <?php if($bState == 'AR') print('selected="selected"');?>>Arkansas</option>
				<option value="AA" <?php if($bState == 'AA') print('selected="selected"');?>>Armed Forces Americas</option>
				<option value="AE" <?php if($bState == 'AE') print('selected="selected"');?>>Armed Forces Others</option>
				<option value="AP" <?php if($bState == 'AP') print('selected="selected"');?>>Armed Forces Pacific</option>
				<option value="CA" <?php if($bState == 'CA') print('selected="selected"');?>>California</option>
				<option value="CO" <?php if($bState == 'CO') print('selected="selected"');?>>Colorado</option>
				<option value="CT" <?php if($bState == 'CT') print('selected="selected"');?>>Connecticut</option>
				<option value="DE" <?php if($bState == 'DE') print('selected="selected"');?>>Delaware</option>
				<option value="DC" <?php if($bState == 'DC') print('selected="selected"');?>>District Of Columbia</option>
				<option value="FL" <?php if($bState == 'FL') print('selected="selected"');?>>Florida</option>
				<option value="GA" <?php if($bState == 'GA') print('selected="selected"');?>>Georgia</option>
				<option value="GU" <?php if($bState == 'GU') print('selected="selected"');?>>Guam</option>
				<option value="HI" <?php if($bState == 'HI') print('selected="selected"');?>>Hawaii</option>
				<option value="ID" <?php if($bState == 'ID') print('selected="selected"');?>>Idaho</option>
				<option value="IL" <?php if($bState == 'IL') print('selected="selected"');?>>Illinois</option>
				<option value="IN" <?php if($bState == 'IN') print('selected="selected"');?>>Indiana</option>
				<option value="IA" <?php if($bState == 'IA') print('selected="selected"');?>>Iowa</option>
				<option value="KS" <?php if($bState == 'KS') print('selected="selected"');?>>Kansas</option>
				<option value="KY" <?php if($bState == 'KY') print('selected="selected"');?>>Kentucky</option>
				<option value="LA" <?php if($bState == 'LA') print('selected="selected"');?>>Louisiana</option>
				<option value="ME" <?php if($bState == 'ME') print('selected="selected"');?>>Maine</option>
				<option value="MD" <?php if($bState == 'MD') print('selected="selected"');?>>Maryland</option>
				<option value="MA" <?php if($bState == 'MA') print('selected="selected"');?>>Massachusetts</option>
				<option value="MI" <?php if($bState == 'MI') print('selected="selected"');?>>Michigan</option>
				<option value="MN" <?php if($bState == 'MN') print('selected="selected"');?>>Minnesota</option>
				<option value="MS" <?php if($bState == 'MS') print('selected="selected"');?>>Mississippi</option>
				<option value="MO" <?php if($bState == 'MO') print('selected="selected"');?>>Missouri</option>
				<option value="MT" <?php if($bState == 'MT') print('selected="selected"');?>>Montana</option>
				<option value="NE" <?php if($bState == 'NE') print('selected="selected"');?>>Nebraska</option>
				<option value="NV" <?php if($bState == 'NV') print('selected="selected"');?>>Nevada</option>
				<option value="NH" <?php if($bState == 'NH') print('selected="selected"');?>>New Hampshire</option>
				<option value="NJ" <?php if($bState == 'NJ') print('selected="selected"');?>>New Jersey</option>
				<option value="NM" <?php if($bState == 'NM') print('selected="selected"');?>>New Mexico</option>
				<option value="NY" <?php if($bState == 'NY') print('selected="selected"');?>>New York</option>
				<option value="NC" <?php if($bState == 'NC') print('selected="selected"');?>>North Carolina</option>
				<option value="ND" <?php if($bState == 'ND') print('selected="selected"');?>>North Dakota</option>
				<option value="MP" <?php if($bState == 'MP') print('selected="selected"');?>>Northern Mariana Islands</option>				
				<option value="OH" <?php if($bState == 'OH') print('selected="selected"');?>>Ohio</option>
				<option value="OK" <?php if($bState == 'OK') print('selected="selected"');?>>Oklahoma</option>
				<option value="OR" <?php if($bState == 'OR') print('selected="selected"');?>>Oregon</option>
				<option value="PA" <?php if($bState == 'PA') print('selected="selected"');?>>Pennsylvania</option>
				<option value="PR" <?php if($bState == 'PR') print('selected="selected"');?>>Puerto Rico</option>
				<option value="RI" <?php if($bState == 'RI') print('selected="selected"');?>>Rhode Island</option>
				<option value="SC" <?php if($bState == 'SC') print('selected="selected"');?>>South Carolina</option>
				<option value="SD" <?php if($bState == 'SD') print('selected="selected"');?>>South Dakota</option>
				<option value="TN" <?php if($bState == 'TN') print('selected="selected"');?>>Tennessee</option>
				<option value="TX" <?php if($bState == 'TX') print('selected="selected"');?>>Texas</option>
				<option value="UM" <?php if($bState == 'UM') print('selected="selected"');?>>United States Minor Outlying Islands</option>
				<option value="UT" <?php if($bState == 'UT') print('selected="selected"');?>>Utah</option>
				<option value="VT" <?php if($bState == 'VT') print('selected="selected"');?>>Vermont</option>
				<option value="VA" <?php if($bState == 'VA') print('selected="selected"');?>>Virginia</option>
				<option value="VI" <?php if($bState == 'VI') print('selected="selected"');?>>Virgin Islands</option>
				<option value="WA" <?php if($bState == 'WA') print('selected="selected"');?>>Washington</option>
				<option value="WV" <?php if($bState == 'WV') print('selected="selected"');?>>West Virginia</option>
				<option value="WI" <?php if($bState == 'WI') print('selected="selected"');?>>Wisconsin</option>
				<option value="WY" <?php if($bState == 'WY') print('selected="selected"');?>>Wyoming</option>
			</select>
		</p>
		<p>
		<label class="<?php if($bZipCodeERROR) print $highlight; else print $noHighlight; ?>" for="txtBillingZip">Billing Zip Code: </label>
			<input class="alignInput" id="txtBillingZip"
			maxlength="45" name="txtBillingZip" onfocus="this.select()" 
			placeholder="76543" tabindex="90"
			type="text" value="<?php print $bZipCode; ?>">
		</p>
		<p>
		<label class="<?php if($sAddress1ERROR) print $highlight; else print $noHighlight; ?>" for="txtEmail">Shipping Address Line 1: </label>
			<input class="alignInput" id="txtShippingAddress1"
			maxlength="45" name="txtShippingAddress1" onfocus="this.select()" 
			placeholder="120 Colchester Av" tabindex="100"
			type="text" value="<?php print $sAddress1; ?>">
		</p>
		<p>
		<label class="<?php if($sAddress2ERROR) print $highlight; else print $noHighlight; ?>" for="txtEmail">Shipping Address Line 2: </label>
			<input class="alignInput" id="txt"
			maxlength="45" name="txtShippingAddress2" onfocus="this.select()" 
			placeholder="Rm 341" tabindex="110"
			type="text" value="<?php print $sAddress2; ?>">
		</p>
		<p>
		<label class="<?php if($sCityERROR) print $highlight; else print $noHighlight; ?>" for="txtShippingCity">Shipping City: </label>
			<input class="alignInput" id="txtShippingCity"
			maxlength="45" name="txtShippingCity" onfocus="this.select()" 
			placeholder="Burlington" tabindex="120"
			type="text" value="<?php print $sCity; ?>">
		</p>
		<p>
		<label class="<?php if($sStateERROR) print $highlight; else print $noHighlight; ?>" for="txtShippingState">Shipping State: </label>
			<select class="alignInput" id="txtShippingState" name="txtShippingState" form="frmRegister" tabindex="130">
				<option value=""<?php if($bState == '') print('selected="selected"');?>></option>
				<option value="AL" <?php if($sState == 'AL') print('selected="selected"');?>>Alabama</option>
				<option value="AK" <?php if($sState == 'AK') print('selected="selected"');?>>Alaska</option>
				<option value="AS" <?php if($sState == 'AS') print('selected="selected"');?>>American Samoa</option>
				<option value="AZ" <?php if($sState == 'AZ') print('selected="selected"');?>>Arizona</option>
				<option value="AR" <?php if($sState == 'AR') print('selected="selected"');?>>Arkansas</option>
				<option value="AA" <?php if($sState == 'AA') print('selected="selected"');?>>Armed Forces Americas</option>
				<option value="AE" <?php if($sState == 'AE') print('selected="selected"');?>>Armed Forces Others</option>
				<option value="AP" <?php if($sState == 'AP') print('selected="selected"');?>>Armed Forces Pacific</option>
				<option value="CA" <?php if($sState == 'CA') print('selected="selected"');?>>California</option>
				<option value="CO" <?php if($sState == 'CO') print('selected="selected"');?>>Colorado</option>
				<option value="CT" <?php if($sState == 'CT') print('selected="selected"');?>>Connecticut</option>
				<option value="DE" <?php if($sState == 'DE') print('selected="selected"');?>>Delaware</option>
				<option value="DC" <?php if($sState == 'DC') print('selected="selected"');?>>District Of Columbia</option>
				<option value="FL" <?php if($sState == 'FL') print('selected="selected"');?>>Florida</option>
				<option value="GA" <?php if($sState == 'GA') print('selected="selected"');?>>Georgia</option>
				<option value="GU" <?php if($sState == 'GU') print('selected="selected"');?>>Guam</option>
				<option value="HI" <?php if($sState == 'HI') print('selected="selected"');?>>Hawaii</option>
				<option value="ID" <?php if($sState == 'ID') print('selected="selected"');?>>Idaho</option>
				<option value="IL" <?php if($sState == 'IL') print('selected="selected"');?>>Illinois</option>
				<option value="IN" <?php if($sState == 'IN') print('selected="selected"');?>>Indiana</option>
				<option value="IA" <?php if($sState == 'IA') print('selected="selected"');?>>Iowa</option>
				<option value="KS" <?php if($sState == 'KS') print('selected="selected"');?>>Kansas</option>
				<option value="KY" <?php if($sState == 'KY') print('selected="selected"');?>>Kentucky</option>
				<option value="LA" <?php if($sState == 'LA') print('selected="selected"');?>>Louisiana</option>
				<option value="ME" <?php if($sState == 'ME') print('selected="selected"');?>>Maine</option>
				<option value="MD" <?php if($sState == 'MD') print('selected="selected"');?>>Maryland</option>
				<option value="MA" <?php if($sState == 'MA') print('selected="selected"');?>>Massachusetts</option>
				<option value="MI" <?php if($sState == 'MI') print('selected="selected"');?>>Michigan</option>
				<option value="MN" <?php if($sState == 'MN') print('selected="selected"');?>>Minnesota</option>
				<option value="MS" <?php if($sState == 'MS') print('selected="selected"');?>>Mississippi</option>
				<option value="MO" <?php if($sState == 'MO') print('selected="selected"');?>>Missouri</option>
				<option value="MT" <?php if($sState == 'MT') print('selected="selected"');?>>Montana</option>
				<option value="NE" <?php if($sState == 'NE') print('selected="selected"');?>>Nebraska</option>
				<option value="NV" <?php if($sState == 'NV') print('selected="selected"');?>>Nevada</option>
				<option value="NH" <?php if($sState == 'NH') print('selected="selected"');?>>New Hampshire</option>
				<option value="NJ" <?php if($sState == 'NJ') print('selected="selected"');?>>New Jersey</option>
				<option value="NM" <?php if($sState == 'NM') print('selected="selected"');?>>New Mexico</option>
				<option value="NY" <?php if($sState == 'NY') print('selected="selected"');?>>New York</option>
				<option value="NC" <?php if($sState == 'NC') print('selected="selected"');?>>North Carolina</option>
				<option value="ND" <?php if($sState == 'ND') print('selected="selected"');?>>North Dakota</option>
				<option value="MP" <?php if($sState == 'MP') print('selected="selected"');?>>Northern Mariana Islands</option>				
				<option value="OH" <?php if($sState == 'OH') print('selected="selected"');?>>Ohio</option>
				<option value="OK" <?php if($sState == 'OK') print('selected="selected"');?>>Oklahoma</option>
				<option value="OR" <?php if($sState == 'OR') print('selected="selected"');?>>Oregon</option>
				<option value="PA" <?php if($sState == 'PA') print('selected="selected"');?>>Pennsylvania</option>
				<option value="PR" <?php if($sState == 'PR') print('selected="selected"');?>>Puerto Rico</option>
				<option value="RI" <?php if($sState == 'RI') print('selected="selected"');?>>Rhode Island</option>
				<option value="SC" <?php if($sState == 'SC') print('selected="selected"');?>>South Carolina</option>
				<option value="SD" <?php if($sState == 'SD') print('selected="selected"');?>>South Dakota</option>
				<option value="TN" <?php if($sState == 'TN') print('selected="selected"');?>>Tennessee</option>
				<option value="TX" <?php if($sState == 'TX') print('selected="selected"');?>>Texas</option>
				<option value="UM" <?php if($sState == 'UM') print('selected="selected"');?>>United States Minor Outlying Islands</option>
				<option value="UT" <?php if($sState == 'UT') print('selected="selected"');?>>Utah</option>
				<option value="VT" <?php if($sState == 'VT') print('selected="selected"');?>>Vermont</option>
				<option value="VA" <?php if($sState == 'VA') print('selected="selected"');?>>Virginia</option>
				<option value="VI" <?php if($sState == 'VI') print('selected="selected"');?>>Virgin Islands</option>
				<option value="WA" <?php if($sState == 'WA') print('selected="selected"');?>>Washington</option>
				<option value="WV" <?php if($sState == 'WV') print('selected="selected"');?>>West Virginia</option>
				<option value="WI" <?php if($sState == 'WI') print('selected="selected"');?>>Wisconsin</option>
				<option value="WY" <?php if($sState == 'WY') print('selected="selected"');?>>Wyoming</option>
			</select>
		</p>
		<p>
		<label class="<?php if($sZipCodeERROR) print $highlight; else print $noHighlight ?>" for="txtShippingZip">Shipping Zip Code: </label>
			<input class="alignInput" id="txtShippingZip"
			maxlength="45" name="txtShippingZip" onfocus="this.select()" 
			placeholder="76543" tabindex="140"
			type="text" value="<?php print $sZipCode; ?>" tabindex="140">
		</p>
		<p>
		<label class="<?php if($commentsERROR) print $highlight; else print $noHighlight ?>" for="txtComments">Comments: </label>
			<textarea class="alignInput" id="txtComments"
			maxlength="1000" name="txtComments" onfocus="this.select()" 
			placeholder="Dear Editor," tabindex="150"
			type="text" value="<?php print $comments; ?>" tabindex="150"></textarea> 
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