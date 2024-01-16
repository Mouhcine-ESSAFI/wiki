<?php

class User
{
    public $id;
    public $email;
    public $name;
    private $password;

    public function __construct($name, $email, $password)
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }

    public function login()
    {
        global $db;
        
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email ");
        $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
            $stmt->execute();
            // Fetching the result in an associative array
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result && password_verify($this->password, $result['password'])) {
                $_SESSION["id"] = $result['id'];
                $_SESSION["name"] = $result['name'];
                $_SESSION["role"] = $result['role'];

                $redirect = ($result['role'] == 'admin') ? 'index.php?page=dashboard' : 'index.php?page=home';
                return json_encode(['status' => 'success', 'message' => $redirect]);
            } else {
                return json_encode(['status' => 'error', 'message' => 'Invalid email or password.']);
            }
    }

    public function register()
    {
        global $db;

        try {
            // Check if email already exists
            $stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return json_encode(['status' => 'error', 'message' => 'Email already exists.']);
            }

            // Check total number of users to determine the role
            $stmt = $db->query("SELECT COUNT(*) as total FROM users");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalUsers = $row['total'];

            if ($totalUsers === '0') {
                $role = 'admin';
            } else {
                $role = 'auteur';
            }

            // Hash the password
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

            // Prepare the SQL query for inserting a new user
            $stmt = $db->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
            $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);


            if ($stmt->execute()) {
                return json_encode(['status' => 'success', 'message' => 'Registration successful.']);

            } else {
                return json_encode(['Error: ' . $db->errorInfo()[2]]);
            }
        } catch (PDOException $e) {
            return json_encode(['Error: ' . $e->getMessage()]);
        }
    }

    public function countUsers()
    {
        global $db;
        $query = "SELECT COUNT(*) FROM users";
        $stmt = $db->prepare($query);
        $stmt->execute();

        if (!$stmt) {
            die('Query failed: ' . $db->errorInfo()[2]);
        }

        return intval($stmt->fetchColumn());
    }



}