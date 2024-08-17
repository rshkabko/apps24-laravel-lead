# Apps24 Laravel Lead integration

## Installation

```bash
composer require flamix/apps24-laravel-lead

// Add to .env
LEAD24_PORTAL=portal.apps24.com
LEAD24_API_KEY=sec***********ret

// Use in controller
app('lead24')->send(['FIELDS' => ['NAME' => 'John Doe', 'PHONE' => '123456789', 'EMAIL' => 'john.doe@gmail.com']]]);
```
