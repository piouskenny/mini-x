
---

## Overview

Mini-X is a social media platform built using Laravel, designed to provide users with a seamless and interactive experience for sharing moments, connecting with others, and staying updated. The project follows the Repository architectural system design pattern and adheres to standard organizational principles, ensuring maintainability and scalability.

### Key Features

- **User Authentication and Email Verification**: Secure user registration and login with email verification for enhanced account security.
- **Profile Management**: View and update user profiles, including personal information, profile picture, and bio.
- **Post Management**: Create, delete, and like posts, providing users with a platform to share their thoughts and experiences.
- **Comment System**: Comment on posts in a tree structure, facilitating engaging conversations and discussions.
- **Follow/Unfollow Users**: Stay connected with friends and peers by following or unfollowing users, enabling users to curate their feeds.

## Installation

### Prerequisites

- PHP >= 8.1
- Composer
- MySQL / PostgreSQL / SQLite / SQL Server

### Installation Steps

1. Clone the repository:

   ```bash
   git clone https://github.com/piouskenny/mini-x.git
   ```

2. Navigate to the project directory:

   ```bash
   cd mini-x
   ```

3. Install PHP dependencies:

   ```bash
   composer install
   ```

4. Set up your environment variables by copying the `.env.example` file:

   ```bash
   cp .env.example .env
   ```

5. Generate an application key:

   ```bash
   php artisan key:generate
   ```

6. Configure your database settings in the `.env` file:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   ```

7. Migrate the database:

   ```bash
   php artisan migrate
   ```

8. Start the Laravel development server:

   ```bash
   php artisan serve
   ```

## Usage

- Register an account and verify your email address to get started.
- Explore the platform by viewing profiles, creating posts, commenting on posts, and following other users.
- Update your profile information to personalize your account.

## Contributing

Contributions are welcome! If you have any ideas, improvements, or bug fixes, feel free to submit a pull request.

## License

Mini-X is open-source software licensed under the [MIT license](LICENSE).

