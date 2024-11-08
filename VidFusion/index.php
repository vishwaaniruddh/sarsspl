<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Fetch and Play Videos</title>
    <style>
        body {
            background-color: #f9f9f9;
        }
        .video-card {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .video-thumbnail {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            margin: 0.5rem 0;
        }
        .card-body {
            padding: 0.5rem;
        }
        video {
            width: 100%;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Fetch Videos</h3>
        <form action="index.php" method="POST" class="mb-4">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required><br><br>
            <label for="from_time">From Time:</label>
            <input type="time" id="from_time" name="from_time" required><br><br>
            <label for="to_time">To Time:</label>
            <input type="time" id="to_time" name="to_time" required><br><br>
            <button type="submit" class="btn btn-primary">Fetch Videos</button>
        </form>

        <h3 class="text-center mb-4">Videos Found</h3>
        <div class="row">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $directory = 'videos/'; // Update this path
                $date = $_POST['date'] ?? '';
                $fromTime = $_POST['from_time'] ?? '';
                $toTime = $_POST['to_time'] ?? '';

                if ($date && $fromTime && $toTime) {
                    $datePrefix = str_replace('-', '', $date);
                    $fromTimeFormatted = str_pad(str_replace(':', '', $fromTime), 6, '0', STR_PAD_RIGHT);
                    $toTimeFormatted = str_pad(str_replace(':', '', $toTime), 6, '0', STR_PAD_RIGHT);

                    $videos = array_filter(scandir($directory), function($file) use ($datePrefix, $fromTimeFormatted, $toTimeFormatted) {
                        if (preg_match('/(\d{8})_(\d{6})/', $file, $matches)) {
                            $fileDate = $matches[1];
                            $fileTime = $matches[2];
                            return $fileDate == $datePrefix && $fileTime >= $fromTimeFormatted && $fileTime <= $toTimeFormatted;
                        }
                        return false;
                    });

                    if (empty($videos)) {
                        echo "<div class='alert alert-warning text-center'>No videos found for the specified date and time range.</div>";
                    } else {
                        foreach ($videos as $video) {
                            $videoPath = $directory . $video;
                            echo "<div class='col-md-4 mb-4'>";
                            echo "<div class='card video-card'>";
                            echo "<video class='video-thumbnail' controls>
                                    <source src='$videoPath' type='video/mp4'>
                                    Your browser does not support the video tag.
                                  </video>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>$video</h5>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                        echo "<div class='col-12 text-center mt-4'>";
                        echo "<form action='merge_videos.php' method='POST'>";
                        echo "<input type='hidden' name='videos' value='" . implode(',', $videos) . "'>";
                        echo "<button type='submit' class='btn btn-primary'>Merge Videos</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger text-center'>Please select a date and time range.</div>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
