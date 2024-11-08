<?php session_start(); ?>
<html>

<head>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style type="text/css">
        p {
            margin: 10px 0;
            padding: 0;
        }

        table {
            border-collapse: collapse;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            display: block;
            margin: 0;
            padding: 0;
        }

        img,
        a img {
            border: 0;
            height: auto;
            outline: none;
            text-decoration: none;
        }

        body,
        #bodyTable,
        #bodyCell {
            height: 100%;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .mcnPreviewText {
            display: none !important;
        }

        #outlook a {
            padding: 0;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        table {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        p,
        a,
        li,
        td,
        blockquote {
            mso-line-height-rule: exactly;
        }

        a[href^=tel],
        a[href^=sms] {
            color: inherit;
            cursor: default;
            text-decoration: none;
        }

        p,
        a,
        li,
        td,
        body,
        table,
        blockquote {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass td,
        .ExternalClass div,
        .ExternalClass span,
        .ExternalClass font {
            line-height: 100%;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        #bodyCell {
            padding: 10px;
        }

        .templateContainer {
            max-width: 600px !important;
        }

        a.mcnButton {
            display: block;
        }

        .mcnImage,
        .mcnRetinaImage {
            vertical-align: bottom;
        }

        .mcnTextContent {
            word-break: break-word;
        }

        .mcnTextContent img {
            height: auto !important;
        }

        .mcnDividerBlock {
            table-layout: fixed !important;
        }

        /*
    @tab Page
    @section Background Style
    @tip Set the background color and top border for your email. You may want to choose colors that match your company's branding.
    */
        body,
        #bodyTable {
            /*@editable*/
            background-color: #FFFFFF;
        }

        /*
    @tab Page
    @section Background Style
    @tip Set the background color and top border for your email. You may want to choose colors that match your company's branding.
    */
        #bodyCell {
            /*@editable*/
            border-top: 0;
        }

        /*
    @tab Page
    @section Email Border
    @tip Set the border for your email.
    */
        .templateContainer {
            /*@editable*/
            border: 5px solid #FFFFFF;
        }

        /*
    @tab Page
    @section Heading 1
    @tip Set the styling for all first-level headings in your emails. These should be the largest of your headings.
    @style heading 1
    */
        h1 {
            /*@editable*/
            color: #B2B2B2;
            /*@editable*/
            font-family: Helvetica;
            /*@editable*/
            font-size: 30px;
            /*@editable*/
            font-style: normal;
            /*@editable*/
            font-weight: bold;
            /*@editable*/
            line-height: 100%;
            /*@editable*/
            letter-spacing: normal;
            /*@editable*/
            text-align: left;
        }

        /*
    @tab Page
    @section Heading 2
    @tip Set the styling for all second-level headings in your emails.
    @style heading 2
    */
        h2 {
            /*@editable*/
            color: #303030;
            /*@editable*/
            font-family: Helvetica;
            /*@editable*/
            font-size: 22px;
            /*@editable*/
            font-style: normal;
            /*@editable*/
            font-weight: bold;
            /*@editable*/
            line-height: 125%;
            /*@editable*/
            letter-spacing: normal;
            /*@editable*/
            text-align: left;
        }

        /*
    @tab Page
    @section Heading 3
    @tip Set the styling for all third-level headings in your emails.
    @style heading 3
    */
        h3 {
            /*@editable*/
            color: #303030;
            /*@editable*/
            font-family: Helvetica;
            /*@editable*/
            font-size: 16px;
            /*@editable*/
            font-style: normal;
            /*@editable*/
            font-weight: bold;
            /*@editable*/
            line-height: 125%;
            /*@editable*/
            letter-spacing: normal;
            /*@editable*/
            text-align: left;
        }

        /*
    @tab Page
    @section Heading 4
    @tip Set the styling for all fourth-level headings in your emails. These should be the smallest of your headings.
    @style heading 4
    */
        h4 {
            /*@editable*/
            color: #505050;
            /*@editable*/
            font-family: Helvetica;
            /*@editable*/
            font-size: 14px;
            /*@editable*/
            font-style: normal;
            /*@editable*/
            font-weight: bold;
            /*@editable*/
            line-height: 125%;
            /*@editable*/
            letter-spacing: normal;
            /*@editable*/
            text-align: left;
        }

        #templateUpperHeader {
            padding-top: 30px;
            padding-right: 15px;
        }

        /*
    @tab Header
    @section Header Style
    @tip Set the background color and borders for your email's header area.
    */
        .templateHeader {
            /*@editable*/
            background-color: #EFEFEF;
            border-top: 0;
            border-bottom: 0;
            padding-bottom: 10px;
        }

        /*
    @tab Header
    @section Header Text
    @tip Set the styling for your email's header text. Choose a size and color that is easy to read.
    */
        .templateHeader .mcnTextContent,
        .templateHeader .mcnTextContent p {
            /*@editable*/
            color: #202020;
            /*@editable*/
            font-family: Helvetica;
            /*@editable*/
            font-size: 16px;
            /*@editable*/
            line-height: 150%;
            /*@editable*/
            text-align: left;
        }

        /*
    @tab Header
    @section Header Link
    @tip Set the styling for your email's header links. Choose a color that helps them stand out from your text.
    */
        .templateHeader .mcnTextContent a,
        .templateHeader .mcnTextContent p a {
            /*@editable*/
            color: #2BAADF;
            /*@editable*/
            font-weight: normal;
            /*@editable*/
            text-decoration: underline;
        }

        #templateSidebar {
            border-top: 0;
            border-bottom: 0;
            padding-top: 9px;
            padding-bottom: 9px;
        }

        /*
    @tab Sidebar
    @section Calendar Style
    @tip Set the background color and borders for your email's calendar.
    */
        #calendarContainer {
            /*@editable*/
            background-color: #FFFFFF;
            /*@editable*/
            border: 5px solid #FFFFFF;
        }

        /*
    @tab Sidebar
    @section Calendar Month Text
    @tip The styling for your email's calendar month text. Make it a color and size that is easy to read.
    */
        #monthContainer {
            /*@editable*/
            background-color: #EFEFEF;
            /*@editable*/
            color: #303030;
            /*@editable*/
            font-family: Helvetica;
            /*@editable*/
            font-size: 14px;
            /*@editable*/
            font-weight: bold;
            /*@editable*/
            line-height: 150%;
        }

        /*
    @tab Sidebar
    @section Calendar Day Text
    @tip The styling for your email's calendar day text. Make it a color and size that is easy to read.
    */
        #dayContainer {
            /*@editable*/
            background-color: #FFFFFF;
            /*@editable*/
            color: #303030;
            /*@editable*/
            font-family: Helvetica;
            /*@editable*/
            font-size: 72px;
            /*@editable*/
            font-weight: bold;
            /*@editable*/
            line-height: 100%;
        }

        /*
    @tab Sidebar
    @section Sidebar Text
    @tip Set the styling for your email's sidebar text. Choose a size and color that is easy to read.
    */
        #templateSidebar .mcnTextContent,
        #templateSidebar .mcnTextContent p {
            /*@editable*/
            color: #505050;
            /*@editable*/
            font-family: Helvetica;
            /*@editable*/
            font-size: 12px;
            /*@editable*/
            line-height: 150%;
            /*@editable*/
            text-align: left;
        }

        /*
    @tab Sidebar
    @section Sidebar Link
    @tip Set the styling for your email's sidebar links. Choose a color that helps them stand out from your text.
    */
        #templateSidebar .mcnTextContent a,
        #templateSidebar .mcnTextContent p a {
            /*@editable*/
            color: #6ACC3B;
            /*@editable*/
            font-weight: normal;
            /*@editable*/
            text-decoration: underline;
        }

        /*
    @tab Body
    @section Body Style
    @tip Set the background color and borders for your email's body.
    */
        #templateBody,
        #templateColumns {
            /*@editable*/
            background-color: #EFEFEF;
            /*@editable*/
            border-top: 0;
            /*@editable*/
            border-bottom: 0;
            padding-top: 0;
            padding-bottom: 9px;
        }

        /*
    @tab Body
    @section Body Text
    @tip Set the styling for your email's body text. Choose a size and color that is easy to read.
    */
        #templateBody .mcnTextContent,
        #templateBody .mcnTextContent p {
            /*@editable*/
            color: #505050;
            /*@editable*/
            font-family: Helvetica;
            /*@editable*/
            font-size: 16px;
            /*@editable*/
            line-height: 150%;
            /*@editable*/
            text-align: left;
        }

        /*
    @tab Body
    @section Body Link
    @tip Set the styling for your email's body links. Choose a color that helps them stand out from your text.
    */
        #templateBody .mcnTextContent a,
        #templateBody .mcnTextContent p a {
            /*@editable*/
            color: #6ACC3B;
            /*@editable*/
            font-weight: normal;
            /*@editable*/
            text-decoration: underline;
        }

        /*
    @tab Lower Body
    @section Lower Body Style
    @tip Set the background color and borders for your email's lower body.
    */
        #templateLowerBody {
            /*@editable*/
            background-color: #EFEFEF;
            /*@editable*/
            border-top: 0;
            /*@editable*/
            border-bottom: 0;
            padding-top: 0;
            padding-bottom: 0;
        }

        /*
    @tab Lower Body
    @section Lower Body Text
    @tip Set the styling for your email's lower body text. Choose a size and color that is easy to read.
    */
        #templateLowerBody .mcnTextContent,
        #templateLowerBody .mcnTextContent p {
            /*@editable*/
            color: #505050;
            /*@editable*/
            font-family: Helvetica;
            /*@editable*/
            font-size: 16px;
            /*@editable*/
            line-height: 150%;
            /*@editable*/
            text-align: left;
        }

        /*
    @tab Lower Body
    @section Lower Body Link
    @tip Set the styling for your email's lower body links. Choose a color that helps them stand out from your text.
    */
        #templateLowerBody .mcnTextContent a,
        #templateLowerBody .mcnTextContent p a {
            /*@editable*/
            color: #6ACC3B;
            /*@editable*/
            font-weight: normal;
            /*@editable*/
            text-decoration: underline;
        }

        /*
    @tab Footer
    @section Footer Style
    @tip Set the background color and borders for your email's footer area.
    */
        #templateFooter {
            /*@editable*/
            background-color: #EFEFEF;
            /*@editable*/
            border-top: 5px solid #FFFFFF;
            /*@editable*/
            border-bottom: 0;
            padding-top: 9px;
            padding-bottom: 9px;
        }

        /*
    @tab Footer
    @section Footer Text
    @tip Set the styling for your email's footer text. Choose a size and color that is easy to read.
    */
        #templateFooter .mcnTextContent,
        #templateFooter .mcnTextContent p {
            /*@editable*/
            color: #505050;
            /*@editable*/
            font-family: Helvetica;
            /*@editable*/
            font-size: 12px;
            /*@editable*/
            line-height: 150%;
            /*@editable*/
            text-align: center;
        }

        /*
    @tab Footer
    @section Footer Link
    @tip Set the styling for your email's footer links. Choose a color that helps them stand out from your text.
    */
        #templateFooter .mcnTextContent a,
        #templateFooter .mcnTextContent p a {
            /*@editable*/
            color: #6ACC3B;
            /*@editable*/
            font-weight: normal;
            /*@editable*/
            text-decoration: underline;
        }

        @media only screen and (min-width:768px) {
            .templateContainer {
                width: 600px !important;
            }

        }

        @media only screen and (max-width: 480px) {

            body,
            table,
            td,
            p,
            a,
            li,
            blockquote {
                -webkit-text-size-adjust: none !important;
            }

        }

        @media only screen and (max-width: 480px) {
            body {
                width: 100% !important;
                min-width: 100% !important;
            }

        }

        @media only screen and (max-width: 480px) {
            #bodyCell {
                padding-top: 10px !important;
            }

        }

        @media only screen and (max-width: 480px) {

            #templateSidebar,
            #templateBody {
                max-width: 100% !important;
                width: 100% !important;
            }

        }

        @media only screen and (max-width: 480px) {
            .mcnRetinaImage {
                max-width: 100% !important;
            }

        }

        @media only screen and (max-width: 480px) {
            .mcnImage {
                width: 100% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            .mcnCartContainer,
            .mcnCaptionTopContent,
            .mcnRecContentContainer,
            .mcnCaptionBottomContent,
            .mcnTextContentContainer,
            .mcnBoxedTextContentContainer,
            .mcnImageGroupContentContainer,
            .mcnCaptionLeftTextContentContainer,
            .mcnCaptionRightTextContentContainer,
            .mcnCaptionLeftImageContentContainer,
            .mcnCaptionRightImageContentContainer,
            .mcnImageCardLeftTextContentContainer,
            .mcnImageCardRightTextContentContainer,
            .mcnImageCardLeftImageContentContainer,
            .mcnImageCardRightImageContentContainer {
                max-width: 100% !important;
                width: 100% !important;
            }

        }

        @media only screen and (max-width: 480px) {
            .mcnBoxedTextContentContainer {
                min-width: 100% !important;
            }

        }

        @media only screen and (max-width: 480px) {
            .mcnImageGroupContent {
                padding: 9px !important;
            }

        }

        @media only screen and (max-width: 480px) {

            .mcnCaptionLeftContentOuter .mcnTextContent,
            .mcnCaptionRightContentOuter .mcnTextContent {
                padding-top: 9px !important;
            }

        }

        @media only screen and (max-width: 480px) {

            .mcnImageCardTopImageContent,
            .mcnCaptionBottomContent:last-child .mcnCaptionBottomImageContent,
            .mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent {
                padding-top: 18px !important;
            }

        }

        @media only screen and (max-width: 480px) {
            .mcnImageCardBottomImageContent {
                padding-bottom: 9px !important;
            }

        }

        @media only screen and (max-width: 480px) {
            .mcnImageGroupBlockInner {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }

        }

        @media only screen and (max-width: 480px) {
            .mcnImageGroupBlockOuter {
                padding-top: 9px !important;
                padding-bottom: 9px !important;
            }

        }

        @media only screen and (max-width: 480px) {

            .mcnTextContent,
            .mcnBoxedTextContentColumn {
                padding-right: 18px !important;
                padding-left: 18px !important;
            }

        }

        @media only screen and (max-width: 480px) {

            .mcnImageCardLeftImageContent,
            .mcnImageCardRightImageContent {
                padding-right: 18px !important;
                padding-bottom: 0 !important;
                padding-left: 18px !important;
            }

        }

        @media only screen and (max-width: 480px) {
            .mcpreview-image-uploader {
                display: none !important;
                width: 100% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
    @tab Mobile Styles
    @section Heading 1
    @tip Make the first-level headings larger in size for better readability on small screens.
    */
            h1 {
                /*@editable*/
                font-size: 22px !important;
                /*@editable*/
                line-height: 125% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
    @tab Mobile Styles
    @section Heading 2
    @tip Make the second-level headings larger in size for better readability on small screens.
    */
            h2 {
                /*@editable*/
                font-size: 20px !important;
                /*@editable*/
                line-height: 125% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
    @tab Mobile Styles
    @section Heading 3
    @tip Make the third-level headings larger in size for better readability on small screens.
    */
            h3 {
                /*@editable*/
                font-size: 18px !important;
                /*@editable*/
                line-height: 125% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
    @tab Mobile Styles
    @section Heading 4
    @tip Make the fourth-level headings larger in size for better readability on small screens.
    */
            h4 {
                /*@editable*/
                font-size: 16px !important;
                /*@editable*/
                line-height: 150% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
    @tab Mobile Styles
    @section Boxed Text
    @tip Make the boxed text larger in size for better readability on small screens. We recommend a font size of at least 16px.
    */
            .mcnBoxedTextContentContainer .mcnTextContent,
            .mcnBoxedTextContentContainer .mcnTextContent p {
                /*@editable*/
                font-size: 14px !important;
                /*@editable*/
                line-height: 150% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
    @tab Mobile Styles
    @section Header Text
    @tip Make the header text larger in size for better readability on small screens.
    */
            .templateHeader .mcnTextContent,
            .templateHeader .mcnTextContent p {
                /*@editable*/
                font-size: 16px !important;
                /*@editable*/
                line-height: 150% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
    @tab Mobile Styles
    @section Sidebar Text
    @tip Make the sidebar text larger in size for better readability on small screens. We recommend a font size of at least 16px.
    */
            #templateSidebar .mcnTextContent,
            #templateSidebar .mcnTextContent p {
                /*@editable*/
                font-size: 16px !important;
                /*@editable*/
                line-height: 150% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
    @tab Mobile Styles
    @section Body Text
    @tip Make the body text larger in size for better readability on small screens. We recommend a font size of at least 16px.
    */
            #templateBody .mcnTextContent,
            #templateBody .mcnTextContent p {
                /*@editable*/
                font-size: 16px !important;
                /*@editable*/
                line-height: 150% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
    @tab Mobile Styles
    @section BLower ody Text
    @tip Make the lower body text larger in size for better readability on small screens. We recommend a font size of at least 16px.
    */
            #templateLowerBody .mcnTextContent,
            #templateLowerBody .mcnTextContent p {
                /*@editable*/
                font-size: 16px !important;
                /*@editable*/
                line-height: 150% !important;
            }

        }

        @media only screen and (max-width: 480px) {

            /*
    @tab Mobile Styles
    @section Footer Text
    @tip Make the footer content text larger in size for better readability on small screens.
    */
            #templateFooter .mcnTextContent,
            #templateFooter .mcnTextContent p {
                /*@editable*/
                font-size: 14px !important;
                /*@editable*/
                line-height: 150% !important;
            }

        }
    </style>
</head>

<body>
    <?php
    include ('config.php');

    $Membership_Level = $_POST['Membership_Level'];


    require_once 'phpmail/src/PHPMailer.php';
    require_once 'phpmail/src/SMTP.php';
    require_once 'phpmail/src/Exception.php';




    //===========for mail- New Year First Orchid Member===============
    

    if ($Membership_Level == "All" || $Membership_Level == "1" || $Membership_Level == "2" || $Membership_Level == "3") {

        if ($Membership_Level == "All") {
            $qrys1 = mysqli_query($conn, "select Static_LeadID,Primary_nameOnTheCard from Members where MembershipDetails_Level IN (1,2,3)");
        } else {
            $qrys1 = mysqli_query($conn, "select Static_LeadID,Primary_nameOnTheCard from Members where MembershipDetails_Level='" . $Membership_Level . "' ");
        }
        while ($fetchMem = mysqli_fetch_array($qrys1)) {

            $qrys2 = mysqli_query($conn, "select EmailId from Leads_table where Lead_id='" . $fetchMem['Static_LeadID'] . "'");
            $fetchMem2 = mysqli_fetch_array($qrys2);





            if ($Membership_Level == 1) {
                $Level = "Orchid First";
            } else if ($Membership_Level == 2) {
                $Level = "Orchid Gold";
            } else if ($Membership_Level == 3) {
                $Level = "Orchid Platinum";
            }

            $EmailSubject2 = "New Years Eve packages at our hotels & resorts.";

            $message2 = '';
            $message2 .= ' <span class="mcnPreviewText" style="display:none; font-size:0px; line-height:0px; max-height:0px; max-width:0px; opacity:0; overflow:hidden; visibility:hidden; mso-hide:all;"></span><!--<![endif]-->
        <!--*|END:IF|*-->
        <center>
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
                <tr>
                    <td align="center" valign="top" id="bodyCell">
						<!-- BEGIN TEMPLATE // -->
						<!--[if gte mso 9]>
						<table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
						<tr>
						<td align="center" valign="top" width="600" style="width:600px;">
						<![endif]-->
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer">
							<tr>
								<td valign="top" id="templateUpperHeader" class="templateHeader">
									<table align="left" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td align="left" valign="middle">
												<img src="https://cdn-images.mailchimp.com/template_images/gallery/47662b23-df38-45d4-8005-9b2f50193f4b.png" height="30" width="15" style="boder:0; display:block;">
											</td>
											<td align="left" valign="middle" width="100%"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:9px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 9px; padding-left: 9px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/de976798b8f6f381d8a2d349b/images/4cf49a51-e749-4e4f-8614-fd06dcf6e315.png" width="524" style="max-width:736px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top:9px;">
              	<!--[if mso]>
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
				<![endif]-->
			    
				<!--[if mso]>
				<td valign="top" width="560" style="width:560px;">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;">
                        
                            <h1><span style="font-size:24px">RING IN 2020 WITH SPECIAL CELEBRATIONS</span></h1>

<h3>AT OUR HOTELS &amp; RESORTS</h3>

                        </td>
                    </tr>
                </tbody></table>
				<!--[if mso]>
				</td>
				<![endif]-->
                
				<!--[if mso]>
				</tr>
				</table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td valign="top" class="templateHeader">
									<table align="left" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td align="left" valign="middle" width="100%"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width:100%;">
    <!--[if gte mso 9]>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
	<![endif]-->
	<tbody class="mcnBoxedTextBlockOuter">
        <tr>
            <td valign="top" class="mcnBoxedTextBlockInner">
                
				<!--[if gte mso 9]>
				<td align="center" valign="top" ">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnBoxedTextContentContainer">
                    <tbody><tr>
                        
                        <td style="padding-top:9px; padding-left:18px; padding-bottom:9px; padding-right:18px;">
                        
                            <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #5A1F5A;">
                                <tbody><tr>
                                    <td valign="top" class="mcnTextContent" style="padding: 18px;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;text-align: center;">
                                        <strong>Sholay Ka SWAG at&nbsp;The Orchid Hotel Mumbai</strong>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
				<!--[if gte mso 9]>
				</td>
				<![endif]-->
                
				<!--[if gte mso 9]>
                </tr>
                </table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:0px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 0px; padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/de976798b8f6f381d8a2d349b/images/91057a2f-ff29-4ed5-9ff1-d4a77046af40.jpeg" width="590" style="max-width:902px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td valign="top" id="templateColumns">
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td valign="top">
												<!--[if gte mso 9]>
												<table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
												<tr>
												<td align="center" valign="top" width="400" style="width:400px;">
												<![endif]-->
												<table align="left" border="0" cellpadding="0" cellspacing="0" width="380" id="templateBody">
													<tr>
														<td><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top:9px;">
              	<!--[if mso]>
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
				<![endif]-->
			    
				<!--[if mso]>
				<td valign="top" width="380" style="width:380px;">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;">
                        
                            <p>A Special 10% discount is available only to our Orchid Members on Cascade &amp; Upper Deck packages.<br>
<br>
</p>

                        </td>
                    </tr>
                </tbody></table>
				<!--[if mso]>
				</td>
				<![endif]-->
                
				<!--[if mso]>
				</tr>
				</table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table></td>
													</tr>
												</table>
												<!--[if gte mso 9]>
												</td>
												<td align="center"  valign="top" width="200" style="width:200px;">
												<![endif]-->
												<table align="left" border="0" cellpadding="0" cellspacing="0" width="186" id="templateSidebar">
													<tr>
														<td align="center" valign="top" style="padding-top:9px; padding-bottom:9px;">
															<table border="0" cellpadding="5" cellspacing="5" width="150" id="calendarContainer">
																<tr>
																	<td align="center" bgcolor="#EFEFEF" valign="top" id="monthContainer">
																		<div mc:edit="month">December 2019</div>
																	</td>
																</tr>
																<tr>
																	<td align="center" valign="top" id="dayContainer">
																		<div mc:edit="day">31</div>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td valign="top"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top:9px;">
              	<!--[if mso]>
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
				<![endif]-->
			    
				<!--[if mso]>
				<td valign="top" width="186" style="width:186px;">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;">
                        
                            Sign up today, this event will sell out!
                        </td>
                    </tr>
                </tbody></table>
				<!--[if mso]>
				</td>
				<![endif]-->
                
				<!--[if mso]>
				</tr>
				</table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width:100%;">
    <tbody class="mcnButtonBlockOuter">
        <tr>
            <td style="padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top" align="center" class="mcnButtonBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonContentContainer" style="border-collapse: separate !important;border: 5px solid #FFFFFF;background-color: #60CA2E;">
                    <tbody>
                        <tr>
                            <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Helvetica; font-size: 14px; padding: 15px;">
                                <a class="mcnButton " title="REGISTER NOW" href="https://www.orchidhotel.com/new-year/new-year-query-form.html" target="_self" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">REGISTER NOW</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table></td>
													</tr>
												</table>
												<!--[if gte mso 9]>
												</td>
												</tr>
												</table>
												<![endif]-->
											</td>
											<td align="right" valign="top" style="padding-top:18px;">
												<img src="https://cdn-images.mailchimp.com/template_images/gallery/03c9e5d8-4a2f-471e-b646-37327134c2b0.png" height="30" width="15" style="boder:0; display:block;">
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td valign="top" id="templateLowerBody">
									<table align="left" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td align="left" valign="middle">
												<img src="https://cdn-images.mailchimp.com/template_images/gallery/47662b23-df38-45d4-8005-9b2f50193f4b.png" height="30" width="15" style="boder:0; display:block;">
											</td>
											<td align="left" valign="middle" width="100%"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width:100%;">
    <tbody class="mcnDividerBlockOuter">
        <tr>
            <td class="mcnDividerBlockInner" style="min-width:100%; padding:18px;">
                <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px solid #EAEAEA;">
                    <tbody><tr>
                        <td>
                            <span></span>
                        </td>
                    </tr>
                </tbody></table>
<!--            
                <td class="mcnDividerBlockInner" style="padding: 18px;">
                <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width:100%;">
    <!--[if gte mso 9]>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
	<![endif]-->
	<tbody class="mcnBoxedTextBlockOuter">
        <tr>
            <td valign="top" class="mcnBoxedTextBlockInner">
                
				<!--[if gte mso 9]>
				<td align="center" valign="top" ">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnBoxedTextContentContainer">
                    <tbody><tr>
                        
                        <td style="padding-top:9px; padding-left:18px; padding-bottom:9px; padding-right:18px;">
                        
                            <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #5A1F5A;">
                                <tbody><tr>
                                    <td valign="top" class="mcnTextContent" style="padding: 18px;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;text-align: center;">
                                        <h3 style="text-align: center;"><span style="color:#FFFFFF">New Year Packages at&nbsp;Fort JadhavGADH</span></h3>

<h3 style="text-align: center;"><span style="color:#33ffcc">Members Special</span></h3>

<p style="text-align: center;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;"><span style="color:#FFFFFF">A Special 15%&nbsp;discount is available for Orchid Members on the New Year stay packages at Fort JadhavGADH</span></p>

                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
				<!--[if gte mso 9]>
				</td>
				<![endif]-->
                
				<!--[if gte mso 9]>
                </tr>
                </table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:0px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 0px; padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/de976798b8f6f381d8a2d349b/images/2d91443d-70bd-4ec8-87b9-6eb332e8724c.png" width="575" style="max-width:1654px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width:100%;">
    <tbody class="mcnButtonBlockOuter">
        <tr>
            <td style="padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top" align="center" class="mcnButtonBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonContentContainer" style="border-collapse: separate !important;border: 5px solid #FFFFFF;background-color: #60CA2E;">
                    <tbody>
                        <tr>
                            <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Helvetica; font-size: 14px; padding: 15px;">
                                <a class="mcnButton " title="REGISTER YOUR INTEREST" href="https://www.orchidhotel.com/new-year/new-year-query-form.html" target="_self" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">REGISTER YOUR INTEREST</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width:100%;">
    <tbody class="mcnDividerBlockOuter">
        <tr>
            <td class="mcnDividerBlockInner" style="min-width:100%; padding:18px;">
                <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px solid #EAEAEA;">
                    <tbody><tr>
                        <td>
                            <span></span>
                        </td>
                    </tr>
                </tbody></table>
<!--            
                <td class="mcnDividerBlockInner" style="padding: 18px;">
                <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width:100%;">
    <!--[if gte mso 9]>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
	<![endif]-->
	<tbody class="mcnBoxedTextBlockOuter">
        <tr>
            <td valign="top" class="mcnBoxedTextBlockInner">
                
				<!--[if gte mso 9]>
				<td align="center" valign="top" ">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnBoxedTextContentContainer">
                    <tbody><tr>
                        
                        <td style="padding-top:9px; padding-left:18px; padding-bottom:9px; padding-right:18px;">
                        
                            <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #5A1F5A;">
                                <tbody><tr>
                                    <td valign="top" class="mcnTextContent" style="padding: 18px;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;text-align: center;">
                                        <div style="text-align: center;">
<h3 style="text-align: center;"><span style="color:#FFFFFF">Couples Stay Package at&nbsp;The Orchid Hotel&nbsp;Pune</span><br>
<span style="color:#cc66cc">Members Special</span></h3>

<p style="text-align: center;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;"><span style="color:#FFFFFF">A Special 10%&nbsp;discount is available for Orchid Members on the New Year stay packages at The Orchid Hotel Pune</span></p>
</div>

                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
				<!--[if gte mso 9]>
				</td>
				<![endif]-->
                
				<!--[if gte mso 9]>
                </tr>
                </table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:0px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 0px; padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/de976798b8f6f381d8a2d349b/images/3e9f15d6-4509-4ac1-9fe7-16d53959f7ef.png" width="575" style="max-width:1750px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width:100%;">
    <tbody class="mcnButtonBlockOuter">
        <tr>
            <td style="padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top" align="center" class="mcnButtonBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonContentContainer" style="border-collapse: separate !important;border: 5px solid #FFFFFF;background-color: #60CA2E;">
                    <tbody>
                        <tr>
                            <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Helvetica; font-size: 14px; padding: 15px;">
                                <a class="mcnButton " title="REGISTER YOUR INTEREST" href="https://www.orchidhotel.com/new-year/new-year-query-form.html" target="_self" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">REGISTER YOUR INTEREST</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width:100%;">
    <tbody class="mcnDividerBlockOuter">
        <tr>
            <td class="mcnDividerBlockInner" style="min-width:100%; padding:18px;">
                <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px solid #EAEAEA;">
                    <tbody><tr>
                        <td>
                            <span></span>
                        </td>
                    </tr>
                </tbody></table>
<!--            
                <td class="mcnDividerBlockInner" style="padding: 18px;">
                <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width:100%;">
    <!--[if gte mso 9]>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
	<![endif]-->
	<tbody class="mcnBoxedTextBlockOuter">
        <tr>
            <td valign="top" class="mcnBoxedTextBlockInner">
                
				<!--[if gte mso 9]>
				<td align="center" valign="top" ">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnBoxedTextContentContainer">
                    <tbody><tr>
                        
                        <td style="padding-top:9px; padding-left:18px; padding-bottom:9px; padding-right:18px;">
                        
                            <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #5A1F5A;">
                                <tbody><tr>
                                    <td valign="top" class="mcnTextContent" style="padding: 18px;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;text-align: center;">
                                        <div style="text-align: center;">
<h3 style="text-align: center;"><span style="color:#FFFFFF">New Years Bash at the Lotus Eco Beach Resort Goa</span></h3>

<h3 style="text-align: center;"><span style="color:#FFFF00">Members Special</span></h3>

<p style="text-align: center;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;"><span style="color:#FFFFFF">A Special 15%&nbsp;discount is available for Orchid Members on the New Year stay packages at Lotus Eco Beach Resort Goa</span></p>
</div>

                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
				<!--[if gte mso 9]>
				</td>
				<![endif]-->
                
				<!--[if gte mso 9]>
                </tr>
                </table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:0px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 0px; padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/de976798b8f6f381d8a2d349b/images/19386603-990e-4786-8768-e71c2e0c3d94.jpg" width="575" style="max-width:1749px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width:100%;">
    <tbody class="mcnButtonBlockOuter">
        <tr>
            <td style="padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top" align="center" class="mcnButtonBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonContentContainer" style="border-collapse: separate !important;border: 5px solid #FFFFFF;background-color: #60CA2E;">
                    <tbody>
                        <tr>
                            <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Helvetica; font-size: 14px; padding: 15px;">
                                <a class="mcnButton " title="REGISTER YOUR INTEREST" href="https://www.orchidhotel.com/new-year/new-year-query-form.html" target="_self" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">REGISTER YOUR INTEREST</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width:100%;">
    <tbody class="mcnDividerBlockOuter">
        <tr>
            <td class="mcnDividerBlockInner" style="min-width:100%; padding:18px;">
                <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px solid #EAEAEA;">
                    <tbody><tr>
                        <td>
                            <span></span>
                        </td>
                    </tr>
                </tbody></table>
<!--            
                <td class="mcnDividerBlockInner" style="padding: 18px;">
                <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width:100%;">
    <!--[if gte mso 9]>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
	<![endif]-->
	<tbody class="mcnBoxedTextBlockOuter">
        <tr>
            <td valign="top" class="mcnBoxedTextBlockInner">
                
				<!--[if gte mso 9]>
				<td align="center" valign="top" ">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnBoxedTextContentContainer">
                    <tbody><tr>
                        
                        <td style="padding-top:9px; padding-left:18px; padding-bottom:9px; padding-right:18px;">
                        
                            <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #5A1F5A;">
                                <tbody><tr>
                                    <td valign="top" class="mcnTextContent" style="padding: 18px;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;text-align: center;">
                                        <div style="text-align: center;"><strong>Welcome 2020 Exclusively at&nbsp;Lotus Eco Beach Resort&nbsp;Murud - Dapoli</strong></div>

                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
				<!--[if gte mso 9]>
				</td>
				<![endif]-->
                
				<!--[if gte mso 9]>
                </tr>
                </table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:0px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 0px; padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/de976798b8f6f381d8a2d349b/images/29dcc292-533b-403e-91f8-1d06390a9ffb.png" width="575" style="max-width:1750px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width:100%;">
    <tbody class="mcnButtonBlockOuter">
        <tr>
            <td style="padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top" align="center" class="mcnButtonBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonContentContainer" style="border-collapse: separate !important;border: 5px solid #FFFFFF;background-color: #60CA2E;">
                    <tbody>
                        <tr>
                            <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Helvetica; font-size: 14px; padding: 15px;">
                                <a class="mcnButton " title="REGISTER YOUR INTEREST" href="https://www.orchidhotel.com/new-year/new-year-query-form.html" target="_self" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">REGISTER YOUR INTEREST</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width:100%;">
    <!--[if gte mso 9]>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
	<![endif]-->
	<tbody class="mcnBoxedTextBlockOuter">
        <tr>
            <td valign="top" class="mcnBoxedTextBlockInner">
                
				<!--[if gte mso 9]>
				<td align="center" valign="top" ">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnBoxedTextContentContainer">
                    <tbody><tr>
                        
                        <td style="padding-top:9px; padding-left:18px; padding-bottom:9px; padding-right:18px;">
                        
                            <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #404040;">
                                <tbody><tr>
                                    <td valign="top" class="mcnTextContent" style="padding: 18px;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;text-align: center;">
                                        <strong>Limited seats, subject to availability.&nbsp;<br>
For reservations please call our Member Help Desk at&nbsp;+91 9169166789</strong>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
				<!--[if gte mso 9]>
				</td>
				<![endif]-->
                
				<!--[if gte mso 9]>
                </tr>
                </table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowBlock" style="min-width:100%;">
    <tbody class="mcnFollowBlockOuter">
        <tr>
            <td align="center" valign="top" style="padding:9px" class="mcnFollowBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentContainer" style="min-width:100%;">
    <tbody><tr>
        <td align="center" style="padding-left:9px;padding-right:9px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnFollowContent">
                <tbody><tr>
                    <td align="center" valign="top" style="padding-top:9px; padding-right:9px; padding-left:9px;">
                        <table align="center" border="0" cellpadding="0" cellspacing="0">
                            <tbody><tr>
                                <td align="center" valign="top">
                                    <!--[if mso]>
                                    <table align="center" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                    <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->
                                        
                                        
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right:10px; padding-bottom:9px;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                        <tbody><tr>
                                                                            
                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
                                                                                    <a href="https://www.facebook.com/TheOrchidHotels/" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/light-facebook-48.png" alt="Facebook" style="display:block;" height="24" width="24" class=""></a>
                                                                                </td>
                                                                            
                                                                            
                                                                                <td align="left" valign="middle" class="mcnFollowTextContent" style="padding-left:5px;">
                                                                                    <a href="https://www.facebook.com/TheOrchidHotels/" target="" style="font-family: Helvetica;font-size: 11px;text-decoration: none;color: #505050;font-weight: bold;text-align: center;">Facebook</a>
                                                                                </td>
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->
                                        
                                        
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right:10px; padding-bottom:9px;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                        <tbody><tr>
                                                                            
                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
                                                                                    <a href="https://www.instagram.com/orchidhotelpune/" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/light-instagram-48.png" alt="Instagram" style="display:block;" height="24" width="24" class=""></a>
                                                                                </td>
                                                                            
                                                                            
                                                                                <td align="left" valign="middle" class="mcnFollowTextContent" style="padding-left:5px;">
                                                                                    <a href="https://www.instagram.com/orchidhotelpune/" target="" style="font-family: Helvetica;font-size: 11px;text-decoration: none;color: #505050;font-weight: bold;text-align: center;">Instagram</a>
                                                                                </td>
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->
                                        
                                        
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right:10px; padding-bottom:9px;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                        <tbody><tr>
                                                                            
                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
                                                                                    <a href="https://www.orchidhotel.com" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/light-link-48.png" alt="Website" style="display:block;" height="24" width="24" class=""></a>
                                                                                </td>
                                                                            
                                                                            
                                                                                <td align="left" valign="middle" class="mcnFollowTextContent" style="padding-left:5px;">
                                                                                    <a href="https://www.orchidhotel.com" target="" style="font-family: Helvetica;font-size: 11px;text-decoration: none;color: #505050;font-weight: bold;text-align: center;">Website</a>
                                                                                </td>
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->
                                        
                                        
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right:0; padding-bottom:9px;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                        <tbody><tr>
                                                                            
                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
                                                                                    <a href="https://twitter.com/TheOrchidMumbai" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/light-twitter-48.png" alt="Twitter" style="display:block;" height="24" width="24" class=""></a>
                                                                                </td>
                                                                            
                                                                            
                                                                                <td align="left" valign="middle" class="mcnFollowTextContent" style="padding-left:5px;">
                                                                                    <a href="https://twitter.com/TheOrchidMumbai" target="" style="font-family: Helvetica;font-size: 11px;text-decoration: none;color: #505050;font-weight: bold;text-align: center;">Twitter</a>
                                                                                </td>
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                    <!--[if mso]>
                                    </tr>
                                    </table>
                                    <![endif]-->
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>

            </td>
        </tr>
    </tbody>
</table></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td valign="top" id="templateFooter"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:9px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 9px; padding-left: 9px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/de976798b8f6f381d8a2d349b/images/535bb296-7ee2-4875-8e1c-643aeb4e016a.jpg" width="559" style="max-width:877px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top:9px;">
              	<!--[if mso]>
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
				<![endif]-->
			    
				<!--[if mso]>
				<td valign="top" width="595" style="width:595px;">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;">
                        
                            <div style="text-align: center;">Copyright ©&nbsp;&nbsp;2019&nbsp;Orchid Rewards Program |&nbsp;www.orchidhotel.com&nbsp;<br>
<br>
<br>
Our mailing address is:&nbsp;<br>
Orchid Hotels<br>
5 Star Hotels in Mumbai and Pune.<br>
Corporate Office: 70/C, Nehru Road, Near Mumbai Airport, Vile Parle (E), Mumbai, 400099<br>
<br>
<br>
</div>

                        </td>
                    </tr>
                </tbody></table>
				<!--[if mso]>
				</td>
				<![endif]-->
                
				<!--[if mso]>
				</tr>
				</table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table></td>
							</tr>
						</table>
						<!--[if gte mso 9]>
						</td>
						</tr>
						</table>
						<![endif]-->
						<!-- // END TEMPLATE -->
                    </td>
                </tr>
            </table>
        </center>';






            $leadsmail2 = " Orchidmembership@loyaltician.com";
            $mailheader2 = "From: " . $leadsmail2 . "\r\n";
            $mailheader2 .= "Reply-To: " . $leadsmail2 . "\r\n";

            $mail2 = new PHPMailer\PHPMailer\PHPMailer();

            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail2->isSMTP();                                      // Set mailer to use SMTP
            $mail2->Host = 'mail.khil.com';  // Specify main and backup SMTP servers
            $mail2->SMTPAuth = true;                               // Enable SMTP authentication
            $mail2->Username = 'orchidgoldpune@orchidhotel.com';                 // SMTP username
            $mail2->Password = 'Orchid#2022';                           // SMTP password
            $mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail2->Port = 587;                                    // TCP port to connect to
    
            //Recipients
            $mail2->setFrom('orchidgoldpune@orchidhotel.com', 'Orchid Membership');
            $mail2->addAddress('');
            $mail2->mailheader = $mailheader2;// Add a recipient
            $mail2->addAddress($fetchMem2['EmailId']);
            $mail2->addBCC('kvaljani@gmail.com ');
            $mail2->addCC('hitesh.gunwani@outlook.com');
            // $mail2->addCC($fetchMem2['EmailId']);
            $mail2->addCC('meanand.gupta21@gmail.com');

            $mail2->isHTML(true);                                  // Set email format to HTML
            $mail2->Subject = $EmailSubject2 . "\r\n";
            $mail2->Body = $message2;
            $mail2->send();
            //==============mail end===
    



        }

    }







    /////////////////////////////////////// For  Individual /////////////////////////////////////      
    else if ($Membership_Level == "Individual") {

        $drop = $_POST['drop'];
        $exp = explode(",", $drop);
        for ($kk = 0; $kk < count($exp); $kk++) {
            //   echo $exp[$i];
    

            //$Voucher=$_POST['Voucher'];
            $Member = $exp[$kk];
            $getLevel = substr($Member, 1, 1);

            if ($getLevel == "2") {
                $Level = "Orchid Gold";
            } else if ($getLevel == "3") {
                $Level = "Orchid Platinum";
            }


            $qrys1 = mysqli_query($conn, "select Static_LeadID,Primary_nameOnTheCard from Members where GenerateMember_Id='" . $Member . "'");
            $fetchMem = mysqli_fetch_array($qrys1);

            $qrys2 = mysqli_query($conn, "select EmailId from Leads_table where Lead_id='" . $fetchMem['Static_LeadID'] . "'");
            $fetchMem2 = mysqli_fetch_array($qrys2);
            //  echo $fetchMem2['EmailId'] ;
    
            //===========for mail Welcome Latter First Orchid Member===============
    
            $EmailSubject2 = "New Years Eve packages at our hotels & resorts.";
            $message2 = '';
            $message2 .= '<span class="mcnPreviewText" style="display:none; font-size:0px; line-height:0px; max-height:0px; max-width:0px; opacity:0; overflow:hidden; visibility:hidden; mso-hide:all;"></span><!--<![endif]-->
        <!--*|END:IF|*-->
        <center>
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
                <tr>
                    <td align="center" valign="top" id="bodyCell">
						<!-- BEGIN TEMPLATE // -->
						<!--[if gte mso 9]>
						<table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
						<tr>
						<td align="center" valign="top" width="600" style="width:600px;">
						<![endif]-->
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer">
							<tr>
								<td valign="top" id="templateUpperHeader" class="templateHeader">
									<table align="left" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td align="left" valign="middle">
												<img src="https://cdn-images.mailchimp.com/template_images/gallery/47662b23-df38-45d4-8005-9b2f50193f4b.png" height="30" width="15" style="boder:0; display:block;">
											</td>
											<td align="left" valign="middle" width="100%"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:9px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 9px; padding-left: 9px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/de976798b8f6f381d8a2d349b/images/4cf49a51-e749-4e4f-8614-fd06dcf6e315.png" width="524" style="max-width:736px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top:9px;">
              	<!--[if mso]>
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
				<![endif]-->
			    
				<!--[if mso]>
				<td valign="top" width="560" style="width:560px;">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;">
                        
                            <h1><span style="font-size:24px">RING IN 2020 WITH SPECIAL CELEBRATIONS</span></h1>

<h3>AT OUR HOTELS &amp; RESORTS</h3>

                        </td>
                    </tr>
                </tbody></table>
				<!--[if mso]>
				</td>
				<![endif]-->
                
				<!--[if mso]>
				</tr>
				</table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td valign="top" class="templateHeader">
									<table align="left" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td align="left" valign="middle" width="100%"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width:100%;">
    <!--[if gte mso 9]>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
	<![endif]-->
	<tbody class="mcnBoxedTextBlockOuter">
        <tr>
            <td valign="top" class="mcnBoxedTextBlockInner">
                
				<!--[if gte mso 9]>
				<td align="center" valign="top" ">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnBoxedTextContentContainer">
                    <tbody><tr>
                        
                        <td style="padding-top:9px; padding-left:18px; padding-bottom:9px; padding-right:18px;">
                        
                            <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #5A1F5A;">
                                <tbody><tr>
                                    <td valign="top" class="mcnTextContent" style="padding: 18px;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;text-align: center;">
                                        <strong>Sholay Ka SWAG at&nbsp;The Orchid Hotel Mumbai</strong>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
				<!--[if gte mso 9]>
				</td>
				<![endif]-->
                
				<!--[if gte mso 9]>
                </tr>
                </table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:0px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 0px; padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/de976798b8f6f381d8a2d349b/images/91057a2f-ff29-4ed5-9ff1-d4a77046af40.jpeg" width="590" style="max-width:902px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td valign="top" id="templateColumns">
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td valign="top">
												<!--[if gte mso 9]>
												<table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
												<tr>
												<td align="center" valign="top" width="400" style="width:400px;">
												<![endif]-->
												<table align="left" border="0" cellpadding="0" cellspacing="0" width="380" id="templateBody">
													<tr>
														<td><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top:9px;">
              	<!--[if mso]>
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
				<![endif]-->
			    
				<!--[if mso]>
				<td valign="top" width="380" style="width:380px;">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;">
                        
                            <p>A Special 10% discount is available only to our Orchid Members on Cascade &amp; Upper Deck packages.<br>
<br>
</p>

                        </td>
                    </tr>
                </tbody></table>
				<!--[if mso]>
				</td>
				<![endif]-->
                
				<!--[if mso]>
				</tr>
				</table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table></td>
													</tr>
												</table>
												<!--[if gte mso 9]>
												</td>
												<td align="center"  valign="top" width="200" style="width:200px;">
												<![endif]-->
												<table align="left" border="0" cellpadding="0" cellspacing="0" width="186" id="templateSidebar">
													<tr>
														<td align="center" valign="top" style="padding-top:9px; padding-bottom:9px;">
															<table border="0" cellpadding="5" cellspacing="5" width="150" id="calendarContainer">
																<tr>
																	<td align="center" bgcolor="#EFEFEF" valign="top" id="monthContainer">
																		<div mc:edit="month">December 2019</div>
																	</td>
																</tr>
																<tr>
																	<td align="center" valign="top" id="dayContainer">
																		<div mc:edit="day">31</div>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td valign="top"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top:9px;">
              	<!--[if mso]>
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
				<![endif]-->
			    
				<!--[if mso]>
				<td valign="top" width="186" style="width:186px;">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;">
                        
                            Sign up today, this event will sell out!
                        </td>
                    </tr>
                </tbody></table>
				<!--[if mso]>
				</td>
				<![endif]-->
                
				<!--[if mso]>
				</tr>
				</table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width:100%;">
    <tbody class="mcnButtonBlockOuter">
        <tr>
            <td style="padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top" align="center" class="mcnButtonBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonContentContainer" style="border-collapse: separate !important;border: 5px solid #FFFFFF;background-color: #60CA2E;">
                    <tbody>
                        <tr>
                            <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Helvetica; font-size: 14px; padding: 15px;">
                                <a class="mcnButton " title="REGISTER NOW" href="https://www.orchidhotel.com/new-year/new-year-query-form.html" target="_self" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">REGISTER NOW</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table></td>
													</tr>
												</table>
												<!--[if gte mso 9]>
												</td>
												</tr>
												</table>
												<![endif]-->
											</td>
											<td align="right" valign="top" style="padding-top:18px;">
												<img src="https://cdn-images.mailchimp.com/template_images/gallery/03c9e5d8-4a2f-471e-b646-37327134c2b0.png" height="30" width="15" style="boder:0; display:block;">
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td valign="top" id="templateLowerBody">
									<table align="left" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td align="left" valign="middle">
												<img src="https://cdn-images.mailchimp.com/template_images/gallery/47662b23-df38-45d4-8005-9b2f50193f4b.png" height="30" width="15" style="boder:0; display:block;">
											</td>
											<td align="left" valign="middle" width="100%"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width:100%;">
    <tbody class="mcnDividerBlockOuter">
        <tr>
            <td class="mcnDividerBlockInner" style="min-width:100%; padding:18px;">
                <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px solid #EAEAEA;">
                    <tbody><tr>
                        <td>
                            <span></span>
                        </td>
                    </tr>
                </tbody></table>
<!--            
                <td class="mcnDividerBlockInner" style="padding: 18px;">
                <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width:100%;">
    <!--[if gte mso 9]>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
	<![endif]-->
	<tbody class="mcnBoxedTextBlockOuter">
        <tr>
            <td valign="top" class="mcnBoxedTextBlockInner">
                
				<!--[if gte mso 9]>
				<td align="center" valign="top" ">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnBoxedTextContentContainer">
                    <tbody><tr>
                        
                        <td style="padding-top:9px; padding-left:18px; padding-bottom:9px; padding-right:18px;">
                        
                            <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #5A1F5A;">
                                <tbody><tr>
                                    <td valign="top" class="mcnTextContent" style="padding: 18px;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;text-align: center;">
                                        <h3 style="text-align: center;"><span style="color:#FFFFFF">New Year Packages at&nbsp;Fort JadhavGADH</span></h3>

<h3 style="text-align: center;"><span style="color:#33ffcc">Members Special</span></h3>

<p style="text-align: center;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;"><span style="color:#FFFFFF">A Special 15%&nbsp;discount is available for Orchid Members on the New Year stay packages at Fort JadhavGADH</span></p>

                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
				<!--[if gte mso 9]>
				</td>
				<![endif]-->
                
				<!--[if gte mso 9]>
                </tr>
                </table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:0px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 0px; padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/de976798b8f6f381d8a2d349b/images/2d91443d-70bd-4ec8-87b9-6eb332e8724c.png" width="575" style="max-width:1654px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width:100%;">
    <tbody class="mcnButtonBlockOuter">
        <tr>
            <td style="padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top" align="center" class="mcnButtonBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonContentContainer" style="border-collapse: separate !important;border: 5px solid #FFFFFF;background-color: #60CA2E;">
                    <tbody>
                        <tr>
                            <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Helvetica; font-size: 14px; padding: 15px;">
                                <a class="mcnButton " title="REGISTER YOUR INTEREST" href="https://www.orchidhotel.com/new-year/new-year-query-form.html" target="_self" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">REGISTER YOUR INTEREST</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width:100%;">
    <tbody class="mcnDividerBlockOuter">
        <tr>
            <td class="mcnDividerBlockInner" style="min-width:100%; padding:18px;">
                <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px solid #EAEAEA;">
                    <tbody><tr>
                        <td>
                            <span></span>
                        </td>
                    </tr>
                </tbody></table>
<!--            
                <td class="mcnDividerBlockInner" style="padding: 18px;">
                <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width:100%;">
    <!--[if gte mso 9]>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
	<![endif]-->
	<tbody class="mcnBoxedTextBlockOuter">
        <tr>
            <td valign="top" class="mcnBoxedTextBlockInner">
                
				<!--[if gte mso 9]>
				<td align="center" valign="top" ">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnBoxedTextContentContainer">
                    <tbody><tr>
                        
                        <td style="padding-top:9px; padding-left:18px; padding-bottom:9px; padding-right:18px;">
                        
                            <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #5A1F5A;">
                                <tbody><tr>
                                    <td valign="top" class="mcnTextContent" style="padding: 18px;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;text-align: center;">
                                        <div style="text-align: center;">
<h3 style="text-align: center;"><span style="color:#FFFFFF">Couples Stay Package at&nbsp;The Orchid Hotel&nbsp;Pune</span><br>
<span style="color:#cc66cc">Members Special</span></h3>

<p style="text-align: center;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;"><span style="color:#FFFFFF">A Special 10%&nbsp;discount is available for Orchid Members on the New Year stay packages at The Orchid Hotel Pune</span></p>
</div>

                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
				<!--[if gte mso 9]>
				</td>
				<![endif]-->
                
				<!--[if gte mso 9]>
                </tr>
                </table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:0px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 0px; padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/de976798b8f6f381d8a2d349b/images/3e9f15d6-4509-4ac1-9fe7-16d53959f7ef.png" width="575" style="max-width:1750px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width:100%;">
    <tbody class="mcnButtonBlockOuter">
        <tr>
            <td style="padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top" align="center" class="mcnButtonBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonContentContainer" style="border-collapse: separate !important;border: 5px solid #FFFFFF;background-color: #60CA2E;">
                    <tbody>
                        <tr>
                            <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Helvetica; font-size: 14px; padding: 15px;">
                                <a class="mcnButton " title="REGISTER YOUR INTEREST" href="https://www.orchidhotel.com/new-year/new-year-query-form.html" target="_self" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">REGISTER YOUR INTEREST</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width:100%;">
    <tbody class="mcnDividerBlockOuter">
        <tr>
            <td class="mcnDividerBlockInner" style="min-width:100%; padding:18px;">
                <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px solid #EAEAEA;">
                    <tbody><tr>
                        <td>
                            <span></span>
                        </td>
                    </tr>
                </tbody></table>
<!--            
                <td class="mcnDividerBlockInner" style="padding: 18px;">
                <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width:100%;">
    <!--[if gte mso 9]>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
	<![endif]-->
	<tbody class="mcnBoxedTextBlockOuter">
        <tr>
            <td valign="top" class="mcnBoxedTextBlockInner">
                
				<!--[if gte mso 9]>
				<td align="center" valign="top" ">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnBoxedTextContentContainer">
                    <tbody><tr>
                        
                        <td style="padding-top:9px; padding-left:18px; padding-bottom:9px; padding-right:18px;">
                        
                            <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #5A1F5A;">
                                <tbody><tr>
                                    <td valign="top" class="mcnTextContent" style="padding: 18px;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;text-align: center;">
                                        <div style="text-align: center;">
<h3 style="text-align: center;"><span style="color:#FFFFFF">New Years Bash at the Lotus Eco Beach Resort Goa</span></h3>

<h3 style="text-align: center;"><span style="color:#FFFF00">Members Special</span></h3>

<p style="text-align: center;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;"><span style="color:#FFFFFF">A Special 15%&nbsp;discount is available for Orchid Members on the New Year stay packages at Lotus Eco Beach Resort Goa</span></p>
</div>

                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
				<!--[if gte mso 9]>
				</td>
				<![endif]-->
                
				<!--[if gte mso 9]>
                </tr>
                </table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:0px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 0px; padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/de976798b8f6f381d8a2d349b/images/19386603-990e-4786-8768-e71c2e0c3d94.jpg" width="575" style="max-width:1749px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width:100%;">
    <tbody class="mcnButtonBlockOuter">
        <tr>
            <td style="padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top" align="center" class="mcnButtonBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonContentContainer" style="border-collapse: separate !important;border: 5px solid #FFFFFF;background-color: #60CA2E;">
                    <tbody>
                        <tr>
                            <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Helvetica; font-size: 14px; padding: 15px;">
                                <a class="mcnButton " title="REGISTER YOUR INTEREST" href="https://www.orchidhotel.com/new-year/new-year-query-form.html" target="_self" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">REGISTER YOUR INTEREST</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width:100%;">
    <tbody class="mcnDividerBlockOuter">
        <tr>
            <td class="mcnDividerBlockInner" style="min-width:100%; padding:18px;">
                <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px solid #EAEAEA;">
                    <tbody><tr>
                        <td>
                            <span></span>
                        </td>
                    </tr>
                </tbody></table>
<!--            
                <td class="mcnDividerBlockInner" style="padding: 18px;">
                <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width:100%;">
    <!--[if gte mso 9]>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
	<![endif]-->
	<tbody class="mcnBoxedTextBlockOuter">
        <tr>
            <td valign="top" class="mcnBoxedTextBlockInner">
                
				<!--[if gte mso 9]>
				<td align="center" valign="top" ">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnBoxedTextContentContainer">
                    <tbody><tr>
                        
                        <td style="padding-top:9px; padding-left:18px; padding-bottom:9px; padding-right:18px;">
                        
                            <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #5A1F5A;">
                                <tbody><tr>
                                    <td valign="top" class="mcnTextContent" style="padding: 18px;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;text-align: center;">
                                        <div style="text-align: center;"><strong>Welcome 2020 Exclusively at&nbsp;Lotus Eco Beach Resort&nbsp;Murud - Dapoli</strong></div>

                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
				<!--[if gte mso 9]>
				</td>
				<![endif]-->
                
				<!--[if gte mso 9]>
                </tr>
                </table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:0px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 0px; padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/de976798b8f6f381d8a2d349b/images/29dcc292-533b-403e-91f8-1d06390a9ffb.png" width="575" style="max-width:1750px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width:100%;">
    <tbody class="mcnButtonBlockOuter">
        <tr>
            <td style="padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top" align="center" class="mcnButtonBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonContentContainer" style="border-collapse: separate !important;border: 5px solid #FFFFFF;background-color: #60CA2E;">
                    <tbody>
                        <tr>
                            <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Helvetica; font-size: 14px; padding: 15px;">
                                <a class="mcnButton " title="REGISTER YOUR INTEREST" href="https://www.orchidhotel.com/new-year/new-year-query-form.html" target="_self" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">REGISTER YOUR INTEREST</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width:100%;">
    <!--[if gte mso 9]>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
	<![endif]-->
	<tbody class="mcnBoxedTextBlockOuter">
        <tr>
            <td valign="top" class="mcnBoxedTextBlockInner">
                
				<!--[if gte mso 9]>
				<td align="center" valign="top" ">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnBoxedTextContentContainer">
                    <tbody><tr>
                        
                        <td style="padding-top:9px; padding-left:18px; padding-bottom:9px; padding-right:18px;">
                        
                            <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #404040;">
                                <tbody><tr>
                                    <td valign="top" class="mcnTextContent" style="padding: 18px;color: #F2F2F2;font-family: Helvetica;font-size: 14px;font-weight: normal;text-align: center;">
                                        <strong>Limited seats, subject to availability.&nbsp;<br>
For reservations please call our Member Help Desk at&nbsp;+91 9169166789</strong>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
				<!--[if gte mso 9]>
				</td>
				<![endif]-->
                
				<!--[if gte mso 9]>
                </tr>
                </table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowBlock" style="min-width:100%;">
    <tbody class="mcnFollowBlockOuter">
        <tr>
            <td align="center" valign="top" style="padding:9px" class="mcnFollowBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentContainer" style="min-width:100%;">
    <tbody><tr>
        <td align="center" style="padding-left:9px;padding-right:9px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnFollowContent">
                <tbody><tr>
                    <td align="center" valign="top" style="padding-top:9px; padding-right:9px; padding-left:9px;">
                        <table align="center" border="0" cellpadding="0" cellspacing="0">
                            <tbody><tr>
                                <td align="center" valign="top">
                                    <!--[if mso]>
                                    <table align="center" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                    <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->
                                        
                                        
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right:10px; padding-bottom:9px;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                        <tbody><tr>
                                                                            
                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
                                                                                    <a href="https://www.facebook.com/TheOrchidHotels/" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/light-facebook-48.png" alt="Facebook" style="display:block;" height="24" width="24" class=""></a>
                                                                                </td>
                                                                            
                                                                            
                                                                                <td align="left" valign="middle" class="mcnFollowTextContent" style="padding-left:5px;">
                                                                                    <a href="https://www.facebook.com/TheOrchidHotels/" target="" style="font-family: Helvetica;font-size: 11px;text-decoration: none;color: #505050;font-weight: bold;text-align: center;">Facebook</a>
                                                                                </td>
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->
                                        
                                        
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right:10px; padding-bottom:9px;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                        <tbody><tr>
                                                                            
                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
                                                                                    <a href="https://www.instagram.com/orchidhotelpune/" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/light-instagram-48.png" alt="Instagram" style="display:block;" height="24" width="24" class=""></a>
                                                                                </td>
                                                                            
                                                                            
                                                                                <td align="left" valign="middle" class="mcnFollowTextContent" style="padding-left:5px;">
                                                                                    <a href="https://www.instagram.com/orchidhotelpune/" target="" style="font-family: Helvetica;font-size: 11px;text-decoration: none;color: #505050;font-weight: bold;text-align: center;">Instagram</a>
                                                                                </td>
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->
                                        
                                        
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right:10px; padding-bottom:9px;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                        <tbody><tr>
                                                                            
                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
                                                                                    <a href="https://www.orchidhotel.com" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/light-link-48.png" alt="Website" style="display:block;" height="24" width="24" class=""></a>
                                                                                </td>
                                                                            
                                                                            
                                                                                <td align="left" valign="middle" class="mcnFollowTextContent" style="padding-left:5px;">
                                                                                    <a href="https://www.orchidhotel.com" target="" style="font-family: Helvetica;font-size: 11px;text-decoration: none;color: #505050;font-weight: bold;text-align: center;">Website</a>
                                                                                </td>
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->
                                        
                                        
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right:0; padding-bottom:9px;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                        <tbody><tr>
                                                                            
                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
                                                                                    <a href="https://twitter.com/TheOrchidMumbai" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/light-twitter-48.png" alt="Twitter" style="display:block;" height="24" width="24" class=""></a>
                                                                                </td>
                                                                            
                                                                            
                                                                                <td align="left" valign="middle" class="mcnFollowTextContent" style="padding-left:5px;">
                                                                                    <a href="https://twitter.com/TheOrchidMumbai" target="" style="font-family: Helvetica;font-size: 11px;text-decoration: none;color: #505050;font-weight: bold;text-align: center;">Twitter</a>
                                                                                </td>
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                    <!--[if mso]>
                                    </tr>
                                    </table>
                                    <![endif]-->
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>

            </td>
        </tr>
    </tbody>
</table></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td valign="top" id="templateFooter"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:9px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 9px; padding-left: 9px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                        <img align="center" alt="" src="https://gallery.mailchimp.com/de976798b8f6f381d8a2d349b/images/535bb296-7ee2-4875-8e1c-643aeb4e016a.jpg" width="559" style="max-width:877px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top:9px;">
              	<!--[if mso]>
				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
				<tr>
				<![endif]-->
			    
				<!--[if mso]>
				<td valign="top" width="595" style="width:595px;">
				<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;">
                        
                            <div style="text-align: center;">Copyright ©&nbsp;&nbsp;2019&nbsp;Orchid Rewards Program |&nbsp;www.orchidhotel.com&nbsp;<br>
<br>
<br>
Our mailing address is:&nbsp;<br>
Orchid Hotels<br>
5 Star Hotels in Mumbai and Pune.<br>
Corporate Office: 70/C, Nehru Road, Near Mumbai Airport, Vile Parle (E), Mumbai, 400099<br>
<br>
<br>
</div>

                        </td>
                    </tr>
                </tbody></table>
				<!--[if mso]>
				</td>
				<![endif]-->
                
				<!--[if mso]>
				</tr>
				</table>
				<![endif]-->
            </td>
        </tr>
    </tbody>
</table></td>
							</tr>
						</table>
						<!--[if gte mso 9]>
						</td>
						</tr>
						</table>
						<![endif]-->
						<!-- // END TEMPLATE -->
                    </td>
                </tr>
            </table>
        </center>';




            $leadsmail2 = " Orchidmembership@loyaltician.com";
            $mailheader2 = "From: " . $leadsmail2 . "\r\n";
            $mailheader2 .= "Reply-To: " . $leadsmail2 . "\r\n";

            $mail2 = new PHPMailer\PHPMailer\PHPMailer();

            //Server settings
            // $mail2->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail2->isSMTP();                                      // Set mailer to use SMTP
            $mail2->Host = 'mail.khil.com';  // Specify main and backup SMTP servers
            $mail2->SMTPAuth = true;                               // Enable SMTP authentication
            $mail2->Username = 'orchidgoldpune@orchidhotel.com';                 // SMTP username
            $mail2->Password = 'Orchid#2022';                           // SMTP password
            $mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail2->Port = 587;                                    // TCP port to connect to
    
            //Recipients
            $mail2->setFrom('orchidgoldpune@orchidhotel.com', 'Orchid Membership');
            $mail2->addAddress($fetchMem2['EmailId']);


            $mail2->mailheader = $mailheader2;// Add a recipient
            $mail2->addCC('meanand.gupta21@gmail.com');
            $mail2->addBCC('kvaljani@gmail.com');
            // $mail2->addBCC('satyendra1111@gmail.com');
    
            $mail2->addCC('hitesh.gunwani@outlook.com');
            //$mail2->addCC($fetchMem2['EmailId']);
    

            $mail2->isHTML(true);                                  // Set email format to HTML
            $mail2->Subject = $EmailSubject2 . "\r\n";
            $mail2->Body = $message2;
            $mail2->send();


            //==============mail end===
    

            // echo "<script type='text/javascript'>alert($mail2);</script>";
    

        }


    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    


    ?>
    <script>
        swal({
            title: "Success!",
            text: "Mail Send Successfully.!",
            icon: "success",
            // buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.open("NewYearTemplateSend.php", "_self");

                }
            });

    </script>