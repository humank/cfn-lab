<?php
require 'vendor/autoload.php';
use Aws\Ssm\SsmClient;
use Aws\Ec2\Ec2Client;
$ssm = new Aws\Ssm\SsmClient([
        'region' => 'ap-northeast-1',
        'version' => '2014-11-06'
]);
$result = $ssm->getParametersByPath([
        'Path' => '/Lab/SimpleWeb/', // REQUIRED
]);
$arrParams = $result['Parameters'];
$dbusername ='';
$password = '';
$hostname ='';
$dbname ='';
$serverip = $_SERVER['SERVER_ADDR'];
foreach ($arrParams as $param) {
        if('/Lab/SimpleWeb/DatabaseURL'===$param['Name']){
                $hostname = $param['Value'];
        }
        if('/Lab/SimpleWeb/DatabasePassword'===$param['Name']){
                $password = $param['Value'];
        }
        if('/Lab/SimpleWeb/DatabaseName'===$param['Name']){
                $dbname = $param['Value'];
        }
        if('/Lab/SimpleWeb/DatabaseUsername'===$param['Name']){
                $dbusername = $param['Value'];
        }
}

echo "<H1>Hello, you are visting the test page ! </H1>";
echo "<H2> $serverip </H2>"; 
$conn = mysqli_connect($hostname, $dbusername, $password,$dbname,'3306') or die("Unable to connect to MySQL");
if(mysqli_connect_errno()){
    echo "Failed to connect to Aurora Cluster " . mysqli_connect_error();
}else{
    echo "Connected to Aurora using username - $dbusername, password - $password, host - $hostname<br>";
}
?>