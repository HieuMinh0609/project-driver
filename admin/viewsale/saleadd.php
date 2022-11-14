 <?php include '../includes/FooterHeader/header.php'; ?>



<div class="container-fluid">
        <div class="row">
             
            <div class="link_header">
                <i class="glyphicon glyphicon-hand-right"></i>
                <a href="../viewhome/HomePage.php">Home</a>
                <span>/</span>
                <a href="salelist.php">Sale</a>
                <span>/</span>
                <span>Add</span>
            </div>
        
        </div>
    </div>
    <br><br>
<div class="container">
<?php 
    require("../../lib/controls.php");
    require_once("../../lib/db.php");
    require("../../lib/SaleService.php");



if(isset($_POST['saveSale'])){
   
    $conn = db_connect();
        createSale($conn, 
            escapePostParam($conn, "idproduct"), 
            escapePostParam($conn,"percent"));    
        db_close($conn);
}




?>
</div>

<div class="container" style="width: 700px">
 
    <div id="form_register" class="col-md-12 col-sm-12 col-12">
        <form method="POST" class="form-sigin">
            <div class="loginname">
                <input required class="input_name " type="text" id="idproduct"  name="idproduct"  placeholder="ID product" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-tag"></i>
				</span>

            </div>

            <div id="showinformation" class="loginname">
                  
            </div>

            <div class="loginname">
                <input  required class="input_name" type="number" name="percent"  placeholder="Percent" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
						<i class="glyphicon glyphicon-tag"></i>
						</span>


            </div>
            <div class="loginname">
               

            </div>

 

            <input type="hidden" name="idUser">

        <div id="btnSave" class="buton_save" >
            <button name="saveSale" class="login_btn_form">Save</button>
          
        </div>
          
        </form>
</div>
</div>

<script type="text/javascript">

$(function(){

   
    $('#idproduct').keyup (function() {
        $idpro= $('#idproduct').val();
      

        
         $.ajax({
        url : '../ajax/ajaxLoadSale.php',
        type : 'post',
        dataType : 'json',
        data : {
            id :  $idpro
             
        },
        success : function (result)
        {
        if(result!=null ){
            var row='';
            row+='<img width="70" src="../images/'+result.image+'" alt="man">';
            row+='<span>'+result.name+'</span>';  
             $('#showinformation').html(row);
            }else{
                 var row=''
                 row+='<span style="color:red">Sản phẩm không tồn tại</span>'; 
                 $('#showinformation').html(row);
            }
        },
        error: function (result){
                 var row=''
                 row+='<span style="color:red">Sản phẩm không tồn tại</span>'; 
                 $('#showinformation').html(row);
        }
    });
        
});
 });



</script>

<?php include '../includes/FooterHeader/footer.php'; ?>