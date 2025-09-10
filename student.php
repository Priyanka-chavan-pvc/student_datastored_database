<?php

include 'Database.php';

interface StudentInterface {
    public function store($data);
    public function read();
    public function edit($id);
    public function update($id, $data);
    public function delete($id);
}
class Student implements StudentInterface {
use DatabaseConnection;


    public function __construct() {
        $this->connect(); 
    }


    public function store($data) {
        return $this->conn->query("INSERT INTO students (fname, lname, pwd, cpwd, gender, email, phone, address) VALUES (
            '{$data['fname']}', '{$data['lname']}', '{$data['pwd']}', '{$data['cpwd']}', 
            '{$data['gender']}', '{$data['email']}', '{$data['phone']}', '{$data['address']}')"
        ) ? "Student registered!" : "Registration failed!";
    }


    public function read() {
        $res = $this->conn->query("SELECT * FROM students");
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }




    public function edit($id) {
        $res = $this->conn->query("SELECT * FROM students WHERE id = $id");
        return $res ? $res->fetch_assoc() : null;
    }



    public function update($id, $data) {
        return $this->conn->query("UPDATE students SET 
            fname='{$data['fname']}', lname='{$data['lname']}', pwd='{$data['pwd']}', cpwd='{$data['cpwd']}', 
            gender='{$data['gender']}', email='{$data['email']}', phone='{$data['phone']}', address='{$data['address']}'
            WHERE id=$id"
        ) ? "Student updated!" : "Update failed!";
    }




    
    public function delete($id) {
        return $this->conn->query("DELETE FROM students WHERE id = $id") ? "Student deleted!" : "Delete failed!";
    }
}
?>
