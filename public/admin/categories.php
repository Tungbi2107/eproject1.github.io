<?php require_once("../../resources/config.php"); ?>
<?php include(TEMPLATE_BACK . DS . "header.php"); ?>

<?php  add_category() ?>


        <div id="page-wrapper">

            <div class="container-fluid">

            

            

<h1 class="page-header">
  Product Categories

</h1>


<div class="col-md-4">
    
    <form action="" method="post">
    
        <div class="form-group">
            <label for="category-title">Title</label>
            <input type="text" class="form-control" name="cat_title">
        </div>

        <div class="form-group">
            
            <input type="submit" class="btn btn-primary" name="add_category" value="Add Category">
        </div>      


    </form>


</div>


<div class="col-md-8">

    <table class="table">
            <thead>

        <tr>
            <th>ID</th>
            <th>Title</th>
        </tr>
            </thead>


    <tbody>
       <?php show_categories_in_admin() ?>
    </tbody>

        </table>

</div>



                













            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include(TEMPLATE_BACK . DS . "footer.php"); ?>