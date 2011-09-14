var s_popupOptions = 'width=400,height=250,top=0,left=0';
var s_simmYear = "2382";

  /*
   * PopupWindows
   */
  function PopupWindow(s_windowSpec)
  {
    var t=window.open(s_windowSpec,'setPop',s_popupOptions);
  }
  
  /*
   * CalculateBD
   */
  function CalculateBD()
  {
    document.theForm.birthdate.value = document.theForm.birthmonth.value + "/" + document.theForm.birthday.value + "/" + (s_simmYear-document.theForm.age.value);
    document.theForm.displayBD.value = document.theForm.birthdate.value;
  }

/**
 * Validate Application Form
 *
 * Author: Dan Taylor <dan@taylord1.co.uk>
 *
 * Created: 27th August 2005
 */

function validateApp()
{
	//One large if then else if statement, to check each section for errors
	
	// Check Real Name
	if(document.theForm.realname.value=="")
	{
		alert("Enter your real name");
		document.theForm.realname.focus();
	}
	// Check Email Address
	else if (document.theForm.email.value=="")
	{
		alert("You must enter an email address");
		document.theForm.email.focus();
	}
	// Need to check email format?!
	// Check passwords have been filled in 
	else if (document.theForm.password.value=="" || document.theForm.vpassword.value=="")
	{
		alert("You must enter a password");
		if (document.theForm.password.value=="")
			document.theForm.password.focus();
		else
			document.theForm.vpassword.focus();
	}
	// Check Passwords Match
	else if (document.theForm.password.value!=document.theForm.vpassword.value)
	{
		alert("Your passwords do not match");
		document.theForm.password.focus();
	}
	// No need to cehck IM's they're optional
	// check Character last name is filled in (First name / middle name are optional)
	else if (document.theForm.charlastname.value=="")
	{
		alert("You must enter a last name for your character");
		document.theForm.charlastname.focus();
	}
	// check Character last name is filled in (First name / middle name are optional)
	else if (document.theForm.race.value=="")
	{
		alert("You must enter a race for your character");
		document.theForm.race.focus();
	}
	// Check Age
	else if (document.theForm.age.value=="")
	{
		alert("You must enter the age of your character");
		document.theForm.age.focus();
	}
	// Check Birth Month
	else if (document.theForm.birthmonth.value=="")
	{
		alert("You must enter the month your character was born in");
		document.theForm.birthmonth.focus();
	}
	// Check Birth Day
	else if (document.theForm.birthday.value=="")
	{
		alert("You must enter the day your character was born");
		document.theForm.birthday.focus();
	}
	// Check Birth Place
	else if (document.theForm.birthplace.value=="")
	{
		alert("You must enter the place your character was born");
		document.theForm.birthplace.focus();
	}
	// Check Appearance
	else if (document.theForm.appearance.value=="")
	{
		alert("You must enter information about your characters appearance");
		document.theForm.appearance.focus();
	}
	// Check History
	else if (document.theForm.history.value=="")
	{
		alert("You must enter information about your characters history");
		document.theForm.history.focus();
	}
	// Check Experiance
	else if (document.theForm.rpgexperience.value=="")
	{
		alert("You must enter information about your RPG Experiance");
		document.theForm.rpgexperience.focus();
	}
	// Check Sample Post
	else if (document.theForm.post.value=="")
	{
		alert("You must enter a sample post or your application will be ignored");
		document.theForm.post.focus();
	}
	else
	{
		document.theForm.submit();
	}
	// Just return false for now.
	return false;
}