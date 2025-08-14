<div style="border-radius: 6px; border: 2px solid #ccc; padding: 15px; background: #fff;">
<?php  
include '../connection/connection.php';

$reference = $_GET['reference_no'];

$list_sqlw = "SELECT * FROM ledger_buy WHERE reference_no='$reference'";
$result1 = mysqli_query($connection_s, $list_sqlw); 

while($row = mysqli_fetch_array($result1)) { 
    $reference_num = $row["reference_no"];
    $request_no    = $row["id"];
    $college_dept  = $row["college_dept"];
    $college       = $row["college"];
    $name          = $row["name"];
    $comments      = $row["comments"];
    $designation   = $row["designation"];
    $a_autho       = $row["approving_athority"];
    $a_autho_desig = $row["authority_desig"];
    $a_date        = date("d-m-Y", strtotime($row["approved_date"]));
    $r_date        = date("d-m-Y", strtotime($row["submit_date"]));
}

$list_sql = "SELECT * FROM request_buy WHERE reference_no='$reference'";
$result = mysqli_query($connection_s, $list_sql); 
?>

<div id='printrel'>

    <!-- Header Table -->
    <table class="table table-bordered align-middle ">
        <tr class="bg-dark">
            <th style="width: 20%; text-align: left;">
            Request No: <b><?php echo $request_no;?></b>
            </th>
            <th style="text-align: center;">
                <h2 style="margin: 0;">Central Store</h2>
                <p style="margin: 0; font-size: 14px;">Guru Kashi University</p>
            </th>
            <th style="width: 20%; text-align: right;">
                <!-- <img src='https://barcode.tec-it.com/barcode.ashx?data=<?php echo $reference_num;?>&code=Code11&dpi=96'
                     alt='Barcode' /> -->
            </th>
        </tr>
        <tr >
            <td><strong>College:</strong> <?php echo $college;?></td>
            <td style="text-align: center;"><h3>Purchase Request</h3></td>
            <td><strong>Department:</strong> <?php echo $college_dept;?></td>
        </tr>
    </table>

    <!-- Items Table -->
    <table class="table table-striped table-bordered table-hover align-middle">
        <thead class="table">
            <tr>
                <th style="width: 5%; text-align: center;">Sr No</th>
                <th style="width: 15%; text-align: center;">Category</th>
                <th style="width: 25%; text-align: center;">Article</th>
                <th>Specification</th>
                <th>Comments</th>
                <th style="width: 8%; text-align: center;">Quantity</th>
                <th style="width: 8%; text-align: center;">Issued</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            if(mysqli_num_rows($result) > 0) {  
                $i = 1;
                while($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td class="text-center"><?php echo $row["category_name"];?></td>
                        <td class="text-center"><?php echo $row["item_name"];?></td>
                        <td class="text-center"><?php echo $row["specification"];?></td>
                        <td class="text-center"><?php echo $comments;?></td>
                        <td class="text-center"><?php echo $row["quantity"];?></td>
                        <td class="text-center"><?php echo $row["issued_qty"];?></td>
                    </tr>
                <?php }  
            } else { ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">No records found</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Footer Info -->
    <table class="table table-bordered align-middle">
        <tr>
            <td>
                <strong>Requested By:</strong><br>
                <?php echo $name;?><br>
                <?php echo $designation;?><br>
                <?php echo $college_dept ?: $college; ?><br>
                <?php echo $r_date; ?>
            </td>
            <td>
                <strong>Approved By:</strong><br>
                <?php echo $a_autho;?><br>
                <?php echo $a_autho_desig;?><br>
                Guru Kashi University<br>
                <?php echo $a_date; ?>
            </td>
        </tr>
        <tr class="bg-dark">
            <td colspan="2" class="text-end">
                <button class="btn btn-success" id="printbtn" onclick="printdiv()">Print</button>
            </td>
        </tr>
    </table>

</div>
