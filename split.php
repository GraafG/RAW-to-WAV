<?php
    $filename = "32GB.IMG";		//Change to filename
    $offsetsize = 1140224;		//
    $recordsize = 196608;		//
    
    /* 
    In my case:
    
    Cluster 29 -15358
    6 Clusters spacing
    
    Byste per cluster: 32768
    Bytes per sector: 512
    First data sector: 449

    Offset start (dec): 1130224
    */
    
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
