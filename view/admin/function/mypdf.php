<?php 
require_once('../../config/connect.php');
require_once __DIR__ . '/vendor/autoload.php';
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'fontdata' => $fontData + [ // lowercase letters only in font key
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf'
        ]
    ],
    'default_font' => 'sarabun'
]);

    $outp = '';
    $id = $_GET['id'];
    $contact = $conn->query("SELECT * FROM tb_contact");
    $row_contact = $contact->fetch_array();
    $sql = "SELECT * FROM tb_delivery WHERE Delivery_ID = '$id'";
    $query = $conn->query($sql);
    $order = $conn->query("SELECT * FROM tb_order WHERE Delivery_ID = '$id'");
    $row = $query->fetch_array();
    $outp .= '<style>
    table{
        width:100%;
    }
        .item{
            text-align:center;
            width:calc(100% / 2);
        }
        h3{
            text-align:center;
        }
    </style>';
    $outp .= '
    <h3>ใบคำสั่งซื้อ</h3>
    <b>ชื่อร้าน : </b><span>'.$row_contact['shop_name'].'</span><br>
    <b>ที่อยู่ : </b><span>'.$row_contact['address'].' '.$row_contact['phone'].'</span>
    <table>
    <tr class="box-item">
    <td class="item">
        <b>หมายเลขคำสั่งซื้อ</b>
        <p>'.$row['track'].'</p>
    </td>
    <td class="item">
        <b>วันที่สั้งซื้อ</b>
        <p>'.$row['by_date'].'</p>
    </td>
    </tr>
    </table>
    <table width="100%" style="margin-top:10px;">
        <tr style="background: #d0d1be; ">
          <th></th>สินค้า</th>
          <th>ราคา</th>
          <th>จำนวน</th>
          <th>รวม</th>
        </tr>
    ';
    foreach($order as $data){
        $delivery += $data['freight'];
        $tatol += $data['price']*$data['qty'] + $delivery;
        $outp .= "<tr >
        <td style='text-align:center;'>".$data['product']."</td>
        <td style='text-align:center;'>".number_format($data['price'])."</td>
        <td style='text-align:center;'>".$data['qty']."</td>
        <td style='text-align:center;'>".number_format($data['price']*$data['qty'])."</td>
      </tr>";
    }
    $outp .= '<tr><td colspan="4" style="text-align:center;">ค่าสัดส่ง '.number_format($delivery).' บาท</td></tr>';
    $outp .= '<tr><td colspan="4" style="text-align:center;">ราคารวม '.number_format($tatol).' บาท</td></tr>';
    $outp .= '</table>';
    $outp .= '<hr><table id="table-user">
    <tr>
    <td>ชื่อผู้รับ</td>
    <td>'.$row['name'].'</td>
    </tr>
    <tr>
    <td>ที่อยู่ผู้รับ</td>
    <td>'.$row['address'].'</td>
    </tr>
    <tr>
    <td>เบอร์โทร</td>
    <td>'.$row['tel'].'</td>
    </tr>
    <tr>
    <td>อีเมลล์</td>
    <td>'.$row['email'].'</td>
    </tr>
    </table>';
    
    // echo $outp;
    // ob_start();
    $mpdf->WriteHTML($outp);
    $mpdf->Output();
    // ob_end_flush();
?>