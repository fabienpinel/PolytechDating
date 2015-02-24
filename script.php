<?php
/**
 * \file      script.php
 * \author    Fabien Pinel
 * \version   1.0
 * \date      24 Février 2015
 * \brief     Page de test
 * \details   
 */

$dirname = '_/cv/'; 
$dir = opendir($dirname); 
chmod($dirname, 0755);
while($file = readdir($dir)) {
	if($file != '.' && $file != '..' && !is_dir($dirname.$file)) {
							//unlink($dirname.$file);
		chmod($dirname.$file,0644);
	} 
} 
closedir($dir); 
				//rmdir('_/cv/');
?>
<?php echo exec('whoami'); ?>