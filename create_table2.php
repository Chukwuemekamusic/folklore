<?php 

include_once("./connection.php");

# TODO adjust the story tellers
// continents table
$sql1 = "CREATE TABLE continents (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    population BIGINT UNSIGNED NOT NULL,
    area DECIMAL(10,2) UNSIGNED NOT NULL,
    image_url VARCHAR(255) NOT NULL 
)";

if (mysqli_query($conn, $sql1)) {
    echo "Table continents created successfully";
    
} else {
    echo "Error creating continents table: " . mysqli_error($conn);
}

// regions table
$sql2 = "CREATE TABLE regions (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    continent_id INT(11) NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_regions_continent FOREIGN KEY (continent_id) REFERENCES continents(id)

)";

if (mysqli_query($conn, $sql2)) {
    echo "Table regions created successfully";
    
} else {
    echo "Error creating regions table: " . mysqli_error($conn);
}

// legends table
$sql3 = "CREATE TABLE legends (
    id INT(11)  AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT
    
)";

if (mysqli_query($conn, $sql3)) {
    echo "Table legends created successfully ";
    
} else {
    echo "Error creating legnds table: " . mysqli_error($conn);
}

// legend_region table
$sql4 = "CREATE TABLE legend_region (
    legend_id INT(11) NOT NULL,
    region_id INT(11) NOT NULL,
    PRIMARY KEY (legend_id, region_id),
    FOREIGN KEY (legend_id) REFERENCES legends(id) ON DELETE CASCADE,
    FOREIGN KEY (region_id) REFERENCES regions(id) ON DELETE CASCADE

)";

if (mysqli_query($conn, $sql4)) {
    echo "Table legend_region created successfully";
    
} else {
    echo "Error creating legend_region table: " . mysqli_error($conn);
}

$sql5 = "CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    email VARCHAR(40) NOT NULL,
    password VARCHAR(20) NOT NULL,
    is_writer BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql4)) {
    echo "Table storytellers created successfully";
    
} else {
    echo "Error creating storytellers table: " . mysqli_error($conn);
}

// stories table 
$sql6 = "CREATE TABLE stories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    content TEXT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    continent_id INT NOT NULL,
    region_id INT,
    author_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT NOW(),
    updated_at TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
    CONSTRAINT fk_region
        FOREIGN KEY (region_id) REFERENCES regions(id)
        ON DELETE RESTRICT,
    CONSTRAINT fk_author
        FOREIGN KEY (author_id) REFERENCES users(id)
        ON DELETE RESTRICT,
    CONSTRAINT fk_continent
        FOREIGN KEY (continent_id) REFERENCES continents(id)
        ON DELETE RESTRICT
)";

if (mysqli_query($conn, $sql6)) {
    echo "Table stories created successfully";
    
} else {
    echo "Error creating stories table: " . mysqli_error($conn);
}


mysqli_close($conn);
?>


