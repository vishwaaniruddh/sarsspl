<?php 
     $file = $_GET['fil'];
    // echo $file;
?>
<object classid="clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95" width="680" height="540" codebase="http://www.microsoft.com/Windows/MediaPlayer/">
<param name="Filename" value="<?php echo $file; ?>">
<param name="AutoStart" value="true">
<param name="ShowControls" value="true">
<param name="BufferingTime" value="2">
<param name="ShowStatusBar" value="true">
<param name="AutoSize" value="true">
<param name="InvokeURLs" value="false">
<embed src="<?php echo $file; ?>" type="application/x-mplayer2" autostart="1" enabled="1" showstatusbar="1" showdisplay="1" showcontrols="1" pluginspage="http://www.microsoft.com/Windows/MediaPlayer/" CODEBASE="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,0,0,0" width="680" height="540"></embed>
</object>