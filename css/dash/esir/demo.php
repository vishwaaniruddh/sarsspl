<? session_start();
include('config.php');

$sql = mysqli_query($con, "SELECT * FROM mis_newsite");
while($sqlResult = mysqli_fetch_assoc($sql)) {
    
    $id = $sqlResult['id'];
    $atmid = $sqlResult['atmid'];
    $ip = ''; // Initialize IP variable

    // Check if ATMID is found in the 'sites' table, get DVRIP
    $siteResult = mysqli_query($con, "SELECT DVRIP FROM sites WHERE ATMID = '$atmid'");
    if($siteData = mysqli_fetch_assoc($siteResult)) {
        $ip = $siteData['DVRIP'];
    }
    
    // If not found in 'sites', check 'dvronline' table for IPAddress
    if(empty($ip)) {
        $dvrOnlineResult = mysqli_query($con, "SELECT IPAddress FROM dvronline WHERE ATMID = '$atmid'");
        if($dvrOnlineData = mysqli_fetch_assoc($dvrOnlineResult)) {
            $ip = $dvrOnlineData['IPAddress'];
        }
    }
    
    // If not found in 'dvronline', check 'dvrsite' table for DVRIP
    if(empty($ip)) {
        $dvrSiteResult = mysqli_query($con, "SELECT DVRIP FROM dvrsite WHERE ATMID = '$atmid'");
        if($dvrSiteData = mysqli_fetch_assoc($dvrSiteResult)) {
            $ip = $dvrSiteData['DVRIP'];
        }
    }

    // If IP is found, update the 'ip' column in 'mis_newsite'
    if(!empty($ip)) {
        mysqli_query($con, "UPDATE mis_newsite SET ip = '$ip' WHERE atmid = '$atmid'");
    }
}


