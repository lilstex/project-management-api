# Project Management API

The Project Management API is a Laravel-based application designed to manage projects and tasks within those projects. It provides endpoints for creating projects, assigning users to projects, and managing tasks associated with those projects.

## Features

- **Project Management**: Users can create, update, and delete projects.
- **Task Management**: Users can create, update, delete, and retrieve tasks within their assigned projects.
- **User Management**: Users can be assigned to projects, allowing for collaboration within teams.
- **Access Control**: Users can only perform CRUD actions on tasks within projects they are assigned to.

## Requirements

- PHP 8.0 or higher
- Laravel 10.x
- Composer
- MySQL or any other supported database system

## Installation

1. Clone the repository:

```
git clone <repository_url>
```

2. Install dependencies:

```
composer install
```

3. Copy `.env.example` to `.env` and configure your environment variables, including database connection details.

4. Generate application key:

```
php artisan key:generate
```

5. Run migrations to create the necessary database tables:

```
php artisan migrate
```

6. (Optional) Seed the database with sample data:

```
php artisan db:seed
```

7. Start the development server:

```
php artisan serve
```

## API Endpoints

### Projects

- `GET /api/projects`: Retrieve all projects.
- `POST /api/projects`: Create a new project.
- `GET /api/projects/{id}`: Retrieve a specific project by ID.
- `PUT /api/projects/{id}`: Update a project.
- `DELETE /api/projects/{id}`: Delete a project.

### Tasks

- `GET /api/projects/{project_id}/tasks`: Retrieve all tasks within a project.
- `POST /api/projects/{project_id}/tasks`: Create a new task within a project.
- `GET /api/projects/{project_id}/tasks/{task_id}`: Retrieve a specific task within a project.
- `PUT /api/projects/{project_id}/tasks/{task_id}`: Update a task within a project.
- `DELETE /api/projects/{project_id}/tasks/{task_id}`: Delete a task within a project.

## Authentication

Authentication is required for most endpoints. Laravel Sanctum was used in this project.

## Authorization

Access control is enforced based on user roles and project assignments. Users can only perform CRUD actions on tasks within projects they are assigned to.