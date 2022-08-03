<?php

class qa_super_antibot
{
    var $directory;
    var $urltoroot;

    /**
     * @param $directory
     * @param $urltoroot
     * @return void
     */
    function load_module($directory, $urltoroot)
    {
        $this->directory = $directory;
        $this->urltoroot = $urltoroot;
    }

    /**
     *  Set default setting for plugin
     */
    function option_default($option)
    {
        if ($option == 'antibot_email')
            return "To get the code, contact support@email.com";

        if ($option == 'invitation_code')
            return "invitation_code";

    }

    /**
     * If defined, this function allows the captcha module to indicate whether it is ready to be used.
     * @return bool
     */
    function allow_captcha(): bool
    {
        return true;
    }

    /**
     * This function returns the HTML form for setting of plugin in admin panel
     */
    function admin_form()
    {
        $saved = false;

        if (qa_clicked('antibotcaptcha_save_button')) {
            qa_opt('antibot_email', qa_post_text('antibot_email_field'));
            qa_opt('invitation_code', qa_post_text('invitation_code_field'));

            $saved = true;
        }

        $form = array(
            'ok' => $saved ? 'SuperAntiBot settings saved' : null,

            'fields' => array(
                'count' => array(
                    'label' => 'Your message for user:',
                    'value' => qa_opt('antibot_email'),
                    'tags' => 'NAME="antibot_email_field"',
                    'type' => 'text',
                    // 'error' => $this->antibotcaptcha_error(),
                ),

                'charset' => array(
                    'label' => 'Invitation code:',
                    'value' => qa_opt('invitation_code'),
                    'tags' => 'NAME="invitation_code_field"',
                ),

            ),

            'buttons' => array(
                array(
                    'label' => 'Save Changes',
                    'tags' => 'NAME="antibotcaptcha_save_button"',
                ),
            ),
        );

        return $form;
    }

    /**
     * This function returns the HTML form to be displayed for the captcha challenge
     * @param $qa_content
     * @param $error
     * @return string
     */
    function form_html(&$qa_content, $error): string
    {
        require_once $this->directory . 'SuperAntiBot.php';
        $secimg = new SuperAntiBot($this->urltoroot);
        $secimg->setEmail(qa_opt('antibot_email'));
        $secimg->setInvitation(qa_opt('invitation_code'));
        return $secimg->qa_captcha_html(qa_lang_html('misc/captcha_error'));

    }

    /**
     * This function returns whether the user responded to the captcha correctly.
     * @param $error
     * @return bool
     */
    function validate_post(&$error): bool
    {
        if ($this->allow_captcha()) {
            require_once $this->directory . 'SuperAntiBot.php';

            $answer = captcha_check_answer();

            if ($answer->is_valid) {
                return true;
            }

            $error = $answer->error;
        }

        return false;
    }

}