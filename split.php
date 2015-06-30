<?php
    $filename = "32GB.IMG";
    //Change to filename
    
    $offsetsize = 1140224;		
    //Find with hex editor
    
    $recordsize = 196608;		
    // 6 clusters left and 6 cluster right
    // Byste per cluster: 32768
    //So 6x32768=196608
    //So split every 196608 bytes
    
    $handle = fopen ($filename, "r"); 
    $leftfile = fopen("channel1.wav", "w");
    $rightfile = fopen("channel2.wav", "w");
    
    //here i read wav headers 
    $headers = fread ($handle, $offsetsize); 
    
    $leftsound = true;
    while (!feof($handle)) {
        $bps = fread($handle, $recordsize);
        
        if($leftsound){
            fwrite($leftfile, $bps);
        }else{
            fwrite($rightfile, $bps);
        }
        $leftsound = !$leftsound;
    }
    fclose ($handle);
    
    var_dump($leftfile,$rightfile);
    
    //write left file
    fclose($leftfile);
    fclose($rightfile);
?>
