
<?php
    if (isset($_POST['numberInput'])) {
        $inputNumber = $_POST['numberInput'];


        // Call API
        $headers = array(
            "Accept: application/json",
            "Accept-Language: en-US,en;q=0.5",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:104.0) Gecko/20100101 Firefox/104.0",
            "content-type: application/json",
            "Connection: keep-alive"
        );

        // Initialize curl session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.typicode.com/photos/".$inputNumber);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36');
        
        // Execute curl session
        $response = curl_exec($ch);
        $data = json_decode($response, true);
        var_dump($data["url"]);

        // Close curl session
        curl_close($ch);



        
        // Save data to database
        // Using local server
        
        $servername = "127.0.0.1"; 
        $username = "root";
        $password = "";
        $conn = new mysqli($servername, $username, $password);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "CREATE DATABASE Assignment";
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully with the name Assignment";
        } else {
            echo "Error creating database: " . $conn->error;
        }

        $sql = "USE Assignment";

        if ($conn->query($sql) === TRUE) {
            echo "Using db Assignment";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql = "CREATE TABLE image_data (Num int, image_url varchar(255))";
        
        if ($conn->query($sql) === TRUE) {
            echo "New table created successfully";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql = "INSERT INTO image_data (Num, image_url) VALUES ('$inputNumber', '$data[url]')";
        if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
        $conn->close();
                


        // Save image to local directory
        // There are two ways to save, since I got 403 Forbidden using both these methods, probably 
        // because of them not wanting scraping on their website. It works for any other image link.
        
        // $ch = curl_init("https://upload.wikimedia.org/wikipedia/commons/8/8c/Cristiano_Ronaldo_2018.jpg"); //random image link which works
        $ch = curl_init($data['url']);
        $fp = fopen('img1-' . $inputNumber . '.png', 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36');
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        // $image = file_get_contents("https://upload.wikimedia.org/wikipedia/commons/8/8c/Cristiano_Ronaldo_2018.jpg"); //random image link which works
        $image = file_get_contents($data['url']);
        file_put_contents('img2-' . $inputNumber . '.png', $image);
    }

?>
