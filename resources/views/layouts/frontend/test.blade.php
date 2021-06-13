<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

<table border="1" id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Permissions</th>
                                                <th class="text-center">Updated At</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <tr>
                                                <td class="text-center text-muted">1</td>
                                                <td class="text-center">sf</td>
                                                <td class="text-center">
                                                   
                                                    <span class="badge badge-info">sdf</span>

                                                </td>
                                                <td class="text-center">sdfsdf</td>
                                                <td class="text-center">
                                                    <a href="3" class="btn btn-info btn-sm">
                                                       <i class="fas fa-edit"></i>
                                                       <span>Edit</span>
                                                    </a> 

                                                    <button type="button" class="btn btn-danger btn-sm">
                                                       <i class="fas fa-trash-alt"></i>
                                                       <span>Delete</span>
                                                    </button> 
                                                </td>
                                            </tr>
                                           
                                            
                                        </tbody>
                                    </table>
                                    
                                    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                                    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
                                    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
                                    


<script>
    $(document).ready(function() {
    $('#datatable').DataTable();
} );
</script>
    
</body>
</html>