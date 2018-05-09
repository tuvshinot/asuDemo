

<?php // HTTP Headers for ZIP File Downloads
// https://perishablepress.com/press/2010/11/17/http-headers-file-downloads/

if(isset($_GET['fileName'])) {
        $fileName = $_GET['fileName'];
    } else {
        header("Location : course.php");
    }

// set example variables
$filename = $fileName . ".zip";

if(isset($_GET['id'])) {
	$id = $_GET['id'];

	if($id == 1) {
		$filepath = "material/subjects/";
	}

	if($id == 2 ) {
		$filepath = "material/diploma/";
	}

	if($id == 3) {
		$filepath = "material/others/";
	}
}


// http headers for zip downloads
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"".$filename."\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($filepath.$filename));
ob_end_flush();
@readfile($filepath.$filename);
?>