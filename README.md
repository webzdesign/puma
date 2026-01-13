# Puma Article Management System

A Laravel-based web application for managing product articles, user roles, categories, and customer groups with role-based access control and Excel import/export functionality.

## Project Overview

This application is designed to manage product articles (footwear) with detailed specifications, pricing information for multiple marketplaces (Myntra, AJIO, Amazon, FK), and includes a comprehensive role-based permission system for user management. The system supports OTP-based authentication and provides administrative interfaces for managing users, roles, categories, customer groups, and application settings.

## Tech Stack

### Backend
- **Framework**: Laravel 8.75
- **PHP**: 7.3+ or 8.0+
- **Database**: MySQL
- **Authentication**: Laravel Sanctum (API), Session-based (Web)
- **Authorization**: Laravel Roles Package (jeremykenedy/laravel-roles)

### Frontend
- **CSS Framework**: Bootstrap 5.1.3
- **JavaScript**: jQuery, Axios
- **UI Components**: DataTables, SweetAlert2, Summernote, Select2
- **Build Tool**: Laravel Mix 6.0.6

### Key Packages
- `laravel/sanctum` - API authentication
- `jeremykenedy/laravel-roles` - Role and permission management
- `maatwebsite/excel` - Excel import/export
- `yajra/laravel-datatables-oracle` - Server-side DataTables
- `guzzlehttp/guzzle` - HTTP client
- `fruitcake/laravel-cors` - CORS support

## Folder Structure

```
puma-master/
├── app/
│   ├── Console/           # Artisan commands and scheduled tasks
│   ├── Exceptions/        # Exception handlers
│   ├── Helper/            # Helper functions (Helper.php)
│   ├── Http/
│   │   ├── Controllers/   # Application controllers
│   │   ├── Middleware/    # Custom middleware
│   │   └── Requests/      # Form request validators
│   ├── Imports/           # Excel import classes
│   ├── Mail/              # Mail classes (OTP emails)
│   └── Models/            # Eloquent models
├── bootstrap/             # Application bootstrap files
├── config/                # Configuration files
├── database/
│   ├── factories/         # Model factories
│   ├── migrations/        # Database migrations
│   └── seeders/           # Database seeders
├── public/                # Public assets and entry point
├── resources/
│   ├── css/               # Stylesheets
│   ├── js/                # JavaScript files
│   ├── lang/              # Language files
│   └── views/             # Blade templates
├── routes/                # Route definitions
├── storage/               # Logs, cache, uploaded files
└── tests/                 # Unit and feature tests
```

## Feature List

### User Management
- User CRUD operations with role assignment
- User activation/deactivation
- Email uniqueness validation
- User listing with DataTables
- User profile viewing

### Authentication & Authorization
- OTP-based login system (email OTP)
- Role-based access control (RBAC)
- Permission-based route protection
- Role status checking middleware
- User status validation

### Role & Permission Management
- Role CRUD operations
- Permission assignment to roles
- Category-based role assignment
- Role activation/deactivation
- Permission inheritance support
- Role name uniqueness validation

### Category Management
- Category CRUD operations
- Category code and name validation
- Category-role relationship
- Category activation/deactivation
- Category listing with DataTables

### Customer Group Management
- Customer group CRUD operations
- Group name validation
- Activation/deactivation
- DataTables integration

### Article/Product Management
- Excel import for bulk article data
- Excel export functionality
- Article fields include:
  - Product details (season, codes, style, description)
  - Pricing (MRP, discounts for FK, Myntra, AJIO, Amazon)
  - Product specifications (upper, mid-sole, out-sole)
  - Marketing information
  - Channel and customer targeting

### Settings Management
- Application logo upload
- Favicon management
- Application title configuration
- Session-based settings storage

## Application Flow

### Authentication Flow
1. User enters email on login page
2. System generates 6-digit OTP
3. OTP is stored in database with 5-minute expiration
4. OTP email is sent (currently commented out in code)
5. User enters OTP on verification page
6. System validates OTP and expiration time
7. User is authenticated and redirected to dashboard

### Authorization Flow
1. All authenticated routes are protected by `CheckRoleStatus` middleware
2. Middleware checks:
   - User authentication status
   - User active status
   - User's role active status
3. Routes are further protected by permission middleware (e.g., `permission:view.users`)
4. Users without required permissions are denied access

### Article Import Flow
1. User uploads Excel file via import interface
2. `ArticleImport` class processes the file
3. Data is mapped from Excel columns to Article model fields
4. Articles are created in database
5. Import supports heading row mapping

## API & Third-Party Integrations

### Current Integrations
- **None** - The application does not currently integrate with external APIs, marketplaces, tracking services, or shipping providers.

### Email Service
- Mail configuration supports SMTP, Mailgun, Postmark, SES, and Sendmail
- Default mailer: Sendmail
- OTP emails are prepared but sending is commented out in `LoginController`

### Potential Integrations (Based on Article Fields)
The article model includes fields for marketplace pricing (Myntra, AJIO, Amazon), suggesting potential future integrations, but no API integrations are currently implemented.

## Setup & Installation

### Prerequisites
- PHP 7.3+ or 8.0+
- Composer
- Node.js and npm
- MySQL 5.7+ or MariaDB 10.3+
- Web server (Apache/Nginx) or PHP built-in server

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd puma-master
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure `.env` file**
   - Set database credentials
   - Configure mail settings
   - Set application URL

6. **Run database migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed database (if seeders exist)**
   ```bash
   php artisan db:seed
   ```

8. **Create storage symlink**
   ```bash
   php artisan storage:link
   ```

9. **Compile assets**
   ```bash
   npm run dev
   # or for production
   npm run prod
   ```

