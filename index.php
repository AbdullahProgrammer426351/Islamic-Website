<?php
// INSERT INTO `quran` (`q_id`, `q_title`, `q_desc`, `tstamp`) VALUES ('2', 'Go to buy fruits', 'Hey harry, \r\nyou have to buy fruits and return to home. When you will have finished it, delete this note.', current_timestamp());
$insert = false;
$update = false;
$delete = false;
// Connect to the Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "islamic";

// create a connection
$conn = mysqli_connect($servername,$username, $password, $database);

// Die if connection was not successful
if(!$conn){
  die("Sorry we failed to connect: ". mysqli_connect_error());
}
if(isset($_GET['delete'])){
    $q_id = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `quran` WHERE `q_id` = $q_id";
    $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset( $_POST['q_idEdit'])){
    // Update the record
      $q_id = $_POST["q_idEdit"];
      $q_title = $_POST["q_titleEdit"];
      $q_desc = $_POST["q_descEdit"];
  
    // Sql query to be executed
    $sql = "UPDATE `quran` SET `q_title` = '$q_title' , `q_desc` = '$q_desc' WHERE `quran`.`q_id` = $q_id";
    $result = mysqli_query($conn, $sql);
    if($result){
      $update = true;
  }
  else{
      echo "We could not update the record successfully";
  }
  }
  else{
      $title = $_POST["q_title"];
      $description = $_POST["q_desc"];
      $reference = $_POST["q_reference"];
  
    // Sql query to be executed
    $sql = "INSERT INTO `quran` (`q_title`, `q_desc`, `q_reference`) VALUES ('$title', '$description', '$reference')";
    $result_ins = mysqli_query($conn, $sql);
  
     
    if($result_ins){ 
        $insert = true;
    }
    else{
        echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
    } 
  }
  }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Includes for Data Tables (Started)-->
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    
<!-- Includes for Data Tables (End) -->

    <title>Project 1 - PHP CRUD</title>
    
</head>

<body>
  

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-q_title" id="editModalLabel">Edit this Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/Islamic Website/index.php?update=true" method="POST">
          <input type="hidden" name="q_idEdit" id="q_idEdit">
          <div class="mb-3">
              <label for="q_title" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="q_titleEdit" name="q_titleEdit" placeholder="Write Title Here">
          </div>
          <div class="mb-3">
              <label for="q_title" class="form-label">Note Reference</label>
              <input type="text" class="form-control" id="q_referenceEdit" name="q_referenceEdit" placeholder="Write Reference Here">
          </div>
          <div class="mb-3">
              <label for="desc" class="form-label">Note Description</label>
              <div class="form-floating">
                  <textarea class="form-control" placeholder="Write description here" id="q_descEdit"
                      name="q_descEdit"></textarea>
              </div>
          </div>
          <div class="modal-footer">
          <div class="col-12">
              <button type="submit" class="btn btn-primary">Update Note</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
            </div>
  </div>
  </form>
      </div>
      <!-- <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
        <!-- <button type="submit" class="btn btn-primary">Update Note</button> -->
      <!-- </div> --> 
    </div>
  </div>
</div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PHP CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- For showing alert when insertion is successful -->
    <?php
  if($insert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your note has been inserted successfully!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  ?>

<?php
  if($delete){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your note has been deleted successfully!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  ?>

<?php
  if($update){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your note has been updated successfully!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  ?>


    <div class="container my-4">
      <h2>Add Reference</h2>
        <form action="/Islamic Website/index.php" method="POST">
            <div class="mb-3">
                <label for="q_title" class="form-label">Tittle</label>
                <input type="text" class="form-control" id="q_title" name="q_title" placeholder="Write Title Here">
            </div>
            <div class="mb-3">
                <label for="q_title" class="form-label">Reference</label>
                <input type="text" class="form-control" id="q_reference" name="q_reference" placeholder="Mention Reference Here">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Write description here" id="q_desc"
                        name="q_desc"></textarea>
                </div>
            </div>
            <div class="col-12">

            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Add Reference</button>
            </div>
    </div>
    </form>

    <div class="container my-4">



        <table class="table" id="myTable">
            <thead>
                <tr>
                  <th scope="col">Title</th>
                    <th scope="col">Reference</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php 
          $sql = "SELECT * FROM `quran`";
          $result = mysqli_query($conn, $sql);
          $q_id = 0;
          while($row = mysqli_fetch_assoc($result)){
            $q_id = $q_id + 1;

            echo "<tr>
            <th>". $row['q_title'] . "</th>
            <td scope='row'>".$row['q_reference'] . "</td>
            <td>". $row['q_desc'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['q_id'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['q_id'].">Delete</button>  </td>
          </tr>";
        } 
          ?>
            </tbody>
            
        </table>
        <hr>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>
    <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        q_title = tr.getElementsByTagName("th")[0].innerText;
        q_desc = tr.getElementsByTagName("td")[1].innerText;
        q_reference = tr.getElementsByTagName("td")[0].innerText;
        console.log(q_title, q_desc, q_reference);
        q_titleEdit.value = q_title;
        q_descEdit.value = q_desc;
        q_referenceEdit.value = q_reference;
        q_idEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        q_id = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/Islamic Website/index.php?delete=${q_id}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>