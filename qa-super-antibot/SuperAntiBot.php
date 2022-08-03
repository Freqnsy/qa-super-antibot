<?

$url = "";

if (!class_exists('SuperAntiBot')) {

    @session_start();

    class SuperAntiBot
    {
        public static $count = 4; /* symbol count (by default = 4) */
        public string $invitation_code = "";
        public string $antibot_email = "";

        function __construct($url_)
        {
            global $url;
            $url = $url_;
        }

        /**
         * Returns the HTML form for the user registration page.
         * Two fields are required: an invitation code for the user and an email address where the code can be received.
         * @param $captcha_imput_code
         * @return string
         */
        function qa_captcha_html($captcha_imput_code)
        {
            global $url, $form_div;
            //$img_path = $url."SuperAntiBot.php?image=".time();

            return '<div style="vertical-align:middle;" id="invitation_code_div"><label for="invitation_code">Invitation code:</label>' .
                '<input type="text" class="qa-form-tall-number" name="invitation_code" id="invitation_code"  tabindex="4" autocomplete="off" style="width:100%" />' .
                '</div><div class="qa-form-tall-note">' . $this->antibot_email . '</div>';
        }

        function setEmail($email_)
        {
            $this->antibot_email = $email_;
            //$_SESSION['antibot_email'] = $email_;
        }

        function setInvitation($invite_)
        {
            $_SESSION['TOKEN_ID'] = md5($invite_ . "SuperAntiBot");
        }

    }    //end class

    /**
     * A CaptchaResponse is returned from captcha_check_answer()
     */
    class CaptchaResponse
    {
        var $is_valid;
        var $error;
    }

}    //end if

/**
 *  Answers to check the invitation code
 */
function captcha_check_answer()
{
    global $_POST, $_SESSION;

    $captcha_response = new CaptchaResponse();
    $captcha_response->is_valid = false;
    $captcha_response->error = 'Invitation code';

    $key = (isset($_POST['invitation_code'])) ? $_POST['invitation_code'] : "";
    $securitycode = md5($key . "SuperAntiBot");


    if ($key == "") {
        $captcha_response->error = 'Invitation code is required';
    } else if ($_SESSION['TOKEN_ID'] != $securitycode)
        $captcha_response->error = 'Invalid invitation code. Return back and try input code again.';
    else {
        unset($_SESSION['TOKEN_ID']);
        $captcha_response->is_valid = true;
    }
    return $captcha_response;
}