<?php
include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Medical Examination Form</title>
    <script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
    <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
    /* .form-container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        border-radius: 10px;
        background-color: #f8f9fa;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    } */
    .form-container {
        background: #7d8ae1;
        padding: 10px;
        border: 2px solid #ac0404;
        float: left;
        font-size: 1.2em;
        position: relative;
        top: 0%;
        left: 3%;
        z-index: 99999;
        box-shadow: 0px 0px 20px #999;
        /* CSS3 */
        -moz-box-shadow: 0px 0px 20px #999;
        /* Firefox */
        -webkit-box-shadow: 0px 0px 20px #999;
        /* Safari, Chrome */
        border-radius: 3px 3px 3px 3px;
        -moz-border-radius: 3px;
        /* Firefox */
        -webkit-border-radius: 3px;
        /* Safari, Chrome */

        display: flex;
        justify-content: center;
        align-items: center;
        width: 80%;
        border-radius: 10px;
    }

    .form-section {
        margin-bottom: 20px;
    }

    .form-section h1 {
        background-color: #007bff;
        color: #ffffff;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 5px;
    }

    .form-group textarea {
        resize: none;
    }

    .form-group input[type="submit"] {
        background-color: #28a745;
        color: #ffffff;
        border: none;
        cursor: pointer;
    }

    .form-group input[type="submit"]:hover {
        background-color: #218838;
    }
    </style>
</head>

