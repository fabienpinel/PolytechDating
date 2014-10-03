<?php
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