<?php 

$filenameArray = array();
$filetimeArray = array();
$folder = '../images/gallery/';

$handle = opendir($folder);
        while($file = readdir($handle)){
            if($file !== '.' && $file !== '..'){
                array_push($filenameArray, "images/gallery/$file");
				array_push($filetimeArray, filemtime($folder . '/' . $file));
				}
        }

array_multisort($filetimeArray, SORT_DESC, $filenameArray);
echo json_encode($filenameArray,JSON_UNESCAPED_SLASHES);
?>