<body>
    <div class="form-container">
        <form action="submit_form.php" method="post">
            <p style="color:#ffffff; font-weight:bold; font-size:30px;" align="center">Medical Examination Form
            </p>
            <hr />
            <!-- General Information -->
            <div class="form-section">
                <h1>General Information</h1>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" class="form-control name=" name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="emp_id">EMP ID:</label>
                    <input type="text" class="form-control" name="emp_id" id="emp_id" required>
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" name="age" id="age" required>
                </div>
                <div class="form-group">
                    <label for="sex">Sex:</label>
                    <input type="text" class="form-control" name="sex" id="sex" required>
                </div>
                <div class="form-group">
                    <label for="date_of_examination">Date of Examination:</label>
                    <input type="date" name="date_of_examination" id="date_of_examination" required>
                </div>
                <div class="form-group">
                    <label for="designation">Designation:</label>
                    <input type="text" class="form-control" name="designation" id="designation" required>
                </div>
                <div class="form-group">
                    <label for="aadhar">Aadhar:</label>
                    <input type="text" class="form-control" name="aadhar" id="aadhar" required>
                </div>
                <div class="form-group">
                    <label for="esic">ESIC:</label>
                    <input type="text" class="form-control" name="esic" id="esic" required>
                </div>
                <div class="form-group">
                    <label for="type_of_examination">Type of Examination:</label>
                    <input type="text" class="form-control" name="type_of_examination" id="type_of_examination"
                        required>
                </div>
                <div class="form-group">
                    <label for="last_pme_date">Last PME Date:</label>
                    <input type="date" name="last_pme_date" id="last_pme_date" required>
                </div>
                <div class="form-group">
                    <label for="date_of_joining">Date of Joining:</label>
                    <input type="date" name="date_of_joining" id="date_of_joining" required>
                </div>
            </div>

            <!-- General Examination -->
            <div class="form-section">
                <h1>General Examination</h1>
                <div class="form-group">
                    <label for="height">Height (cm):</label>
                    <input type="number" step="0.01" name="height" id="height" required>
                </div>
                <div class="form-group">
                    <label for="weight">Weight (kg):</label>
                    <input type="number" step="0.01" name="weight" id="weight" required>
                </div>
                <div class="form-group">
                    <label for="inspiration">Inspiration (cm):</label>
                    <input type="number" step="0.01" name="inspiration" id="inspiration" required>
                </div>
                <div class="form-group">
                    <label for="expiration">Expiration (cm):</label>
                    <input type="number" step="0.01" name="expiration" id="expiration" required>
                </div>
                <div class="form-group">
                    <label for="built">Built:</label>
                    <select name="built" id="built" required>
                        <option value="average">Average</option>
                        <option value="strong">Strong</option>
                        <option value="poor">Poor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="throat">Throat:</label>
                    <input type="text" class="form-control" name="throat" id="throat" required>
                </div>
                <div class="form-group">
                    <label for="tongue">Tongue:</label>
                    <input type="text" class="form-control" name="tongue" id="tongue" required>
                </div>
                <div class="form-group">
                    <label for="teeth">Teeth:</label>
                    <input type="text" class="form-control" name="teeth" id="teeth" required>
                </div>
                <div class="form-group">
                    <label for="lymph_nodes">Lymph Nodes:</label>
                    <input type="text" class="form-control" name="lymph_nodes" id="lymph_nodes" required>
                </div>
                <div class="form-group">
                    <label for="additional_findings">Additional Findings:</label>
                    <textarea name="additional_findings" id="additional_findings"></textarea>
                </div>
            </div>

            <!-- Cardio-Vascular System -->
            <div class="form-section">
                <h1>Cardio-Vascular System</h1>
                <div class="form-group">
                    <label for="pulse">Pulse (min):</label>
                    <input type="number" name="pulse" id="pulse" required>
                </div>
                <div class="form-group">
                    <label for="bp">BP:</label>
                    <input type="text" class="form-control" name="bp" id="bp" required>
                </div>
                <div class="form-group">
                    <label for="cardio_findings">Additional Findings:</label>
                    <textarea name="cardio_findings" id="cardio_findings"></textarea>
                </div>
            </div>

            <!-- Respiratory System -->
            <div class="form-section">
                <h1>Respiratory System</h1>
                <div class="form-group">
                    <label for="resp_findings">Additional Findings:</label>
                    <textarea name="resp_findings" id="resp_findings"></textarea>
                </div>
            </div>

            <!-- Gastro-Intestinal System -->
            <div class="form-section">
                <h1>Gastro-Intestinal System</h1>
                <div class="form-group">
                    <label for="liver">Liver:</label>
                    <input type="text" class="form-control" name="liver" id="liver" required>
                </div>
                <div class="form-group">
                    <label for="spleen">Spleen:</label>
                    <input type="text" class="form-control" name="spleen" id="spleen" required>
                </div>
                <div class="form-group">
                    <label for="abdominal_lumps">Any Abdominal Lumps:</label>
                    <input type="text" class="form-control" name="abdominal_lumps" id="abdominal_lumps" required>
                </div>
            </div>

            <!-- Examination of Eyes -->
            <div class="form-section">
                <h1>Examination of Eyes</h1>
                <div class="form-group">
                    <label for="eye_external_exam">External Exam:</label>
                    <input type="text" class="form-control" name="eye_external_exam" id="eye_external_exam" required>
                </div>
                <div class="form-group">
                    <label for="eye_findings">Additional Findings:</label>
                    <textarea name="eye_findings" id="eye_findings"></textarea>
                </div>
                <div class="form-group">
                    <label for="distant_vision_right">Distant Vision (Right):</label>
                    <input type="text" class="form-control" name="distant_vision_right" id="distant_vision_right"
                        required>
                </div>
                <div class="form-group">
                    <label for="distant_vision_left">Distant Vision (Left):</label>
                    <input type="text" class="form-control" name="distant_vision_left" id="distant_vision_left"
                        required>
                </div>
                <div class="form-group">
                    <label for="near_vision_right">Near Vision (Right):</label>
                    <input type="text" class="form-control" name="near_vision_right" id="near_vision_right" required>
                </div>
                <div class="form-group">
                    <label for="near_vision_left">Near Vision (Left):</label>
                    <input type="text" class="form-control" name="near_vision_left" id="near_vision_left" required>
                </div>
                <div class="form-group">
                    <label for="night_blindness">Night Blindness (Nyctalopia):</label>
                    <input type="text" class="form-control" name="night_blindness" id="night_blindness" required>
                </div>
            </div>

            <!-- Examination of Ear, Nose & Throat -->
            <div class="form-section">
                <h1>Examination of Ear, Nose & Throat</h1>
                <div class="form-group">
                    <label for="ear_nose_throat">External Exam:</label>
                    <input type="text" class="form-control" name="ear_nose_throat" id="ear_nose_throat" required>
                </div>
            </div>

            <!-- Genito Urinary System -->
            <div class="form-section">
                <h1>Genito Urinary System</h1>
                <div class="form-group">
                    <label for="genito_urinary">Genito Urinary:</label>
                    <input type="text" class="form-control" name="genito_urinary" id="genito_urinary" required>
                </div>
            </div>

            <!-- Additional Remarks -->
            <div class="form-section">
                <h1>Additional Remarks</h1>
                <div class="form-group">
                    <label for="additional_remarks">Additional Remarks:</label>
                    <textarea name="additional_remarks" id="additional_remarks"></textarea>
                </div>
            </div>

            <!-- Investigations -->
            <div class="form-section">
                <h1>Investigations</h1>
                <div class="form-group">
                    <label for="investigations">Investigations:</label>
                    <textarea name="investigations" id="investigations"></textarea>
                </div>
            </div>

            <div class="form-group">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>

</html>