10. **Set permissions** (Linux/Mac)
    ```bash
    chmod -R 775 storage bootstrap/cache
    ```

## Environment Variables

Create a `.env` file in the root directory with the following variables:

```env
APP_NAME="Puma_remake"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=puma_db
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=sendmail
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@angelspearlinfotech.com
MAIL_FROM_NAME="Example"

# Laravel Roles Configuration (optional)
ROLES_DATABASE_CONNECTION=
ROLES_INHERITANCE=true
ROLES_GUI_ENABLED=false

# AWS Configuration (if using S3)
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_URL=

# Redis Configuration (if using Redis)
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

## Running the Project

### Local Development

1. **Start the development server**
   ```bash
   php artisan serve
   ```
   Access the application at `http://localhost:8000`

2. **Watch for asset changes**
   ```bash
   npm run watch
   ```

3. **Run queue worker** (if using queues)
   ```bash
   php artisan queue:work
   ```

### Production Deployment

1. **Optimize for production**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan optimize
   ```

2. **Compile production assets**
   ```bash
   npm run production
   ```

3. **Set environment to production**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```

4. **Configure web server** (Apache/Nginx) to point to `public/` directory

## Cron Jobs / Background Tasks

**No scheduled tasks are currently configured** in `app/Console/Kernel.php`. The schedule method is empty.

To add scheduled tasks, modify `app/Console/Kernel.php`:

```php
protected function schedule(Schedule $schedule)
{
    // Example: Run daily at midnight
    // $schedule->command('inspire')->daily();
}
```

Then add the cron entry to your server:
```bash
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```

## Database Models & Relationships

### User Model
- **Relationships**:
  - `belongsTo` Role
  - `hasManyThrough` Permission (via PermissionUser)
- **Fields**: name, email, password, role_id, otp, otp_expire, status, added_by, updated_by

### Role Model
- **Relationships**:
  - `hasMany` Users
  - `belongsToMany` Categories (via categories_roles)
- **Fields**: name, slug, description, status

### Category Model
- **Relationships**:
  - `belongsTo` User (addedBy, updatedBy)
  - `belongsToMany` Roles (via categories_roles)
- **Fields**: name, slug, code, status, added_by, updated_by

### Article Model
- **Relationships**: None defined
- **Fields**: Extensive product information including season, codes, pricing, descriptions, marketplace-specific pricing

### CustomerGroup Model
- **Relationships**:
  - `belongsTo` User (addedBy, updatedBy)
- **Fields**: name, slug, status, added_by, updated_by

### Setting Model
- **Relationships**: None
- **Fields**: name, logo, favicon

## Common Use Cases

### Creating a New User
1. Navigate to User Management
2. Click "Create User"
3. Fill in name, email, password
4. Select role
5. Set active status
6. Save

### Importing Articles
1. Navigate to Import/Export view
2. Upload Excel file with article data
3. System processes and imports data
4. Articles are created in database

### Managing Roles and Permissions
1. Create/edit role in Role Management
2. Assign permissions to role
3. Assign categories to role
4. Users with this role inherit permissions

### Configuring Application Settings
1. Navigate to Settings
2. Upload logo and favicon
3. Set application title
4. Save changes

## Known Limitations

1. **OTP Email Sending**: OTP email sending is commented out in `LoginController::login()` method. OTP is generated and stored but not sent via email.

2. **Article Export**: Export route exists but controller method is not fully implemented (only import is functional).

3. **API Routes**: API routes are minimal - only includes a basic Sanctum-protected user endpoint.

4. **No Marketplace Integration**: Despite article fields suggesting marketplace integration (Myntra, AJIO, Amazon), no actual API integrations exist.

5. **No Background Jobs**: No queue jobs or scheduled tasks are implemented.

6. **Limited Validation**: Some controllers may need additional validation for edge cases.

7. **Hardcoded Values**: Some configuration values are hardcoded (e.g., OTP expiration: 5 minutes, default mail from address).

## Future Improvements

Based on code analysis:

1. **Enable OTP Email Sending**: Uncomment and configure email sending in `LoginController`.

2. **Implement Article Export**: Complete the export functionality in `ArticleController`.

3. **Add Marketplace API Integrations**: Implement actual integrations with Myntra, AJIO, Amazon APIs for price synchronization.

4. **Background Job Processing**: Implement queue jobs for:
   - Email sending
   - Bulk article imports
   - Data synchronization

5. **API Development**: Expand API routes for mobile/frontend integration.

6. **Enhanced Validation**: Add more comprehensive validation rules and error handling.

7. **Audit Logging**: Implement activity logging for user actions.

8. **Search & Filtering**: Add advanced search and filtering for articles.

9. **Bulk Operations**: Implement bulk edit/delete operations for articles.

10. **Data Export Formats**: Support multiple export formats (CSV, PDF, etc.).

## Contribution Guidelines

1. **Fork the repository** and create a feature branch.

2. **Follow coding standards**:
   - Use PSR-12 coding standard
   - Write meaningful commit messages
   - Add comments for complex logic

3. **Testing**:
   - Write tests for new features
   - Ensure existing tests pass

4. **Documentation**:
   - Update README if adding features
   - Document API changes
   - Add inline comments where necessary

5. **Submit Pull Request**:
   - Provide clear description of changes
   - Reference related issues
   - Ensure code is reviewed before merging

## License

**MIT License** - See `composer.json` for license details.

---

## Support

For issues, questions, or contributions, please refer to the project repository or contact the development team.

**Note**: This application appears to be a product management system for Puma footwear, with capabilities for managing product data, user access, and administrative settings. Ensure proper security measures are in place before deploying to production.
