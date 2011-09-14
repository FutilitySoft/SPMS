<?php
/**
 * This file contains the plainMail Class which is used to send plain text emails to people.
 *
 * @package PrimaryClasses
 * @author Dan Taylor <d.taylor@primary-group.net>
 * @version 1.0
 *
 */

/**
 * plainMail Class
 * @package PrimaryClasses
 * @author Dan Taylor <d.taylor@primary-group.net>
 *
 */

class plainMail
{
	/**
	 * @var string contains To field information
	 * @access public
	 */
	var $to = '';
	
	/**
	 * @var string contains From field information
	 * @access public
	 */
	var $from = '';
	
	/**
	 * @var string contains Reply To field information
	 * @access public
	 */
	var $reply_to = '';
	
	/**
	 * @var string contains CC field information
	 * @access public
	 */
	var $cc = '';
	
	/**
	 * @var string contains Blind Carbon Copy field information
	 * @access public
	 */
	var $bcc = '';
	
	/**
	 * @var string contains the emails Subject
	 * @access public
	 */
	var $subject = '';
	
	/**
	 * @var string contains the emails Body
	 * @access public
	 */
	var $body = '';
	
	// Check variables
	/**
	 * @var boolean Flag's whether to validate the emails
	 * @access public
	 */
	var $validate_email = true;
	
	/**
	 * @var Boolean Flag's whether to do a rigorous email check
	 * @access public
	 */
	var $rigorus_email_check = false;
	
	// Control empty emails
	/**
	 * @var boolean Flag's whether or not to allow empty subjects
	 * @access public
	 */
	var $allow_empty_subject = false;
	
	/**
	 * @var boolean Flag's whether or not to allow an empty body
	 * @access public
	 */
	var $allow_empty_body = false;
	
	// Headers
	/**
	 * @var array Holds the header info for the email
	 * @access private
	 */
	var $headers = array();
	
	/**
	 * @var string mailer Sets the mailer type for this message
	 * @access private
	 */
	var $mailer = "Primary-Mail Version 1.0";
	
	/**
	 * @var int priority Sets Email Priority
	 * @access private
	 */
	var $priority = 1;
	
	/**
	 * @var int mspriority Sets Microsoft Email Priority
	 * @access private
	 */
	var $mspriority = 1;
	
	/**
	 * @var string contains any error messages which are created
	 * @access private
	 */
	var $ERROR_MSG = "";
	
	// Error Messages
	/**
	 * @var string Empty To field error message
	 * @access private
	 */
	var $ERR_EMPTY_MAIL_TO = "Empty to field!";
	
	/**
	 * @var string Empty Subject field error message
	 * @access private
	 */
	var $ERR_EMPTY_SUBJECT = "Empty subject field!";
	
	/**
	 * @var string Empty Body error message
	 * @access private
	 */
	var $ERR_EMPTY_BODY = "Empty body!";
	
	/**
	 * @var string Send Mail Failure error message
	 * @access private
	 */
	var $ERR_SEND_MAIL_FAILURE = "An error occured while trying to send email!";
	
	/**
	 * @var string To Field Invalid error message
	 * @access private
	 */
	var $ERR_TO_FIELD_INVALID = "To field contains invalid email address(es)!";
	
	/**
	 * @var string CC Field Invalid error message
	 * @access private
	 */
	var $ERR_CC_FIELD_INVALID = "CC field contains invalid email address(es)!";
	
	/**
	 * @var string BCC Field Invalid error message
	 * @access private
	 */
	var $ERR_BCC_FIELD_INVALID = "BCC field contains invalid email address(es)!";
	
	/**
	 * @var string No Error Message
	 * @access private
	 */
	var $STR_NO_ERROR = "No error has occured yet";
	
	/**
	 * checkFields
	 *
	 * Checks the fields of an email, checks that the to, cc and bcc fields are valid.
	 *
	 * @access private
	 * @return Boolean True or False on success or failure
	 */
	function checkFields()
	{
		if (empty ($this->to))
		{
			$this->ERROR_MSG = $this->ERR_EMPTY_MAIL_TO;
			return false;
		}
		
		if (!$this->allow_empty_error_subject && empty($this->subject))
		{
			$this->ERROR_MSG = $this->ERR_EMPTY_SUBJECT;
			return false;
		}
		
		if (!$this->allow_empty_error_body && empty($this->body))
		{
			$this->ERROR_MSG = $this->ERR_EMPTY_BODY;
			return false;
		}
		
		// Replace any ; in the email address fields with ,
		$this->to = ereg_replace(";", ",", $this->to);
		$this->cc = ereg_replace(";", ",", $this->cc);
		$this->bcc = ereg_replace(";", ",", $this->bcc);
		
		// Populate Mail Headers
		if (empty($this->from))
		{
			$this->headers[] = "From: $this->from";
		}
		
		if (empty($this->reply_to))
		{
			$this->headers[] = "Reply-To: $this->reply_to";
		}
		
		// Check Email Address if option is on
		if ($this->validate_email)
		{
			$to_emails = explode(",", $this->to);
			if (!empty($this->cc))
			{
				$cc_emails = explode(",", $this->cc);
			}
			
			if (!empty($this->bcc))
			{
				$bcc_emails = explode(",", $this->bcc);
			}
			
			
			if ($this->rigorous_email_check)
			{
				if (!$this->rigorousEmailCheck($to_emails))
				{
					$this->ERROR_MSG = $this->ERR_TO_FIELD_INVALID;
					return false;
				}
				else if (is_array($cc_emails) && !$this->rigorousEmailCheck($cc_emails))
				{
					$this->ERROR_MSG = $this->ERR_CC_FIELD_INVALID;
					return false;
				}
				else if (is_array($bcc_emails) && !$this->rigorousEmailCheck($bcc_emails))
				{
					$this->ERROR_MSG = $this->ERR_BCC_FIELD_INVALID;
					return false;
				}
			}
			else
			{
				if (!$this->emailCheck($to_emails))
				{
					$this->ERROR_MSG = $this->ERR_TO_FIELD_INVALID;
					return false;
				}
				else if (is_array($cc_emails) && !$this->emailCheck($cc_emails))
				{
					$this->ERROR_MSG = $this->ERR_CC_FIELD_INVALID;
					return false;
				}
				else if (is_array($bcc_emails) && !$this->emailCheck($bbc_emails))
				{
					$this->ERROR_MSG = $this->ERR_BCC_FIELD_INVALID;
					return false;
				}
			}
		}
		
		return true;
	}
// End checkFields Function

