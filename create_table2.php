<?php 

include_once("./connection.php");

# TODO adjust the story tellers
// continents table
$sql1 = "CREATE TABLE continents (
    continent_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(255) DEFAULT NULL 
)";

if (mysqli_query($conn, $sql1)) {
    echo "Table continents created successfully";
    
} else {
    echo "Error creating continents table: " . mysqli_error($conn);
}
echo "<br>";

// regions table
$sql2 = "CREATE TABLE regions (
    region_id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    continent_id INT(11) NOT NULL,
    PRIMARY KEY (region_id),
    CONSTRAINT fk_regions_continents FOREIGN KEY (continent_id) REFERENCES continents(continent_id)

)";

if (mysqli_query($conn, $sql2)) {
    echo "Table regions created successfully";
    
} else {
    echo "Error creating regions table: " . mysqli_error($conn);
}
echo "<br>";

// legends table
$sql3 = "CREATE TABLE legends (
    legend_id INT(11)  AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT
)";

if (mysqli_query($conn, $sql3)) {
    echo "Table legends created successfully ";
    
} else {
    echo "Error creating legends table: " . mysqli_error($conn);
}
echo "<br>";

// legend_region table
$sql4 = "CREATE TABLE legend_region (
    legend_id INT(11) NOT NULL,
    region_id INT(11) NOT NULL,
    PRIMARY KEY (legend_id, region_id),
    FOREIGN KEY (legend_id) REFERENCES legends(legend_id) ON DELETE CASCADE,
    FOREIGN KEY (region_id) REFERENCES regions(region_id) ON DELETE CASCADE #TODO change regions(id) to regions(region_id)

)";

if (mysqli_query($conn, $sql4)) {
    echo "Table legend_region created successfully";
    
} else {
    echo "Error creating legend_region table: " . mysqli_error($conn);
}
echo "<br>";

$sql5 = "CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    email VARCHAR(40) NOT NULL,
    password VARCHAR(20) NOT NULL,
    is_writer BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    country VARCHAR(40),
    gender ENUM('Male','Female','Other'),
    dob DATE
)";

if (mysqli_query($conn, $sql5)) {
    echo "Table users created successfully";
    echo "<br>";
    
} else {
    echo "Error creating storytellers table: " . mysqli_error($conn);
    echo "<br>";
}

// stories table 
$sql6 = "CREATE TABLE stories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    content TEXT NOT NULL,
    image_url VARCHAR(255) DEFAULT NULL,
    continent_id INT NOT NULL,
    legend_id INT DEFAULT NULL,
    author_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT NOW(),
    updated_at TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
    views INT DEFAULT 0,
    CONSTRAINT fk_legend
        FOREIGN KEY (legend_id) REFERENCES legends(legend_id)
        ON DELETE RESTRICT,
    CONSTRAINT fk_author
        FOREIGN KEY (author_id) REFERENCES users(id)
        ON DELETE RESTRICT,
    CONSTRAINT fk_continent
        FOREIGN KEY (continent_id) REFERENCES continents(continent_id)
        ON DELETE RESTRICT
)";

if (mysqli_query($conn, $sql6)) {
    echo "Table stories created successfully";
    
} else {
    echo "Error creating stories table: " . mysqli_error($conn);
}
echo "<br>";

// tags table
$sql7 = "CREATE TABLE tags (
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL, 
    description TEXT
)";

if (mysqli_query($conn, $sql7)) {
    echo "Table tags created successfully";
} else {
    echo "Error creating tags table: " . mysqli_error($conn);
}
echo "<br>";

// story_tag table
$sql8 = "CREATE TABLE story_tag (
    story_id INT(11) NOT NULL,
    tag_id INT(11) NOT NULL,
    PRIMARY KEY (story_id, tag_id),
    FOREIGN KEY (story_id) REFERENCES stories(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(tag_id) ON DELETE CASCADE

)";

if (mysqli_query($conn, $sql8)) {
    echo "Table story_tag created successfully";
    
} else {
    echo "Error creating story_tag table: " . mysqli_error($conn);
}
echo "<br>";


// story_tag table
$sql9 = "CREATE TABLE admin (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql9)) {
    echo "Table story_tag created successfully";
    
} else {
    echo "Error creating story_tag table: " . mysqli_error($conn);
}
echo "<br>";




  

mysqli_close($conn);
?>


