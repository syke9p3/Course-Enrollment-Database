<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Course Enrollment Database</title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>

            body {
                background-color: white;
            }
            
            a{
                cursor: pointer;
                text-decoration: none;
                color: inherit;
            }

            a:hover {
                color: blue;
            }

            nav {
                padding: 0.25rem;
            }

            .btn-link {
                text-decoration: none;
            }

            .btn-link .text-danger:hover {
                color: rgb(244, 0, 0);
            }  

            .search-field {
            
                width: 20rem;
                max-width: 95%;
                /* background-color: #7e7e7e28; */
                /* border-radius: 100px; */
                border: none; 
                padding: 8px 35px 8px 35px;
                align-items: center;
                font-size: 12px;
        }

            .table-container {
                margin-top: 1rem;
                box-shadow: 0 5px 5px rgba(0, 0, 0, 0.15);
                border-radius: 0 0 1rem 1rem;
            }

            .price-col:before {
                content: 'P '; 
            }

            .form-group {
                margin-bottom: 1rem;
            }

            .rd {
                background-color: #6c757d33;
                padding: 0.25rem;
                margin: 0;
                border-radius: 5px;
                
            }
            
        </style>

        <!-- <link rel="stylesheet" href="style.css"> -->

    </head>



    <body class="col-md-12 m-0">
        <!-- <div class="container sidebar w-25 bg-danger m-1">
            <div class="logo"><i>SCALESHEER</i></div>

            <ul>
                <a>
                    <li><i class="fa fa-home"></i>  Home</li>
                </a>
                <a>
                    <li><i class="fa fa-book"></i>  Courses</li>
                </a>
                <a>
                    <li><i class="fa fa-id-badge"></i>  Students</li>
                </a>
                <a>
                    <li><i class="fa fa-pencil"></i>  Teachers</li>
                </a>
                
            </ul>

            <ul id="sign-out">
                <a>
                    <li><i class="fa fa-sign-out"></i> Logout</li>
                </a>
            </ul>
        </div> -->

        <div class="">
            <header>
                <nav class="d-flex space-between align-items-center justify-content-between ps-4 pe-4 bg-primary ">
                    <!-- <div class="logo text-white font-weight-bold" style="font-size:1.5rem"><i>SCALESHEER</i></div> -->
                    <div class="search-group">
                        <form action="">
                            <button class="btn">
                                <i class="fa fa-search" style="color:white"></i>
                            </button>
                            <input type="search" class="search-field" name="search" placeholder="Search"  class="font-size-12">
                            
                        </form>
                    </div>    

                    <div class="profile-group d-flex align-items-center justify-content-between m-2">
                        <a href="" class="d-flex align-items-center justify-content-between">
                            <img width=30 height=auto src="https://i.pinimg.com/736x/46/46/3f/46463f00c0db960a677c04f072238b82.jpg" alt="" class="profile-picture rounded-circle ">
                            <div class="profile-name ms-2" style="font-size: 12px; color:white"><i>Sebastian</i></div>
                        </a>
                        <div class="profile-options ms-3">
                            <i class="fa fa-angle-down text-white"></i>
                        </div>
                    </div>

                </nav>
            </header>

            <main class="">
                <!-- TABLE CONTAINER-->
                <div class="table-container container table-responsive shadow-4 bg-white overflow-hidden p-4">
                    <div class="table-container-title d-flex justify-content-between align-items-center s">
                        <h2 class="p-sm-1">Courses</h2>
                        <button class="btn btn-primary btn-sm p-2 ps-4 pe-4 fw-bold" data-bs-toggle="modal" data-bs-target="#insert-modal"><b>+</b>ADD</button>
                    </div>

                   

                    <table class="table table-fluid mr-0" id="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <?php
                            $conn = mysqli_connect("localhost", "root", "", "salesman");

                            include 'conn.php';

                            $limit = 5;
                            $page = isset($_GET['page'])  ? $_GET['page'] : 1;
                            $start = ($page - 1) * $limit;
                            $sql = "SELECT * FROM salesman LIMIT $start, $limit";
                            $sql_run = $conn->query($sql);
                            $data = $sql_run->fetch_all(MYSQLI_ASSOC);

                            $sql1 = "SELECT count(salesman_number) AS id FROM salesman";
                            $sql_run1 = $conn->query($sql1);

                            $count = $sql_run1->fetch_all(MYSQLI_ASSOC);
                            $total = $count[0]['id'];
                            $pages = ceil($total / $limit); 

                            $previous = $page - 1;
                            $next = $page + 1; 
                            
                            if ($sql_run) {
                            // output data of each row
                                foreach($sql_run as $row) {
                        ?>
                                    <tr>
                                        <td class="">
                                            <p class="fw-bold"><?php echo $row["salesman_number"] ?></p>
                                        </td>
                                        <td class="">
                                            <div class="name-container d-flex flex-column justify-content-between">
                                                <p class="fw-bold"><?php echo $row["salesman_name"]; ?></p>
                                                <p class="text-muted mb-0"><?php echo $row["commission"]; ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="price-col"><?php echo $row["total_sales"]; ?></p>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column align-items-start justify-content-center justify-self-stretch">
                                                <button class="btn btn-link btn-sm p-1 fw-bold editbtn" id="edit-button">EDIT</button>
                                                <!-- data-bs-toggle="modal" data-bs-target="#edit-modal" -->
                                                
                                                <button class="btn btn-link btn-sm p-1 fw-bold text-danger deletebtn" id="delete-button">DELETE</button>
                                            </div>

                                        </td>
                                    </tr>
                                    
                        <?php            
                                }
                                
                            } else { echo "0 results"; }
                            $conn->close();
                        ?>
                    </table>

                    <div class="pt-4">
                        <div class="col-md-12">
                            <nav aria-label="Page navigation" class=" d-flex flex-column">
                                <p>Page <?php echo "$page" ?> of <?php echo "$pages" ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <ul class="pagination align-items-center ">
                                        <li class="page-item">
                                            <a href="index2.php?page=<?=1?>" class="page-link text-white bg-primary">
                                                <span>&laquo;</span>
                                            </a>
                                        </li>
                                        <li class="page-item">
                                            <a href="index2.php?page=<?=$previous?>" class="page-link">
                                                <span>&lt; Previous</span>
                                            </a>
                                        </li>
                                        <?php for($i=1;$i<=$pages;$i++) : ?>
                                        <li class=""><a class="page-link" href="index2.php?page=<?=$i?>"><?= $i ?></a></li>
                                        <?php endfor; ?>
                                        <li class="page-item">
                                            <a href="index2.php?page=<?=$next?>" class="page-link">
                                                <span>Next &gt;</span>
                                            </a>
                                        </li>
                                        <li class="page-item">
                                            <a href="index2.php?page=<?=$pages?>" class="page-link text-white bg-primary">
                                                <span>&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <select class="select" name="" id="">
                                        <option value="none" selected disabled hidden>Rows</option>
                                        <option value="none">Rows</option>

                                    </select>
                                </div>
                                
                            </nav>
                        </div>
                    </div>

                    
                </div>
            </main>
        </div>

        <!-- INSERT MODAL CONTAINER -->
        <div class="modal fade" id="insert-modal" tab-index="-1" aria-labelledby="modal-title-insert" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ">
                        <div class="modal-title d-flex align-items-center justify-content-between w-100">
                            <h5 class="modal-title" id="modal-title-insert"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Entry</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                        </div>
                    </div>
                    <form class="form" action="insertCode.php" method="POST">
                        <div class="modal-body">

                            <input type="hidden" name="update" id="update">

                            <div class="form-group">
                                <label for="id" class="form-label">ID</label>
                                <input type="number" class="form-control" min=0 name="id" placeholder="Course ID" required>
                            </div>

                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Course Name" required>
                            </div>

                            <div class="form-group">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" min=0 class="form-control" name="price" placeholder="Course Price" required>
                            </div>                
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm p-2 ps-4 pe-4 fw-bold" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="insertData" class="btn btn-success btn-sm p-2 ps-4 pe-4 fw-bold">Save Data</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    <!-- DELETE MODAL -->
        <div class="modal fade" id="delete-modal" tab-index="-1" aria-labelledby="modal-title-delete" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <div class="modal-title d-flex align-items-center justify-content-between w-100">
                            <h5 class="modal-title" id="modal-title-delete"><i class="fa fa-trash" aria-hidden="true"></i> Delete Entry</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                        </div>
                    </div>
                    
                    <div class="modal-body d-flex align-items-center">
                        <p>Entry <span class="rd" id="id-del"></span>&nbsp;will be erased.</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm p-2 ps-4 pe-4 fw-bold" data-bs-dismiss="modal">Cancel</button>
                        <form class="form" action="delete.php" method="POST">
                            <input type="hidden" name="del" id="del">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm p-2 ps-4 pe-4 fw-bold">Delete</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>



    <!-- EDIT MODAL  -->
    <div class="modal fade" id="edit-modal" tab-index="-1" aria-labelledby="modal-title-edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ">
                        <div class="modal-title d-flex align-items-center justify-content-between w-100">
                            <h5 class="modal-title" id="modal-title-edit"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Entry</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                        </div>
                    </div>
                    <form class="form" action="editCode.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="id" class="form-label">ID</label>
                            <input type="number" class="form-control" min=0 name="id" id="id" placeholder="Course ID" readonly>
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Course Name" required>
                        </div>

                        <div class="form-group">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" name="price" id="price" placeholder="Course Price" required>
                        </div>

                        
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm p-2 ps-4 pe-4 fw-bold" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="editData" class="btn btn-success btn-sm p-2 ps-4 pe-4 fw-bold">Save Data</button>
                    </div>


                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
        <script>

            $(document).ready(function () {   

                $('button').on('click', function(e) {
                });

               


                $('.editbtn').on('click', function(e) {
                    $('#edit-modal').modal('show');
                    e.preventDefault();

                    $tr = this.closest('tr');

                    $id_val = $tr.getElementsByTagName('td')[0].firstElementChild.innerHTML;
                    $name_val = $tr.getElementsByTagName('td')[1].firstElementChild.firstElementChild.innerHTML;
                    $price_val = $tr.getElementsByTagName('td')[2].firstElementChild.innerHTML;

                    $('#update').val();
                    $('#id').val($id_val);
                    $('#name').val($name_val);
                    $('#price').val($price_val);

                });

                $('.deletebtn').on('click', function(e) {
                    $('#delete-modal').modal('show');
                    e.preventDefault();


                    $tr = this.closest('tr');

                    $id_val = $tr.getElementsByTagName('td')[0].firstElementChild.innerHTML;
                    $name_val = $tr.getElementsByTagName('td')[1].firstElementChild.firstElementChild.innerHTML;
                    $price_val = $tr.getElementsByTagName('td')[2].firstElementChild.innerHTML;

                    $('#del').val($id_val);
                    id_del = document.getElementById('id-del');

                    id_del.innerHTML =  " ID: " + $id_val + " (" + $name_val + ", P" + $price_val + ") ";
                });

                    

            });
           
        </script>

                    

    </body>

</html>



