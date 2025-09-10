<?php
include 'Student.php';

$student = new Student();
$message = '';
$editData = null;

if (isset($_POST['register'])) {
    $message = $student->store($_POST);
}

if (isset($_POST['update'])) {
    $message = $student->update($_POST['id'], $_POST);
}

if (isset($_GET['delete'])) {
    $message = $student->delete($_GET['delete']);
}

if (isset($_GET['edit'])) {
    $editData = $student->edit($_GET['edit']);
}
?>

<!DOCTYPE html>

<html>
<head>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

    <title>STUDENT RECORD</title>
    <style>
        body { font-family: Arial; width: 800px; margin: auto; }
        input, select, textarea { width: 100%; padding: 8px; margin: 5px 0; }
        button { padding: 10px; background: green; color: white; border: none; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #8d1111ff; text-align: center; }
        
        .edit-button {
            background-color: green;
        }

        .delete-button {
            background-color: red;
        }
        
a.btn {
    padding: 8px 14px;
    color: white;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    font-size: 14px;
    margin-right: 8px;
    transition: background 0.3s ease;
}


a.btn.edit {
    background-color: #4CAF50;
}

a.btn.edit:hover {
    background-color: #45a049;
}


a.btn.delete {
    background-color: #f44336;
}

a.btn.delete:hover {
    background-color: #d32f2f;
}

    </style>
</head>
<body>

<h2>Student Form</h2>
<form method="POST">
    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

    <label>First Name</label>
    <input type="text" name="fname" required value="<?= $editData['fname'] ?? '' ?>">

    <label>Last Name</label>
    <input type="text" name="lname" required value="<?= $editData['lname'] ?? '' ?>">

    <label>Password</label>
    <input type="text" name="pwd" <?= $editData ? '' : 'required' ?> value="<?= $editData['pwd'] ?? '' ?>">

    <label>Confirm Password</label>
    <input type="text" name="cpwd" <?= $editData ? '' : 'required' ?> value="<?= $editData['cpwd'] ?? '' ?>">

    <label>Gender</label>
    <select name="gender" required>
        <option value="">Select</option>
        <option value="male" <?= ($editData['gender'] ?? '') === 'male' ? 'selected' : '' ?>>Male</option>
        <option value="female" <?= ($editData['gender'] ?? '') === 'female' ? 'selected' : '' ?>>Female</option>
    </select>

    <label>Email</label>
    <input type="email" name="email" required value="<?= $editData['email'] ?? '' ?>">

    <label>Phone</label>
    <input type="text" name="phone" required value="<?= $editData['phone'] ?? '' ?>">

    <label>Address</label>
    <textarea name="address"><?= $editData['address'] ?? '' ?></textarea>

    <button type="submit" name="<?= $editData ? 'update' : 'register' ?>">
        <?= $editData ? 'Update' : 'Register' ?>
    </button>
</form>

<?php if ($message): ?>
    <p style="color:green;"><?= $message ?></p>
<?php endif; ?>

<h3>All Students</h3>
<table>
    <tr>
        <th>ID</th><th>FName</th><th>LName</th><th>Gender</th><th>Email</th><th>Phone</th><th>Address</th><th>Actions</th>
    </tr>
    <?php foreach ($student->read() as $row): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['fname'] ?></td>
        <td><?= $row['lname'] ?></td>
        <td><?= $row['gender'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['phone'] ?></td>
        <td><?= $row['address'] ?></td>
      <td>
    <div class="d-flex gap-2">
        <a href="?edit=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
        <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this student?')">Delete</a>
    </div>
</td>

    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
