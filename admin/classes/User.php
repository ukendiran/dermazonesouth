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

    public function getUsersByFilter($start, $length, $searchValue)
    {

        $whereClause = "";

        // Apply search filter if searchValue is provided
        if (!empty($searchValue)) {
            $whereClause = "WHERE membership_no LIKE '%$searchValue%'";
            $whereClause .= " OR first_name LIKE '%$searchValue%' OR last_name LIKE '%$searchValue%'";
            $whereClause .= " OR email LIKE '%$searchValue%' OR mobile LIKE '%$searchValue%'";
            $whereClause .= " OR payment_status LIKE '$searchValue' OR payment_status LIKE '$searchValue'";
        }

        $sql = "SELECT * FROM users $whereClause LIMIT $start, $length";
        $result = $this->db->query($sql);

        $users = array();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        return $users;
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


    public function updateUser($updates = array(), $id = NULL)
    {
        $sql = "UPDATE users SET " . implode(", ", $updates) . " WHERE id = $id";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {

            return false;
        }
    }




    // Add more methods for user management, such as adding, updating, and deleting users
}
