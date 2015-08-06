# Simple Mandrill Wordpress Plugin

I've found the offical [Mandrill WP plugin](https://wordpress.org/plugins/wpmandrill/) to be quite bloated and slow for my needs, so I created a really small/simple plugin that just wraps the Mandrill PHP API. It overrides wp_mail so all wp_mail calls should work.

**Note:** For now API/email settings are defined right in the plugin itself. This is really just a one off for now so I haven't taken the time to make things more properly configurable. 
