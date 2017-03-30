<?php 


//SIMPLE API FOR RESELLER ACTIVE 
//@AUTHOR MUTAHIR SHAH
// EMAIL mutahir@pkteam.com
//COMPANY AKHTAR'S IT SOLUTIONS.


function getOrders($key = '', $site = '',$orderStatus = 'Pending')
{
//$credentials = "username:Password"; 
  $queryString = '';
  if($site !='') $queryString .= '&req.site='.$site;
  if($orderStatus!='') $queryString.='&req.orderStatus='.$orderStatus;
 $headers = array( 
            "POST HTTP/1.0", 
            "Content-type: application/json;charset=utf-8", 
            "Accept: application/json", 
            "Cache-Control: no-cache", 
            "Pragma: no-cache",    
            "Authorization: Basic 6669:".$key);
 $url = 'http://rest.selleractive.com:80/api/Order?1';
$body = '{}';
//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url.$queryString);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
curl_setopt($ch, CURLOPT_POST,1);
//curl_setopt($ch, CURLOPT_USERPWD, $credentials);
curl_setopt($ch, CURLOPT_TIMEOUT, 160);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
// Execute
$result=curl_exec($ch);
// Closing
echo '<pre>';
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code 
    if (curl_errno($ch)) { 
            print "Error: " . curl_error($ch); 
        } 
        elseif ($status_code != 200) { 
            // Show me the result 
           // Will dump a beauty json :3

          
        }  else
        {
          print_r(json_decode($result,true));
        }
          curl_close($ch); 

}// end function 


// SIMPLELE CALLING API FOR PUSHING YOUR ORDERS.

getOrders($key = 'your account key here.', $site = 'Manual',$orderStatus = 'Pending');


?>