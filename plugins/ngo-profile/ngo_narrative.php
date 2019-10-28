<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!-- include summernote css/js -->

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>

<div class="page-header">
        <h1>Project Narative <span class="pull-right label label-default">:)</span></h1>
    </div>
    <div class="row">
    	<div class="col-md-12">
        <nav class="navbar navbar">
 <div class="container-fluid">

   <ul class="nav navbar-nav">
     <li class="active"><a href="#" class="btn btn-primary">Project Narative List</a></li>

   </ul>

 </div>
</nav>

              <!-- ajcode for dataTables -->
        <table id="exampleNarative" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>S#</th>
                <th>Date</th>
                <th>Project</th>
                <th>Details</th>
                <th>Attachment</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          <?php
            global $wpdb;
              $usid = get_current_user_id();

          $table_name = "wp_ngo_narative";
          $result = $wpdb->get_results( " SELECT * FROM $table_name ");
          $i=0;
          foreach( $result as $printRow ){
            $i++;
            $flink=wp_get_attachment_link( $printRow->project_attchment, $unfiltered );


            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><?php echo $printRow->created_at?></td>
                <td><?php echo $printRow->project_name?></td>
                <td><?php echo $printRow->project_detail?></td>
                <td><?php echo $flink?></td>
                <td></td>
            </tr>
            <?php

          }

          ?>


        </tbody>

    </table>

              <!-- ajcode for dataTables -->
        </div>

	</div>




  <script type="text/javascript">

  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#exampleNarative thead tr').clone(true).appendTo( '#exampleNarative thead' );
    $('#exampleNarative thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );

        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    var table = $('#example').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );




  $('#exampleNarative').DataTable();

   $('#summernote').summernote({
        placeholder: 'Enter Project Details',
        tabsize: 2,
        height: 100,
        codemirror: { // codemirror options
      theme: 'monokai'
    }


      });


} );

  </script>
