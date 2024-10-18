# Blackcoffer OPC Assignment - Visualization Dashboard

This project is a Visualization Dashboard built using PHP Laravel and MySQL. The dashboard visualizes data from a CSV file and allows users to interactively filter and explore the data based on various parameters such as intensity, likelihood, relevance, year, country, topics, region, and city.

## Features

- **Interactive Dashboard**: Visualizations like graphs and charts for data analysis.
- **Filters**: Allows dynamic filtering of data using AJAX without page reload.
- **CSV Data Integration**: Data is imported from a CSV file and stored in a MySQL database.
- **API for Data Fetching**: Custom API built in PHP to fetch data for visualizations.
- **Visualization Libraries**: Integrates with libraries like  Chart.js for creating interactive graphs and charts.

## Installation

### Prerequisites

Ensure you have the following installed on your system:

- PHP >= 8.0
- Composer
- MySQL
- Laravel >= 9.x

### Setup Instructions

1. **Clone the Repository**:

    ```bash
    git clone https://github.com/sachin-007/Blackcoffer-OPC--assignment-visualization-dashboard.git
    cd Blackcoffer-OPC--assignment-visualization-dashboard
    ```

2. **Install Dependencies**:

    ```bash
    composer install
    ```

3. **Environment Setup**:

    Copy the `.env.example` file to `.env` and update your database details:

    ```bash
    cp .env.example .env
    ```

    Open `.env` and configure your database settings:

    ```env
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    DB_DATABASE=dashboard_db
    
    ```

4. **Generate Application Key**:

    ```bash
    php artisan key:generate
    ```

5. **Run Migrations**:

    To create the necessary database tables, run the migrations:

    ```bash
    php artisan migrate
    ```

6. **Seed the Database**:

    Then run the seeder:

    ```bash
    php artisan db:seed --class=DataSeeder
    ```

7. **Serve the Application**:

    Run the application locally:

    ```bash
    php artisan serve
    ```

    The application will be available at `http://localhost:8000`.

## API Endpoints

- **GET /api/dashboard-data**: Fetches data from the database for visualization.

## Frontend

The frontend includes the following libraries for data visualization:
  
  The charts and graphs are dynamically generated and allow real-time filtering using AJAX requests to the backend API.


### Developer

- **Sachin**
- Email: [sachinbachhav006@gmail.com](mailto:sachinbachhav006@gmail.com)
- GitHub: [github.com/sachin-007](https://github.com/sachin-007)