	/**
	 * emailCheck
	 *
	 * Checks that the array of email addresses passed to it are valid.
	 *
	 * @access private
	 *
	 * @param array $emails List of emails to check
	 * @return boolean True or False depending on success or failure.
	 */
	function emailCheck($emails)
	{
		//print_r($emails);
		foreach ($emails as $email)
		{
			if (eregi("<(.+)>", $email, $match))
			{
				$email = $match[1];
			}
		
			if (!eregi("^[_\-\.0-9a-z]+@([0-9a-z][_0-9a-z\.\-]+)\.([a-z]{2,4}$)", $email))
			{
				return false;
			}
		}
		return true;
	}
// End emailCheck Function

	/**
	 * rigorousEmailCheck
	 *
	 * Checks that the array of email addresses passed to it are valid and have valid domain names.
	 *
	 * @access private
	 *
	 * @param array $emails List of emails to check
	 * @return boolean True or False depending on success or failure.
	 */
	function rigorousEmailCheck($emails)
	{
		// Run the standard email checks first
		if (!$this->emailCheck($emails))
		{
			return false;
		}
	
		foreach ($emails as $email)
		{
			list ($user, $domain) = split("@", $email, 2);
			if (checkdnsrr($domain, "ANY"))
			{
				return true; // Domain Found return true
			}
			else
			{
				return false; // Domain Not Found! Return false
			}
		}
	}
// End rigorousEmailCheck Function

	/**
	 * buildHeaders
	 *
	 * Builds the header for the email
	 *
	 * @access private
	 *
	 * @return void
	 */
	function buildHeaders()
	{
		$this->headers[] = "To: $this->to";
		$this->headers[] = "From: $this->from";
		$this->headers[] = "Reply-To: $this->from";
		// Generate Additional Headers
		if (!empty($this->cc))
		{
			$this->headers[] = "Cc: $this->cc";
		}
		if (!empty($this->bcc))
		{
			$this->headers[] = "Bcc: $this->bcc";
		}
		$this->headers[] = "X-Priority: $this->priority";
		$this->headers[] = "X-MSMail-Priority: $this->mspriority";
		$this->headers[] = "X-Mailer: $this->mailer";
		$this->headers[] = "Origin: ".$_SERVER["REMOTE_ADDR"];
	}
// End buildHeaders Function

// Start viewMsg Function
	/**
	 * viewMsg()
	 *
	 * Builds the message and returns it in a variable for use by the script
	 *
	 * @access Public
	 *
	 * @return string Which is the email, lines added by \r\n
	 */
	function viewMsg()
	{
		if (!$this->checkFields())
		{
			return false;
		}
	
		$this->headers = array();
		
		$this->buildHeaders();
	
		$this->headers[] = "Subject: $this->subject";
	
		$msg = implode("\r\n", $this->headers);
		$msg .= "\r\n\r\n";
		$msg .= $this->body;
	
		return $msg;
	}
// End viewMsg Function

	/**
	 * send
	 *
	 * Sends the email which has been built
	 *
	 * @access public
	 *
	 * @return boolean True or False depending on success or failure of sending message
	 */
	function send()
	{
		if (!$this->checkFields())
		{
			return false;
		}
	
		$this->buildHeaders();
	
		if (mail($this->to, stripslashes(trim($this->subject)), stripslashes($this->body), implode("\r\n", $this->headers) ) )
		{
			return true;
		}
		else
		{
			$this->ERROR_MSG = $this->ERR_SEND_MAIL_FAILURE;
			return false;
		}
	}
// End Send Function

	/**
	 * emailCheck
	 *
	 * Checks for an error message, returns it or an okay message if there is no error
	 *
	 * @access Public
	 * @return string Returns any error in the system, or no error message if everything is okay
	 */
	function errorMsg()
	{
		if (empty($this->ERROR_MSG))
		{
			return $this->STR_NO_ERROR;
		}
		else
		{
			return $this->ERROR_MSG;
		}
	}
}
?>
