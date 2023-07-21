<?php
class Admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAdmin($id = NULL)
    {
        if ($id == NULL)
            $sql = "SELECT * FROM admin";
        else
            $sql = "SELECT * FROM admin WHERE id = $id";
        $result = $this->db->query($sql);
        $admin = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $admin[] = $row;
            }
        }

        return $admin;
    }
    public function updateAdmin($updates = array(), $id = NULL)
    {
        $sql = "UPDATE admin SET " . implode(", ", $updates) . " WHERE id = $id";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
       
            return false;
        }
    }




    // Add more methods for user management, such as adding, updating, and deleting admin
}
