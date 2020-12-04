<?php
include_once 'config/Database.php';
include_once 'models/Auth.php';
include_once 'models/Disburse.php';

$database = new Database();
$db = $database->connect();

$auth = new Auth($db);
$result = $auth->read();
$auth = (array) $auth;

$username = $auth["username"];
$password = $auth['password'];

$disburse = new Disburse($db);
$result = $disburse->read_disburse();

//Data before update
$disburse = (array) $disburse;
//

$fields = "bank_code=".$disburse["bank_code"]."&account_number=".$disburse["account_number"]."&amount=".$disburse["amount"]."&remark=".$disburse["remark"];

$endpoint = 'https://nextar.flip.id/disburse';

$credentials = base64_encode("$username:$password");

$headers = [];
$headers[] = "Authorization: Basic {$credentials}";
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'Cache-Control: no-cache';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

$result = curl_exec($ch);
if (curl_errno($ch)) {
echo 'Error:' . curl_error($ch);
}
curl_close($ch);

//Get the result and update to database
$result = json_decode($result, true);
$disburse_1 = new Disburse($db);
$result = $disburse_1->update_disburse($result);
$result = $disburse_1->read_disburse();

//Data after update
$disburse_1 = (array) $disburse_1;

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Slightly-big (Before)
      </h1>
    </section>
    <section class="content">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>

                      <th>Bank Code</th>
                      <th>Account Number</th>
                      <th>Amount</th>
                      <th>Remark</th>
                    </tr>
                    <tr>
                      <td><?php echo $disburse["bank_code"] ?></td>
                      <td><?php echo $disburse["account_number"]?></td>
                      <td><?php echo $disburse["amount"] ?></td>
                      <td><?php echo $disburse["remark"] ?></td>
                    </tr>
                  </table>
                  
                </div><!-- /.box-body -->
              </div>
            </div>
    </section>

 <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Slightly-big (After)
      </h1>
    </section>
    <section class="content">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>

                      <th>Bank Code</th>
                      <th>Account Number</th>
                      <th>Amount</th>
                      <th>Remark</th>
                      <th>ID Disburse</th>
                      <th>Status</th>
                      <th>Timestamp</th>
                      <th>Beneficiary Name</th>
                      <th>Receipt</th>
                      <th>Time Served</th>
                      <th>Fee</th>
                    </tr>
                    <tr>
                      <td><?php echo $disburse_1["bank_code"] ?></td>
                      <td><?php echo $disburse_1["account_number"]?></td>
                      <td><?php echo $disburse_1["amount"] ?></td>
                      <td><?php echo $disburse_1["remark"] ?></td>
                      <td><?php echo $disburse_1["id_disburse"] ?></td>
                      <td><?php echo $disburse_1["status"]?></td>
                      <td><?php echo $disburse_1["timestamp"] ?></td>
                      <td><?php echo $disburse_1["beneficiary_name"] ?></td>
                      <td><?php echo $disburse_1["receipt"]?></td>
                      <td><?php echo $disburse_1["time_served"] ?></td>
                      <td><?php echo $disburse_1["fee"] ?></td>
                    </tr>
                  </table>
                  
                </div><!-- /.box-body -->
              </div>
            </div>
    </section>
</div>