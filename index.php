<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Details</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="DataTables/datatables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="DataTables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
 
    
    <style>
        button.dt-button.btn-primary{
            background:var(--bs-primary)!important;
            color:white;
        }

        .reqfield{
            color: red;
        }
    </style>
</head>

<body class="">
<nav class="navbar navbar-expand-lg navbar-light bg-dark bg-gradient">
  <div class="container">
    <span style="color:white;">Patient Details</span>
  </div>
</nav>

    <div class="container py-5 h-100">
       
        <div class="row">
            <div class="col-md-12" id="msg"></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-hover table-bordered table-striped" id="authors-tbl">
                    <thead>
                        <tr class="bg-dark text-light bg-gradient bg-opacity-150">
                         
                            <th class="px-1 py-1 text-center">Name</th>
                            <th class="px-1 py-1 text-center">Age</th>
                            <th class="px-1 py-1 text-center">City</th>
                             <th class="px-1 py-1 text-center">State</th>
                            <th class="px-1 py-1 text-center">Country</th>
                            <th class="px-1 py-1 text-center">DOB</th>
                            <th class="px-1 py-1 text-center">Blood Group</th>
                            <th class="px-1 py-1 text-center">Action</th>
                        </tr>
                    </thead>
                  
                </table>
            </div>
        </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="add_modal" data-bs-backdrop="static">
        <div class="modal-dialog">
             <form id="savepatient" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                       
                            <div class="form-group">
                                <label for="name" class="control-label">Full Name<span class="reqfield">*</span></label>
                                <input type="text" class="form-control rounded-0" id="name" name="name" required>
                            </div>
                            
                           
                            
                             <div class="form-group">
                                <label for="country" class="control-label">Country<span class="reqfield">*</span></label>
                                <select  class="form-control rounded-0 country" id="country" name="country" required>
                                </select>
                                
                            </div>

                            <div class="form-group">
                                <label for="state" class="control-label">State<span class="reqfield">*</span></label>
                                 <select  class="form-control rounded-0 state" id="state" name="state"  required>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="city" class="control-label">City<span class="reqfield">*</span></label>
                                <select  class="form-control rounded-0 city" id="city" name="city"  required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dob" class="control-label">Date of Birth<span class="reqfield">*</span></label>
                                <input type="date" class="form-control rounded-0" id="dob" name="dob" value="" min="1980-01-01" max="<?php echo date('Y-m-d');?>" required>
                            </div>

                            <div class="form-group">
                                <label for="age" class="control-label">Age(In Year)</label>
                                <input type="number" min="1" max="120"  pattern="[0-9]+" class="form-control rounded-0" id="age" name="age" readonly >
                            </div>
                             <div class="form-group">
                                <label for="bloodgroup" class="control-label">Blood Group<span class="reqfield">*</span></label>
                                <select name="bloodgroup" class="form-control rounded-0" required>
                                  <option value="" >Select</option>
                                   <option value="A+">A+</option>
                                   <option value="A-">A-</option>
                                   <option value="B+">B+</option>
                                   <option value="B-">B-</option>
                                   <option value="O+">O+</option>
                                   <option value="O-">O-</option>
                                   <option value="AB+">AB+</option>
                                   <option value="AB-">AB-</option>
                               </select>
                            </div>
                       
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  name="savepatientdata" value="add">
                    <input type="submit" class="btn btn-primary" form="savepatient" id="addpatient"  name="addpatient" value="save">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
             </form>
        </div>
    </div>
    <!-- /Add Modal -->
    <!-- Edit Modal -->
    <div class="modal fade" id="edit_modal" data-bs-backdrop="static">
        <div class="modal-dialog">
             <form action="" id="editpatient">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Patient Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                       
                            <input type="hidden" name="id" >
                           <div class="form-group">
                                <label for="nameu" class="control-label">Full Name<span class="reqfield">*</span></label>
                                <input type="text" class="form-control rounded-0" id="nameu" name="name" required>
                            </div>
                            
                           
                            
                             <div class="form-group">
                                <label for="countryu" class="control-label">Country<span class="reqfield">*</span></label>
                                <select  class="form-control rounded-0 country" id="countryu" name="country"  required>
                                </select>
                                
                            </div>

                            <div class="form-group">
                                <label for="stateu" class="control-label">State<span class="reqfield">*</span></label>
                                 <select  class="form-control rounded-0 state" id="stateu" name="state"  required>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="cityu" class="control-label">City<span class="reqfield">*</span></label>
                                <select  class="form-control rounded-0 city" id="cityu" name="city" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dobu" class="control-label">Date of Birth<span class="reqfield">*</span></label>
                                <input type="date" class="form-control rounded-0" id="dobu" name="dob" value="" class="dobclass"  min="1980-01-01" max="<?php echo date('Y-m-d');?>" required>
                            </div>

                            <div class="form-group">
                                <label for="ageu" class="control-label">Age(In Year)</label>
                                <input type="number" min="1" max="120"  pattern="[0-9]+" class="form-control rounded-0" id="ageu" name="age" readonly >
                            </div>
                             <div class="form-group">
                                <label for="bloodgroupu" class="control-label">Blood Group<span class="reqfield">*</span></label>
                                <select name="bloodgroup" class="form-control rounded-0" required id="bloodgroupu">
                                  <option value="" >Select</option>
                                   <option value="A+">A+</option>
                                   <option value="A-">A-</option>
                                   <option value="B+">B+</option>
                                   <option value="B-">B-</option>
                                   <option value="O+">O+</option>
                                   <option value="O-">O-</option>
                                   <option value="AB+">AB+</option>
                                   <option value="AB-">AB-</option>
                               </select>
                            </div>
                       
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  name="editpatientdata" value="edit">
                     <input type="submit" class="btn btn-primary" form="editpatient" id="updatepatient"  name="editpatient" value="Update">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    <!-- /Edit Modal -->
    <!-- Delete Modal -->
    <div class="modal fade" id="delete_modal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <form action="" id="delete-author-frm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        
                            <input type="hidden" name="id">
                            <p>Are you sure to delete <b><span id="name"></span></b> from the list?</p>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-danger" form="delete-author-frm">Yes</button> -->
                     <input type="submit" class="btn btn-danger" form="delete-author-frm" id="delete-author-frm"  name="delete-author-frm" value="Yes">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
            </form>
        </div>
    </div>
       <script>
    <?php require_once("js/script.js");?>
</script>
    <!-- /Delete Modal -->
</body>

</html>