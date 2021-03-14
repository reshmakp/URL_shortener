<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'shorten_db';
$base_url='http://localhost/url/'; 
if(isset($_GET['url']) && $_GET['url']!="")
{ 
$url=urldecode($_GET['url']);
if (filter_var($url, FILTER_VALIDATE_URL)) 
{
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
} 
$slug=GetShortUrl($url);
$conn->close();
echo $base_url.$slug;
} 
else 
{
die("$url is not a valid URL");
}
}
else
{	?>
<html>
<style>
#urlinput {
  width: 50%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}
#btnsubmit{
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  
}
</style>
<center>
<h1>Put Your Url Here</h1>
<form>
<p><input style="width:500px" type="url" name="url" id="urlinput" required /></p>
<p><input type="submit" value="Submit" id="btnsubmit"/></p>
</form>
</center>
</html>
<?php
} 

function GetShortUrl($url){
global $conn;
$query = "SELECT * FROM url_shorten WHERE url = '".$url."' "; 
$result = $conn->query($query);
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
return $row['short_code'];
} else {
$short_code = generateUniqueID();
$sql = "INSERT INTO url_shorten (url, short_code, hits)
VALUES ('".$url."', '".$short_code."', '0')";
if ($conn->query($sql) === TRUE) {
return $short_code;
} else { 
die("Unknown Error Occured");
}
}
}

function generateUniqueID(){
global $conn; 
$token = substr(md5(uniqid(rand(), true)),0,6); $query = "SELECT * FROM url_shorten WHERE short_code = '".$token."' ";
$result = $conn->query($query); 
if ($result->num_rows > 0) {
generateUniqueID();
} else {
return $token;
 }
}
if(isset($_GET['redirect']) && $_GET['redirect']!="") { 
$slug=urldecode($_GET['redirect']);
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$url= GetRedirectUrl($slug);
$conn->close();
header("location:".$url);
exit;
}
function GetRedirectUrl($slug){
global $conn;
$query = "SELECT * FROM url_shorten WHERE short_code = '".addslashes($slug)."' "; 
$result = $conn->query($query);
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$hits=$row['hits']+1;
$sql = "update url_shorten set hits='".$hits."' where id='".$row['id']."' ";
$conn->query($sql);
return $row['url'];
}
else 
 { 
die("Invalid Link!");
}
}

