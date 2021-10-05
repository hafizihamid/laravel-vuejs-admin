<?php

return [
    'status_codes' => [
        'ok' => '00',
        'validation_failed' => '21',
        'invalid_scope' => '22',
        'authentication_error' => '23',
        'permission_denied' => '24',
        'record_not_found' => '25',
        'forbidden' => '26',
        'error' => '99',
    ],

    'http_codes' => [
        'success' => '200',
        'bad_request' => '400',
        'unauthorized' => '401',
        'forbidden' => '403',
        'not_found' => '404',
        'unprocessable_entity' => '422',
        'internal_server_error' => '500',
    ],

    'messages' => [
        'authentication_error' => 'Authentication error.',
        'authentication_logout_success' => 'Logout successful.',
        'authentication_logout_fail' => 'User not authenticated.',
        'authentication_reset_email_successful' => 'Password reset email sent successfully.',
        'authentication_reset_email_failed' => 'Password reset email failed to send.',
        'authentication_reset_successful' => 'Password reset successful.',
        'authentication_reset_invalid_token' => 'Invalid reset token.',
        'authentication_set_password_successful' => 'Password set successful.',
        'authentication_set_password_invalid_token' => 'Invalid token.',
        'authentication_change_old_password_incorrect' => 'Old password incorrect.',
        'role_permission_unauthorize' => 'Permission denied.',
        'role_grant_permission_denied' => 'User is not allowed to grant certain permission.',
        'role_not_found' => 'Role not found',
        'role_delete_with_user' => 'There is user(s) attached to the role. Please reassign user before deleting.',
        'role_forbid_delete' => 'This role cannot be deleted.',
        'role_superadmin_not_updateable' => "Super Admin cannot be updated.",
        'action_fail' => 'Action failed.',
        'action_success' => 'Action successful.',
        'action_not_allow' => 'Action not allowed.',
        'user_disabled' => 'User is disabled.',
        'user_not_found' => 'User not found.',
        'validation_failed' => 'Validation Failed!',
        'contact_us_failed' => 'Fail to submit feedback.',
        'contact_us_success' => 'Feedback submitted successfully.',
        'email_failed' => 'Email failed to send.',
        'format_invalid' => ' format is invalid'
    ],

    'email' => [
        'sendgrid_url' => env('SENDGRID_API_URL'),
        'sendgrid_token' => env('SENDGRID_API_KEY'),
        'mail_to_address' => env('MAIL_TO_ADDRESS'),
        'mail_to_name' => env('MAIL_TO_NAME'),
        'default_customer_name' => env('DEFAULT_CUSTOMER_NAME', 'Customer')
    ],

    'email_template' => [
        'contact_us' => env('CONTACT_US_EMAIL_ID'),
        'reset_password' => env('RESET_PASSWORD_EMAIL_ID'),
        'set_password' => env('SET_PASSWORD_EMAIL_ID')
    ],

    'token_scopes' => [
        'lazic-beauty'
    ],

    'default_per_page' => 10
];
