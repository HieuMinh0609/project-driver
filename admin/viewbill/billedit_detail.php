 <?php include '../includes/FooterHeader/header.php'; ?>
 <div class="container-fluid">
        <div class="row">
             
            <div class="link_header">
                <i class="glyphicon glyphicon-hand-right"></i>
                <a href="../viewhome/HomePage.php">Home</a>
                <span>/</span>
                <a href="billlist.php">Bill</a>
                <span>/</span>
                <span>Bill detail</span>
            </div>
        
        </div>
    </div>
 <div class="container" >
<?php 
    require("../../lib/controls.php");
    require_once("../../lib/db.php");
    require("../../lib/BillService.php");
    require("../../lib/SaleService.php");
    require("../../lib/ProductService.php");
    require("../../lib/Bill_Detail_Service.php");
 
if(isset($_POST['updateDetail'])){
    $conn = db_connect();
        updateDeatailBill($conn, 
            escapePostParam($conn, "id_detailbill"), 
            escapePostParam($conn,"mountProduct"));    
        echo ("<br><div class=\"alert alert-success alert-dismissible fade in\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</button>
        <strong>Success!</strong> update success.
        </div>");
        //$totalWhenUpdate = getTotalSellBill($conn,escapePostParam($conn, "id_bill"));
         
        $listIdProductSale = getAllSale($conn);
        $listDetailBill = getAllDeatailBill($conn,escapePostParam($conn, "id_bill"));
        $details=[];
        $sales=[];
         $idSales=[];
        while($detail = mysqli_fetch_assoc($listDetailBill)){
            $details[]=$detail;
        }

        while($sale = mysqli_fetch_assoc($listIdProductSale)){
             $sales[]=$sale;
        }
        $sumMoney=0;
    if(count($details)>0){
        foreach($details as $detail) { 
          foreach ($sales as $sale ) {
             if($detail["idproduct"] == $sale["idproduct"]){
                    $sumMoney+= ((getSingleProduct($conn,$detail["idproduct"])["sell"]) - ((getSingleProduct($conn,$detail["idproduct"])["sell"]) * ($sale["percent"]/100)))* ($detail["SoLuong"]);
                         
                    $idSales[]=$detail["idproduct"] ;
                }                
          }
        }

        foreach($details as $detail) { 
            $kt=0;
          if(count($idSales)>0){ 
          foreach ($idSales as $idSale ) {
              if($detail["idproduct"] == $idSale){
                     $kt=1;
            }               
          }
        }
          if($kt==0){
            $sumMoney+=  getSingleProduct($conn,$detail["idproduct"])["sell"]* ($detail["SoLuong"]); 
          }
        }
      }
       // echo "Sum:".$sumMoney;
        updateSellBill($conn,escapePostParam($conn, "id_bill"),$sumMoney);

        db_close($conn);
}

if(isset($_POST['deleteDetail'])){
    $conn = db_connect();
        deleteBillDeail($conn, 
            escapePostParam($conn, "id_detailbill"));    
        echo ("<br><div class=\"alert alert-success alert-dismissible fade in\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</button>
        <strong>Delete!</strong> delete success.
        </div>");


        //$totalWhenDelete = getTotalSellBill($conn,escapePostParam($conn, "id_bill"));
         $listIdProductSale = getAllSale($conn);
        $listDetailBill = getAllDeatailBill($conn,escapePostParam($conn, "id_bill"));
        $details=[];
        $sales=[];
         $idSales=[];
        while($detail = mysqli_fetch_assoc($listDetailBill)){
            $details[]=$detail;


        }

        while($sale = mysqli_fetch_assoc($listIdProductSale)){
             $sales[]=$sale;
        }
      $sumMoney=0;
      if(count($details)>0){ 
    
        foreach($details as $detail) { 
          if(count($sales)>0  ){
          foreach ($sales as $sale ) {
             if($detail["idproduct"] == $sale["idproduct"]){
                    $sumMoney+= ((getSingleProduct($conn,$detail["idproduct"])["sell"]) - ((getSingleProduct($conn,$detail["idproduct"])["sell"]) * ($sale["percent"]/100)))* ($detail["SoLuong"]);
                         
                    $idSales[]=$detail["idproduct"] ;
                } 

               
          }
          }
        }
        

        foreach($details as $detail) { 
            $kt=0;
          if(count($idSales)>0){     
          foreach ($idSales as $idSale ) {
              if($detail["idproduct"] == $idSale){
                     $kt=1;
            } 

             }  
          }
        }

          if($kt==0){
            $sumMoney+=  getSingleProduct($conn,$detail["idproduct"])["sell"]* ($detail["SoLuong"]); 
          }

        }
        

        updateSellBill($conn,escapePostParam($conn, "id_bill"),$sumMoney);
        db_close($conn);
}

?>
 
<?php 
if(isset($_POST['exportHD'])){
require("../../lib/ffpdf.php");
$conn = db_connect(); 
if (isset($_GET['id']))   {
        $idPdf = $_GET['id'];
}
$prop = array('HeaderColor'=>array(255,150,100),
            'color1'=>array(210,245,255),
            'color2'=>array(255,255,210),
            'margin'=>4);

ob_end_clean();  

ob_start();  

$pdf = new PDF_HTML();
$pdf->AddPage();
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14);
$pdf->Cell(80);
$pdf->Cell(20,10,'Hóa đơn bán hàng ',4,4,'C');
$link = $pdf->AddLink();
$pdf->SetFont('');
$pdf->SetLink($link);
$pdf->Image('../images/logo.png',10,12,30,0,'','http://www.fpdf.org');
$pdf->SetLeftMargin(45);
$pdf->SetFontSize(14);
$pdf->Table($conn,"Select b.idbill ,b.SoLuong as 'Số Lượng',p.name as 'Tên sản phẩm',(p.sell*b.SoLuong) as 'Tiền' from bill_detail  b   INNER JOIN product p  ON b.idproduct = p.idproduct  
 INNER JOIN bill bi  ON b.idbill = bi.idbill  
where b.idbill='".$idPdf."'",$prop);

$pdf->Table($conn,"Select  b.place as 'Địa chỉ', m.fullname as 'Tên khách hàng',m.phone as 'Điện thoại',b.sell as 'Thành Tiền' from bill b INNER JOIN member m  ON b.idmember = m.idmember where b.idbill='".$idPdf."'",$prop);
$pdf->Output();

ob_end_flush();
db_close($conn);
}
?>


 <div id="form_register" class="col-md-8 col-sm-8 col-8">



<br><br>
  <form id="formUrl"   method="POST" class="form-sigin">

    
            <div class="loginname">
                <input required readonly  style="padding-left: 158px;" class="input_name "  id="id_detailbill" type="text"  name="id_detailbill"  placeholder="ID Detail" value= ""   >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
            <i class="glyphicon glyphicon-tag"></i>
                         <span style="  margin-left: 5px;">ID Detail</span>
            </span>

            </div>
            <div class="loginname">
                <input required readonly style="padding-left: 158px;" class="input_name " id="id_bill" type="text"  name="id_bill"  placeholder="ID Bill" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                        <i class="glyphicon glyphicon-tag"></i>
                         <span style="  margin-left: 5px;">ID Bill</span>
                        </span>

            </div>
            <div class="loginname">
                <input required style="padding-left: 158px;"  class="input_name" id="mountProduct" type="text" name="mountProduct"  placeholder="Count" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
            <i class="glyphicon glyphicon-tag"></i>
                        <span style="  margin-left: 5px;">Count</span>
            </span>


            </div>
              
            <div class="loginname">
                <input required readonly style="padding-left: 158px;" id="nameProduct" class="input_name" type="text" name="nameProduct" placeholder="Name Product" >
                <span class="focus-input100"></span>
                <span class="symbol-input100">
            <i class="glyphicon glyphicon-shopping-cart"></i>
                        <span style="  margin-left: 5px;">Name</span>
            </span>
            </div>

<div class="row">
 <div class="col-md-3 "  style="float: right ;">
    <button name="deleteDetail" type="submit" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</button>
  
    <button name="updateDetail" type="submit" onclick="return confirm('Are you sure you want to update?')" class="btn btn-warning">Update</button>
</div>
</div>


</form>
</div>
<br><br>
  <div class="col-md-4 col-sm-4 col-4">
      <img id="imageProduct" src="../images/picture.jpg" class="img-circle" id="viewImage" width="250px" height="250ox">
                    
</div>
</div>
</div>
<br><br>

 
<?php 
     $conn = db_connect();
     $id = escapeGetParam($conn, "id"); 
 $idDetailBill="";
     $result=getAllDeatailBill($conn,$id);

    printTable($result, 
        ["idbill_detail" => "ID Detail", 
        "idbill" => "iD Bill",
        "SoLuong" => "Số Lượng",
        "name" => "Name",
        "image" => "Anh",],"","idbill_detail","","",null,"btn");

    db_close($conn);
?>




<div class="container">
   <form method="POST">
        <input type="hidden" value="<?=$id ?>">
        <button name="exportHD" class="btn btn-info">Export HD</button>
   </form>
</div>
<script type="text/javascript">
 

   

 $("tr.table_show").click(function() {
    var tableData = $(this).children("td").map(function() {
        return $(this).text();
    }).get();

     reloadForm(tableData);
});

 function reloadForm(data){
    $('#id_detailbill').val(data[0]);
     $('#id_bill').val($.trim(data[1]));
      $('#mountProduct').val($.trim(data[2]));
       $('#nameProduct').val($.trim(data[3]));
       $('#imageProduct').attr('src',"../images/"+$.trim(data[4]));

 }

  
</script>
<?php include '../includes/FooterHeader/footer.php'; ?>