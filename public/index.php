<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <img src="../images/makiling-logo.svg" id="logo">
    <button class="navbarbuttons" onclick="navigateSection('home')">Home</button>
    <button class="navbarbuttons" onclick="navigateSection('create')">Create</button>
    <button class="navbarbuttons" onclick="navigateSection('read')">Read</button>
    <button class="navbarbuttons" onclick="navigateSection('update')">Update</button>
    <button class="navbarbuttons" onclick="navigateSection('delete')">Delete</button>
</nav>

<section id="home" class="homecontent"> 
    <h1 class="splash">Welcome to Student Management System</h1>
    <h2 class="splash">A Project in Integrative Programming Technologies</h2>
</section>

<section id="create" class="content">
    <h1 class="contenttitle">Insert New Student</h1>

    <form action="../includes/insert.php" method="POST">
        <label class="label">Surname</label>
        <input type="text" name="surname" class="field" required><br/>

        <label class="label">Name</label>
        <input type="text" name="name" class="field" required><br/>

        <label class="label">Middle name</label>
        <input type="text" name="middlename" class="field"><br/>

        <label class="label">Address</label>
        <input type="text" name="address" class="field"><br/>

        <label class="label">Mobile Number</label>
        <input type="text" name="contact" class="field"><br/>

        <div id="btncontainer">
            <button type="button" id="clrbtn" class="btns">Clear Fields</button>
            <button type="submit" class="btns">Save</button>
        </div>

        <div id="success-toast" class="toast-hidden">
            Registration Successful!
        </div>
    </form>   
</section>

<section id="read" class="content">
    <h1 class="contenttitle">Student Records</h1>

    <input type="text" id="searchInput" placeholder="Search student..." class="field">

    <table id="studentTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Surname</th>
                <th>Name</th>
                <th>Middle</th>
                <th>Address</th>
                <th>Contact</th>
            </tr>
        </thead>
        <tbody>

        <?php
        require_once __DIR__ . '/../includes/db.php';

        try {
            $stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
            $students = $stmt->fetchAll();

            if ($students) {
                foreach ($students as $row) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['surname']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['middlename']}</td>
                            <td>{$row['address']}</td>
                            <td>{$row['contact_number']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No records found</td></tr>";
            }

        } catch (PDOException $e) {
            echo "<tr><td colspan='6'>Error: {$e->getMessage()}</td></tr>";
        }
        ?>

        </tbody>
    </table>
</section>

<section id="update" class="content">
    <h1 class="contenttitle">Update Student</h1>

    <form action="../includes/update.php" method="POST">

        <label class="label">Enter Student ID</label>
        <input type="number" name="id" class="field" required><br/>

        <label class="label">Surname</label>
        <input type="text" name="surname" class="field"><br/>

        <label class="label">Name</label>
        <input type="text" name="name" class="field"><br/>

        <label class="label">Middle Name</label>
        <input type="text" name="middlename" class="field"><br/>

        <label class="label">Address</label>
        <input type="text" name="address" class="field"><br/>

        <label class="label">Contact</label>
        <input type="text" name="contact" class="field"><br/>

        <button type="submit" class="btns">Update</button>
    </form> 
</section>

<section id="delete" class="content">
    <h1 class="contenttitle">Delete Student</h1>

    <form action="../includes/delete.php" method="POST">

        <label class="label">Enter Student ID</label>
        <input type="number" name="id" class="field" required><br/>

        <button type="submit" class="btns">Delete</button>
    </form>
</section>

<script>
const defaultSection = 'home';
</script>

<script src="script.js"></script>

</body>
</html>