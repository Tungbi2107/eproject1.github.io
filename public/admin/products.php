<?php require_once("../../resources/config.php"); ?>
<?php include(TEMPLATE_BACK . DS . "header.php"); ?>


        <div id="page-wrapper">

            <div class="container-fluid">

             <div class="row">

<h1 class="page-header">
   All Products

</h1>
<table class="table table-hover">


    <thead>

      <tr>
           <th>ID</th>
           <th>Title</th>
           <th>Image</th>
           <th>Category</th>
           <th>Price</th>
           
      </tr>
    </thead>
    <tbody>

      <?php get_products_in_admin() ?>
      


  </tbody>
</table>











                
                 


             </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include(TEMPLATE_BACK . DS . "footer.php"); ?>






    