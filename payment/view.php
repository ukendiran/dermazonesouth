<?php
 echo '<div class="col-md-4">
 <div class="card">
 <div class="card-body">
 <table cellpadding="5" cellspacing="5" style=" width: 100%; text-align: left; font-size: 18px;">
 <tr>
     <th>IADVL Number :</th>
     <td>' . $membership_no . '</td>
 </tr>
 <tr>
     <th>Name:</th>
     <td>' . $name . '</td>
 </tr>
 <tr>
     <th>Order Id:</th>
     <td>' . $order_id . '</td>
 </tr>
 <tr>
     <th>Tracking Id:</th>
     <td>' . $tracking_id . '</td>
 </tr>
 <tr>
     <th>Bank Referance No:</th>
     <td>' . $bank_ref_no . '</td>
 </tr>
 <tr>
     <th>Status:</th>
     <td>' . $order_status . '</td>
 </tr>
 <tr>
     <th>Payment Mode:</th>
     <td>' . $payment_mode . '</td>
 </tr>
 <tr>
     <th>Amount Paid:</th>
     <td>' . $amount . '</td>
 </tr>


</table>
</div></div></div>
 ';
