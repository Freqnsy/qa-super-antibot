<?php

// don't allow this page to be requested directly from browser
if (!defined('QA_VERSION')) {
    header('Location: ../../');
    exit;
}

// To register a module
qa_register_plugin_module('captcha', 'qa-super-antibot.php', 'qa_super_antibot', 'Super Anti Bot');
