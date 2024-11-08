<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $videos = isset($_POST['videos']) ? explode(',', $_POST['videos']) : [];

    if (empty($videos)) {
        echo "No videos to merge.";
        exit;
    }

    $videoPaths = [];
    foreach ($videos as $video) {
        $videoPaths[] = "videos/" . trim($video); // Update the path accordingly
    }

    // Create a temporary text file to store the list of videos
    $fileListPath = 'video_list.txt';
    $fileList = fopen($fileListPath, 'w');

    foreach ($videoPaths as $path) {
        fwrite($fileList, "file '$path'\n");
    }
    fclose($fileList);

    // Output merged video path
    $outputVideoPath = 'makes/merged_video.mp4'; // Update the path accordingly

    // Command to merge videos using FFmpeg
    $command = "ffmpeg -f concat -safe 0 -i $fileListPath -c copy $outputVideoPath 2>&1";
    exec($command, $output, $return_var);

    // Check if the merging was successful
    if ($return_var === 0) {
        echo "Videos merged successfully! <br>";
        echo "<video controls><source src='$outputVideoPath' type='video/mp4'>Your browser does not support the video tag.</video>";
    } else {
        echo "Error merging videos: " . implode("<br>", $output);
    }

    // Clean up the temporary file
    unlink($fileListPath);
} else {
    echo "Invalid request.";
}
?>
