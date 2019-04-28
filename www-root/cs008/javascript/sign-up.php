<?php
$currentDirectory = getcwd();
if($currentDirectory != '/users/j/a/jadams7/www-root/cs008/final') {
    chdir('/users/j/a/jadams7/www-root/cs008/final');
include 'top.php';
}
else{
include 'nav.php';
}
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
print PHP_EOL . '<!--SECTION: 1 Initialize variables -->' . PHP_EOL;
//These variables are used in both sections 2 and 3, otherwise we would
// declare them in the section we needed them

print PHP_EOL . '<!--SECTION: 1a. debugging setup -->' . PHP_EOL;
// We print out the post array so that we can see out forms is working.
// Normally I wrap this in a debug statement but for now I want to always
// display it. When you first come to the form it is empty. When you submit the 
// for it displays the contents of the pot array.
// if ($debug){
//print '<p>Post Array:</p><pre>';
//print_r($_POST);
//print '</pre>';

//}
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
print PHP_EOL . '<!-- SECTION: 1b form variables -->' . PHP_EOL;
//
// Initialize variables one for each form element
// in the order they appear on the form
$firstName = "";
$lastName = "";
$email = "";
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
print PHP_EOL . '<!-- SECTION: 1c form error flags -->' . PHP_EOL;
//
// Initialize Error Flags one for eac form element we validate
// in the order they appear on the form
$lastNameERROR = false;
$firstNameERROR = false;
$emailERROR = false;
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
print PHP_EOL . '<!-- SECTION: 1d misc variables -->' . PHP_EOL;
//
// create array to hold error messages filled (if any) in 2d displayed in 3c.
//$errorMsg = array();
//have we mailed the information to the user, flag variabe?
$mailed = false;
if (isset($_POST["btnSubmit"])) {

    print PHP_EOL . '<!-- SECTION: 2 Process for when the form is submitted -->' . PHP_EOL;
// the url for this form
    $thisURL = $domain . $phpSelf;
    if (!securityCheck($thisURL)) {
        $msg = '<p>Sorry you cannot access this Page.</p>';
        $msg .= '<p>Security breach detected and reported.</p>';
        die($msg);
    }
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
    print PHP_EOL . '<!-- SECTION: 2b Sanitize (clean) data -->' . PHP_EOL;
// remove any potentia JavaScript of html code from users input on the 
// form. Note it is best to follow the same order as declared in section 1c.
    
    $lastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
    print PHP_EOL . '<!-- SECTION: 2c Validation -->' . PHP_EOL;
// Validation section. Chec each value for possible errors, empty or
// not wat we expect. Yo will need an IF block for ach element you will
// check (see above sections 1c and 1d). The if blocks should also be in the 
// order that the elements appear on your form so that the error messages 
// will be in the order they appear. errorMsg will be displayed on the form 
// see section 3b the error flag ($emailERROR) will be used in section 3c.
    
    if($firstName == ""){
        $errorMsg[] = "Please enter your first name";
        $firstNameERROR = true;
    } elseif (!verifyAlphaNum($firstName)) {
        $errorMsg[] = "Your first name appears to have extra characters.";
        $firstNameERROR = true;
}
    if($lastName == ""){
        $errorMsg[] = "Please enter your last name";
        $lastNameERROR = true;
    } elseif (!verifyAlphaNum($lastName)) {
        $errorMsg[] = "Your last name appears to have extra characters.";
        $lastNameERROR = true;
}
    
    if ($email == "") {
        $errorMsg[] = 'Please enter your email address';
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = 'Your email address appears to be incorrect.';
        $emailERROR = true;
    }
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
    print PHP_EOL . '<!-- SECTION: 2d Process Form - Passed Validation -->' . PHP_EOL;
//
// Process for when the form passes validation (the errorMsg array is empty)
//
    if (!$errorMsg) {
        if ($debug) {
            print '<p>Form is Valid</p>';
        }

        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
        print PHP_EOL . '<!-- SECTION: 2e Save Data -->' . PHP_EOL;
//
//This block saves the data to CSV file.
//
        // array used to hold form values that will be saved to a CSV file
        //$dataRecord = array();
// assign values to the dataRecord array
        $dataRecord[] = $lastName;
        $dataRecord[] = $firstName;
        $dataRecord[] = $email;
        // setup CSV file
        $myFolder = 'Data/';
        $myFileName = 'registration';
        $fileExt = '.csv';
        $filename = $myFolder . $myFileName . $fileExt;

        if ($debug)
            print PHP_EOL . '<p>filename is ' . $filename;
// now we just open the file for append
        $file = fopen($filename, 'a');
// write the forms informations
        fputcsv($file, $dataRecord);
// close the file
        fclose($file);
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
        print PHP_EOL . '<!-- SECTION: 2f Create message -->' . PHP_EOL;
        $message = '<h2>Welcome to Kampus Kitchen!</h2>';
        $message .= '<p>Thank you for signing up! Please check your email for a confirmation email. We hope you have a nice day!</p>';
        foreach ($_POST as $htmlName => $value){
            //breaks up the form names into words. for example
            //txtFirstName becomes First Name
            $camelCase = preg_split('/(?=[A-Z])/', substr($htmlName, 3));
            foreach ($camelCase as $oneWord){
                $message .= $oneWord;
            }
            $message .=   ": " . $value . '<br>';
        }
//
// build a message to display on the screen in section 3a and to mail
// to the person filling out the form (secion 2g)
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
        print PHP_EOL . '<!-- SECTION: 2g Mail to user -->' . PHP_EOL;
//
// Process for mailing a message which contains the forms data
// the massage was built in section 2f.
        $to = $email; //the person who filled out the form
        $cc = '';
        $bcc = '';
        
        $from = 'Kampus Kitchen <newsletter@KampusKitchen.com';
        //subject of mail should make sense to your form
        $subject = 'Kampus Kitchen Newsletter';
        
        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
        
    }
} //ends if form was submitted
//#############################################################################
//
print PHP_EOL . '<!-- SECTION: 3 Display Form -->' . PHP_EOL;
//
?>
<article>
    <?php
