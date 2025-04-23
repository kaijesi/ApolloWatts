#   ApolloWatts

##   Project Description

ApolloWatts is a Laravel-based web application designed to help manage and monitor solar panel installations. It provides tools for:

* Managing installations: Store and retrieve data about solar panel systems, including location, size, and technical specifications.
* User authentication and management: Securely manage user accounts and access to the application. Users are organised in households, which can have multiple installations accessible to all household members and editable by household admins.
* Calculating and visualizing energy production: 
    * Estimate and display the energy output of the registered installations using data from [PVGIS](https://joint-research-centre.ec.europa.eu/photovoltaic-geographical-information-system-pvgis_en) (an EU-managed API-accessible database with solar radiation data).
    * Retrieve real-time data for installations using Solis inverters and their [Cloud-based tracking service](https://soliscloud.com/#/homepage)

##   Table of Contents

* [Features](#features)
* [Technology Stack](#technology-stack)
* [Installation](#installation)
* [Usage](#usage)
* [Notes](#notes)

##   Features

* **Installation Management:**
    * Store detailed information about solar installations (location, peak power, panel technology, etc.).
    * Ability to create, read, update, and delete installations.
* **Energy Production Calculation:**
    * Integration with PVGIS or similar services to fetch solar radiation data.
    * Calculation of estimated energy production based on installation parameters and solar radiation data.
    * Visualize real energy production data (only for Solis-based installations).
* **User Authentication and Management:**
    * Secure user registration and login functionality.
    * Role-based access control (household admins & members).
* **Database Management:**
    * Uses Laravel's Eloquent ORM to interact with the database.
    * Database migrations for easy setup and schema management.
* **Modern Web Interface**
    * Dynamic front-end using Blade templates combined with jQuery-based interactivity.
    * Responsive design thanks to Bootstrap.

##   Technology Stack

* Laravel: PHP framework used for the backend
* MySQL: Database
* Composer: PHP Dependency Management
* Blade: Templating engine
* JavaScript
    * jQuery
    * Chart.js
* PVGIS API
* SolisCloud API (*note that a valid API key and secret are required*)

##   Installation

###   Prerequisites

* PHP >= 8.0
* Composer
* MySQL
* Node.js + NPM

### Installation Steps

1.  Clone the repository:

    ```bash
    git clone [https://github.com/kaijesi/ApolloWatts.git](https://github.com/kaijesi/ApolloWatts.git)
    ```

2.  Navigate to the project directory:

    ```bash
    cd ApolloWatts
    ```

3.  Install Composer dependencies:

    ```bash
    composer install
    ```

4.  Copy the  `.env.example`  file to  `.env`:

    ```bash
    cp .env.example .env
    ```

5.  Configure your  `.env`  file with database credentials and other settings.

6.  Generate an application key:

    ```bash
    php artisan key:generate
    ```

7.  Run database migrations and seed:

    ```bash
    php artisan migrate:fresh --seed
    ```

8.  Install Node dependencies:

    ```bash
    npm install
    ```

9.  Compile assets:

    ```bash
    npm run build
    ```

##   Usage

1.  Start the Laravel development server:

    ```bash
    php artisan serve
    ```

2.  Access the application in your web browser at  `http://localhost:8000`.
