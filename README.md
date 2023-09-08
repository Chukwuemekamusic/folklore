# Folktales and Myths Web Application

This repository contains the source code and Docker Compose configuration for the Folktales and Myths web application. You can use Docker Compose to easily set up and run the application in your own environment.

## Prerequisites

Before you begin, make sure you have the following software installed on your system:

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Usage

### Docker Compose (Option 1)

1. Clone this repository to your local machine:

   ```bash
   <!-- git clone https://github.com/your-username/folktales-web-app.git -->
   git clone https://github.com/Chukwuemekamusic/folklore.git
   ```

2. Navigate to the project directory
    ```bash
    cd folklore
    ```
    
3. Modify the docker-compose.yml file to specify the desired configuration:
    - Customize environment variables, ports, and other settings as needed.

4. Build and start the Docker containers with Docker Compose:
    ```bash
    docker-compose up -d
    ```

5. to stop and remove the containers:
   ```bash
   docker-compose down
   ``` 

#### Database and Env Configuration
- Database: The MySQL database is provided as a Docker container and configured in the docker-compose.yml file. You can customize database settings in the db service section.

- Web Application: The web application is provided as a Docker container and configured in the docker-compose.yml file. You can customize environment variables and ports in the web service section.

### Manual Configuration (Option 2)

1. Clone this repository to your local machine:

   ```bash
   git clone https://github.com/Chukwuemekamusic/folklore.git
   ```

2. Navigate to the project directory
    ```bash
    cd folklore
    ```

3. Update the connection.php file to specify the correct database settings.

4. Load the required tables into your database by either:

    - Running the create_table.php script, which creates all the tables, including the admin user.
    - Using individual table MySQL scripts provided in the create_sql.adoc file located in the sql_scripts folder.
5. Populate the continents and legends tables by using the MySQL populate scripts in the populate.adoc file located inside the sql_scripts folder.

6. To load procedures, refer to the procedures section in the populate.adoc file.

7. Access the application in your web browser.

#### Database and Env Configuration
- Database: The MySQL database is manually configured in the connection.php file. Update the settings to match your database.


## Front-End Frameworks

The Storytelling Web App uses Bootstrap and jQuery, which are included in the assets folder of the application.

## Additional Libraries

The Storytelling Web App uses the RateYo library, which is included in the assets folder of the application.
