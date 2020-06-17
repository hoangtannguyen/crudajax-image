<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{{ asset('') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/css/jquery.dataTables.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/2.9.0/jquery.serializejson.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="content-wrapper">


        <!-- Main content -->
           <section class="content">

                 <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="container-fluid">
                 <div class="row mb-2">
                   <div class="col-sm-6">
                     <h1>CRUD AJAX</h1>
                   </div>
                 </div>
               </div><!-- /.container-fluid -->
             </section>
             <div class="row">
               <div class="col-12">
                 <div class="card">
                   <div class="card-header">

                   </div>
                   <!-- /.card-header -->
                   <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                       <a  class="btn btn-primary" class="nav nav-pills mb-3" onclick="Cu.create()" >CREATE</a>
                    </ul>

                       <table id="fs-table" class="table table-bordered table-hover">
                       <thead>
                       <tr>
                           <th>#</th>
                           <th>Họ</th>
                           <th>Tên</th>
                           <th>Image</th>
                           <th>Action</th>
                      </tr>
                       </thead>
                       <tbody>
                       </tbody>
                       <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Họ</th>
                            <th>Tên</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                     </table>
                   </div>
                   <!-- /.card-body -->
                 </div>
                 <!-- /.card -->
               </div>
               <!-- /.col -->
             </div>
             <!-- /.row -->
           </section>
           <!-- /.content -->
       </div>
       <!-- /.content-wrapper -->

       <div id="fs-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
       data-backdrop="static" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
               <form id="form">
                   @method('put')
                   <div class="modal-header">
                       <h5 class="modal-title text-center" id="fs-modal-title">Create Factor Salary</h5>
                       <button class="btn btn-dark" type="button" aria-label="Close"
                           onclick="confirm()?$('#fs-modal').modal('hide'):''">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body container">
                       <div class="container">
                           <span>Họ </span><br>
                           <input class="form-control col" type="text"  name="first_name" >
                       </div>
                       <div class="container">
                           <span>Tên</span><br>
                           <input class="form-control col" type="text"  name="last_name" >
                       </div>
                       <div class="container">
                        <span>Hình ảnh</span><br>
                        <input class="form-control col" type="file"  name="image" >
                        </div>

                       <div class="modal-footer">
                           <button type="button" id="btn-save" class="btn btn-warning btn-block"
                               onclick="Cu.save(this)">
                               <i class="fa fa-save"></i> Save
                           </button>
                       </div>
                   </div>
               </form>
           </div>
       </div>
   </div>


   <!-- The Modal -->
<div class="modal" id="dx-modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <table>
                <tr>
                    <td>Name Position: </td>
                    <td for="" id="first_name"></td>
                </tr>

                <tr>
                    <td>Job: </td>
                    <td for="" id="last_name"></td>
                </tr>

                <tr>
                    <td>Job: </td>
                    <td for="" ></td>
                </tr>
            </table>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>







</body>
<script>
    var img = "{{ asset('images/') }}";
</script>
<script src="{{ asset('js/customer.js') }}"></script>
</html>
