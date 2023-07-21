<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUserById($id = NULL)
    {
        if ($id == NULL)
            $sql = "SELECT * FROM users";
        else
            $sql = "SELECT * FROM users WHERE id = $id";
        $result = $this->db->query($sql);

        $users = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        return $users;
    }
    public function update($updates = array(), $id = NULL)
    {
        $sql = "UPDATE admin SET " . implode(", ", $updates) . " WHERE id = $id";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {

            return false;
        }
    }

    public function getTotalUsersCount()
    {
        $sql = "SELECT COUNT(*) AS total FROM users";
        $result = $this->db->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            return intval($row['total']);
        } else {
            return 0;
        }
    }

    public function getUsers($start, $length)
    {
        $sql = "SELECT * FROM users LIMIT $start, $length";
        $result = $this->db->query($sql);

        $users = array();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        return $users;
    }





    // Add more methods for user management, such as adding, updating, and deleting users
}
