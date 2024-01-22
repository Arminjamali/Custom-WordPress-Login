![Custom WordPress Login](thumbjpg)


**Repository Description:**

## Custom WordPress Login and Redirect Code

This code snippet enhances the WordPress login process, offering advanced redirection features based on user roles and a predefined hash parameter. The snippet includes a custom rewrite rule and query variable for additional flexibility.

### Features:

- **Custom Login Redirect:**
  - Redirects administrators to the WordPress admin dashboard upon login.
  - Allows for custom redirection for users with a specific hash parameter (`mylogin`).

- **Prevent Default WP Login Redirect:**
  - Prevents automatic redirection to the default WordPress login page.
  - Displays a 404 error if users attempt to access `wp-login.php` without the necessary parameters.

- **Custom Rewrite Rule:**
  - Adds a custom rewrite rule for the endpoint `wp-armin`.

- **Custom Query Variable:**
  - Introduces a custom query variable (`mylogin`) for handling special login scenarios.

- **Template Redirect:**
  - Redirects users to `wp-login.php` with a hashed value when the custom query variable is set to `true`.

### Usage:

1. Integrate the code into your WordPress theme's `functions.php` file or create a custom plugin.
2. Customize the code behavior by modifying the provided functions.
3. Access the login page using the custom endpoint: `your-site.com/wp-armin`.
4. Utilize the `mylogin` query parameter with the hashed value (`6666`) for special login scenarios.

### Important Note:

Understand the implications of modifying the login and redirection process. This code is intended for educational purposes and should be used cautiously in production environments.

### Disclaimer:

This code snippet is provided as-is without any warranty. Use at your own risk. Feel free to integrate, modify, or use the code for your specific WordPress customization needs.
