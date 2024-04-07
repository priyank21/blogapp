# BlogApp

## Description

BlogApp is a web application built with Laravel that allows users to create, view, edit, and delete blog posts. It provides a user-friendly interface for managing blog content and interacting with other users' posts.

## Installation (Without Docker)
- To run the BlogApp locally, follow these steps:


## Clone the Repository:

    git clone <repository-url>


## Navigate to the Project Directory:

    cd blogapp


## Install Dependencies:

    composer install


## Configure Database in .env File:
    DB_DATABASE=******
    DB_USERNAME=******
    DB_PASSWORD=*****

Replace stars to your mysql db password,username and db name for the project.

## Generate Application Key:
    
    php artisan key:generate

## Installation (By Docker)

### Build Docker Image:
    
    docker-compose build

### Start Docker Containers:

    docker-compose up -d

### Access the Application:

Open your web browser and visit http://localhost to access the BlogApp.

# Architecture

The BlogApp project follows the Model-View-Controller (MVC) architecture pattern, with additional components such as:

--Models: Represent database tables and handle data manipulation.
--Views: Render HTML templates and present data to users.
--Controllers: Handle incoming HTTP requests, process data, and send responses.
--Routes: Define the endpoints and corresponding controller methods.
--Middleware: Implement logic that filters HTTP requests entering the application.

# Design Decisions

--Database Design: Utilizes a relational database schema to store blog posts and user information.
--User Authentication: Implements user authentication and authorization for managing blog posts.
--Frontend Framework: Utilizes Laravel Blade for server-side rendering and minimal JavaScript for interactivity.
--Validation: Implements form validation to ensure data integrity and security.
--RESTful API: Follows RESTful principles for defining API endpoints and handling HTTP methods.


## Run Test cases:
    If Data exits in tables run
    -- php artisan migrate:fresh --env=testing
    Run test for Blogs
    -- php artisan test tests/Feature/BlogPostControllerTest.php
    For Whole application
    -- php artisan test

