<?php
require 'vendor/autoload.php';
use Aws\Ssm\SsmClient;
$ssm = new Aws\Ssm\SsmClient([
        'region' => 'ap-northeast-1',
        'version' => '2014-11-06'
]);
$result = $ssm->getParametersByPath([
        'Path' => '/Prod/Tokyo/SimpleWeb/', // REQUIRED
]);
$arrParams = $result['Parameters'];
$dbusername ='';
$password = '';
$hostname ='';
$dbname ='';
foreach ($arrParams as $param) {
        if('/Prod/Tokyo/SimpleWeb/DatabaseURL'===$param['Name']){
                $hostname = $param['Value'];
        }
        if('/Prod/Tokyo/SimpleWeb/DatabasePassword'===$param['Name']){
                $password = $param['Value'];
        }
        if('/Prod/Tokyo/SimpleWeb/DatabaseName'===$param['Name']){
                $dbname = $param['Value'];
        }
        if('/Prod/Tokyo/SimpleWeb/DatabaseUser'===$param['Name']){
                $dbusername = $param['Value'];
        }
}

echo "<H1>Hello, you are visting the test page for test.</H1>";
$conn = mysqli_connect($hostname, $dbusername, $password,$dbname,'3306') or die("Unable to connect to MySQL");
if(mysqli_connect_errno()){
    echo "Failed to connect to RDS-mysql " . mysqli_connect_error();
}else{
    echo "Connected to MySQL using username - $dbusername, password - $password, host - $hostname<br>";
}
?>