//#############################################################################
//
    print PHP_EOL . '<!-- Section: 3a -->' . PHP_EOL;
//
// If its the first time coming to the form or there are errors we are going
// to display the form.
    if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) {//closing off if marked with: end body submit
        print '<h2>Thank you for providing your information and support!</h2>';
        print '<p>For your records, a copy of this data has ';
        if (!$mailed){
            print "not ";
        }
        print 'been sent:</p>';
        print '<p>To: ' . $email . '</p>';
        print $message;
    } else {
        print '<h2>Sign Up today for the Kampus Kitchen Newsletter</h2>';
        print '<p class="form-heading">By submitting your email you shall recieve newsletters regarding Kampus Kitchen. Thank you for supporting us!</p>';
    }

//#############################################################################
//
    print PHP_EOL . '<!-- SECTION: 3b Error Messages -->' . PHP_EOL;
//
// display any error messages before we print out the form
    if ($errorMsg) {
        print '<div id="errors">' . PHP_EOL;
        print'<h2> Your form has the following mistakes that need to be fixed.</h2>' . PHP_EOL;
        print '<ol>' . PHP_EOL;
        foreach ($errorMsg as $err) {
            print '<li>' . $err . '</li>' . PHP_EOL;
        }
        print '</ol>' . PHP_EOL;
        print '</div>' . PHP_EOL;
    }
//#############################################################################
//
    print PHP_EOL . '<!-- SECTION: 3c html Form -->' . PHP_EOL;
//
    /* Display the HTML form. note that the action to this same page. $phpSelf
     * is defined in top.php
     * Note the line:
     * value="<?php print $email; ?>
     * this makes the form sticky by displaying either the inital default value (line ??)
     * or the value they typed in (line ??)
     * Note ths line:
     * <?php if($emailERROR) print 'class="mistake"'; ?>
     * this prints out a css class so that we can highlight the background etc. to
     * make it stand out that a mstake happend here.
     */
    ?>
    <form action="<?php print $phpSelf; ?>"
          id="frmRegister"
          method="post">
        <fieldset class="contact">
            <legend>Contact Information</legend>
            
            <p>
                <label class="required" for="txtFirstName">First Name</label>
                <input autofocus
                       <?php if ($firstNameERROR) print'class="mistake"'; ?>
                       id="txtFirstName"
                       maxlength="45"
                       name="txtFirstName"
                       onfocus="this.select()"
                       placeholder="Enter your first name"
                       tabindex="100"
                       type="text"
                       value="<?php print $firstName;?>"
                       >
            </p>
            <p>
                <label class="required" for="txtLastName">Last Name</label>
                <input
                       <?php if ($lastNameERROR) print'class="mistake"'; ?>
                       id="txtLastName"
                       maxlength="45"
                       name="txtLastName"
                       onfocus="this.select()"
                       placeholder="Enter your last name"
                       tabindex="100"
                       type="text"
                       value="<?php print $lastName;?>"
                       >
            </p>
            <p>
                <label class="required" for="txtEmail">Email</label>
                <input
                <?php
                if ($emailERROR) {
                    print 'class="mistake"';
                }
                ?>
                    maxlength="45"
                    name="txtEmail"
                    onfocus="this.select()"
                    placeholder="Enter your Email Address"
                    tabindex="120"
                    type="text"
                    value="<?php print $email; ?>"
                    >
            </p>
            
        
        </fieldset> <!--ends contacts-->
        
        <fieldset class="buttons">
            <legend>

            </legend>
            <input class ="button" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Register">
        </fieldset> <!-- ends buttons -->

    </form>
    <?php
    // ends body submit
    ?>
</article>

<?php include 'footer.php';
?>
</body>
</html>