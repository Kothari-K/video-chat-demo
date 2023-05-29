# video-chat-demo
create a video chat with draggable window in laravel+vue3 using sample-peer

# Laravel Vue3 Files

This repository contains a collection of Laravel and Vue.js files that demonstrate the integration of Laravel, a PHP framework, with Vue.js version 3, a JavaScript framework.

## Installation

To use these files, follow the steps below:

1. Clone the repository to your local machine:

   ```
   git clone <repository-url>
   ```

2. Change into the project directory:

   ```
   cd laravel-video-chat-demo
   ```

3. Install the required dependencies using Composer:

   ```
   composer install
   ```

4. Create a copy of the `.env.example` file and rename it to `.env`. Update the necessary configurations such as the database connection details.

   ```
   cp .env.example .env
   ```

5. Generate an application key:

   ```
   php artisan key:generate
   ```

6. Run the database migrations and seed the database:

   ```
   php artisan migrate --seed
   ```

7. Install the required JavaScript dependencies using npm or Yarn:

   ```
   npm install
   ```

   or

   ```
   yarn install
   ```

## Usage

Once the installation is complete, you can start the development server:

```
npm run dev
```

or

```
yarn dev
```

This will compile the Vue.js components and start the Laravel development server.

You can access the application by navigating to `http://localhost:8000` in your web browser.

## Folder Structure

The repository is structured as follows:

- `app/` - Contains the Laravel application files, including models, controllers, and views.
- `resources/js/` - Contains the Vue.js components and related JavaScript files.
- `resources/views/` - Contains the Blade templates for rendering views.
- `routes/` - Defines the routes for the Laravel application.
- `database/migrations/` - Contains the database migration files.
- `database/seeds/` - Contains the database seed files.
- `public/` - The public folder serves as the document root for the application.

## Contributing

If you would like to contribute to this project, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Make your changes and commit them with descriptive commit messages.
4. Push your changes to your forked repository.
5. Submit a pull request to the original repository.

Please ensure that your code adheres to the coding standards and is well-documented.

## License

This project is open-source and released under the [MIT License](LICENSE). Feel free to use and modify the code according to your needs.
