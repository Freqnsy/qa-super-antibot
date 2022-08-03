# Super AntiBot
### *Plugin for Question2Answer (Q2A) site*
This is captcha module provide a web interface for human verification during registration.

Registration is carried out by invitation code. The code must be specified in advance in the plugin settings and the invitation code can be changed at any time through the admin panel.

This plugin is suitable for sites where you need to control user registration personally. Not public registrations.

### How to install

#### 1. Place the plugin folder `qa-super-antibot` in a folder `your.site/qa-plugin/` on your Q2A site.


#### 2. Enable the plugin on the plugins page in the admin panel.
Customize your invitation code and message to users.
![Super AntiBot plugin setting](https://github.com/Freqnsy/qa-super-antibot/blob/main/screenshots/plugin_panel.png?raw=true "Plugin setting panel")


#### 3. Activate captcha support in `Administration center - Spam` and select `Super Anti Bot`.
![Super AntiBot plugin activation](https://github.com/Freqnsy/qa-super-antibot/blob/main/screenshots/admin_panel.png?raw=true "Plugin activation")


#### 4. All now the user, following your instructions, will be able to receive an invitation code and register on the site.
![Registration form with Super AntiBot](https://github.com/Freqnsy/qa-super-antibot/blob/main/screenshots/sign_up_form.png?raw=true "Registration form")

To prevent code brute force, set IP limits in the admin panel

More information: [https://www.question2answer.org/](https://www.question2answer.org/)
