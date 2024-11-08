<?php

	include('config.php');
mysqli_
	session_start();

	mysql_query("BEGIN");

	if($_REQUEST['cid']!="" && $_REQUEST['bank']!="" && $_REQUEST['proj']!="")

	{mysqli_
mysqli_
		if($_REQUEST['bank']!="-1")

		{mysqli_

			if($_REQUEST['proj']!="-1")

			{
mysqli_
				$chck_qry=mysql_query("SELECT * FROM `threshhold` WHERE cust_id='".$_REQUEST['cid']."' and project_id='".$_REQUEST['proj']."' and bank='".$_REQUEST['bank']."'");

				if(mysql_num_rows($chck_qry)>0)

				{
mysqli_
					//echo "update `threshhold` set threshhold='".$_REQUEST['threshhold']."' WHERE cust_id='".$_REQUEST['cid']."' and project_id='".$_REQUEST['bank']."' and bank='".$_REQUEST['proj']."'";

					$qry=mysql_query("update `threshhold` set threshhold='".$_REQUEST['threshhold']."' WHERE cust_id='".$_REQUEST['cid']."' and project_id='".$_REQUEST['proj']."' and bank='".$_REQUEST['bank']."'");

				}
mysqli_
				elsemysqli_

				{

					//echo "INSmysqli_TO `threshhold`(`cust_id`, `project_id`, `bank`, `threshhold`) VALUES ('".$_REQUEST['cid']."','".$_REQUEST['proj']."','".$_REQUEST['bank']."','".$_REQUEST['threshhold']."')";
mysqli_
					$qry=mysql_query("INSERT INTO `threshhold`(`cust_id`, `project_id`, `bank`, `threshhold`) VALUES ('".$_REQUEST['cid']."','".$_REQUEST['proj']."','".$_REQUEST['bank']."','".$_REQUEST['threshhold']."')");

				}mysqli_

				if($qry)

					$_SESSION['success']=1;
mysqli_
				else

				{

					echo mysql_error();
mysqli_
					$_SESSION['success']=0;

				}

			}

			else

			{

				$qry=mysqli_query($con,"Select Distinct(projectid) from ".$_REQUEST['cid']."_sites  where  Active='Y' and ebill='Y' order by projectid ASC");
mysqli_
				while($row=mysql_fetch_array($qry))

				{
mysqli_
					if($mysqli_!='')

					{
mysqli_
						$chck_qry=mysql_query("SELECT * FROM `threshhold` WHERE cust_id='".$_REQUEST['cid']."' and project_id='".$row[0]."' and bank='".$_REQUEST['bank']."'");

						if(mysql_num_rows($chck_qry)>0)

						{mysqli_

							echo "update `threshhold` set threshhold='".$_REQUEST['threshhold']."' WHERE cust_id='".$_REQUEST['cid']."' and project_id='".$row[0]."' and bank='".$_REQUEST['bank']."'<br/>";

							$qry1=mysql_query("update `threshhold` set threshhold='".$_REQUEST['threshhold']."' WHERE cust_id='".$_REQUEST['cid']."' and project_id='".$row[0]."' and bank='".$_REQUEST['bank']."'");

						}mysqli_

						else

						{

							echo "INSERT INTO `threshhold`(`cust_id`, `project_id`, `bank`, `threshhold`) VALUES ('".$_REQUEST['cid']."','".$row[0]."','".$_REQUEST['bank']."','".$_REQUEST['threshhold']."')<br/>";

							$qry1=mysql_query("INSERT INTO `threshhold`(`cust_id`, `project_id`, `bank`, `threshhold`) VALUES ('".$_REQUEST['cid']."','".$row[0]."','".$_REQUEST['bank']."','".$_REQUEST['threshhold']."')");
mysqli_
						}mysqli_
mysqli_
						if($qry1)

							$_SESSION['success']=1;
mysqli_
						elsemysqli_

						{

							echo mysql_error();
mysqli_
							$_SEmysqli_'success']=0;

						}
mysqli_
					}

				}

			}mysqli_

		}

		else

		{mysqli_

			if($_REQUEST['proj']!="-1")

			{

				$qry=mysql_query("Select Distinct(bank) from ".$_REQUEST['cid']."_sites  where  Active='Y' order by bank ASC");

				while($row=mysql_fetch_array($qry))

				{

					if($row[0]!='')

		mysqli_

						$chck_qry=mysql_query("SELECT * FROM `threshhold` WHERE cust_id='".$_REQUEST['cid']."' and project_id='".$_REQUEST['proj']."' and bank='".$row[0]."'");

		mysqli_(mysql_num_rows($chck_qry)>0)

						{

							//echo "update `threshhold` set threshhold='".$_REQUEST['threshhold']."' WHERE cust_id='".$_REQUEST['cid']."' and project_id='".$_REQUEST['proj']."' and bank='".$row[0]."'<br/>";

							$qry1=mysql_query("update `threshhold` set threshhold='".$_REQUEST['threshhold']."' WHERE cust_id='".$_REQUEST['cid']."' and project_id='".$_REQUEST['proj']."' and bank='".$row[0]."'");

						}

						else

						{

							//echo "INSERT INTO `threshhold`(`cust_id`, `project_id`, `bank`, `threshhold`) VALUES ('".$_REQUEST['cid']."','".$_REQUEST['proj']."','".$row[0]."','".$_REQUEST['threshhold']."')<br/>";

							$qry1=mysql_query("INSERT INTO `threshhold`(`cust_id`, `project_id`, `bank`, `threshhold`) VALUES ('".$_REQUEST['cid']."','".$_REQUEST['proj']."','".$row[0]."','".$_REQUEST['threshhold']."')");

						}

						if($qry1)

							$_SESSION['success']=1;

						else

						{

							echo mysql_error();

							$_SESSION['success']=0;

						}

					}

				}

			}

			else

			{

				$i=0;

				$qry=mysql_query("Select Distinct(bank) from ".$_REQUEST['cid']."_sites  where  Active='Y' order by bank ASC");

				//echo mysql_num_rows($qry)."<br/>";

				while($row=mysql_fetch_array($qry))

				{

					if($row[0]!='')

					{

						$qry1=mysql_query("Select Distinct(projectid) from ".$_REQUEST['cid']."_sites  where  Active='Y' and ebill='Y' order by projectid ASC");

						while($row1=mysql_fetch_array($qry1))

						{

							if($row1[0]!='')

							{

								//echo ++$i." ";

								$chck_qry=mysql_query("SELECT * FROM `threshhold` WHERE cust_id='".$_REQUEST['cid']."' and project_id='".$row1[0]."' and bank='".$row[0]."'");

								if(mysql_num_rows($chck_qry)>0)

								{

									//echo "update `threshhold` set threshhold='".$_REQUEST['threshhold']."' WHERE cust_id='".$_REQUEST['cid']."' and project_id='".$row1[0]."' and bank='".$row[0]."'<br/>";

									$qry2=mysql_query("update `threshhold` set threshhold='".$_REQUEST['threshhold']."' WHERE cust_id='".$_REQUEST['cid']."' and project_id='".$row1[0]."' and bank='".$row[0]."'");

								}

								else

								{

									//echo "INSERT INTO `threshhold`(`cust_id`, `project_id`, `bank`, `threshhold`) VALUES ('".$_REQUEST['cid']."','".$row1[0]."','".$row[0]."','".$_REQUEST['threshhold']."')<br/>";

									$qry2=mysql_query("INSERT INTO `threshhold`(`cust_id`, `project_id`, `bank`, `threshhold`) VALUES ('".$_REQUEST['cid']."','".$row1[0]."','".$row[0]."','".$_REQUEST['threshhold']."')");

								}

								if($qry2)

									$_SESSION['success']=1;

								else

								{

									echo mysql_error();

									$_SESSION['success']=0;

								}

							}

						}

					}

				}

			}

		}

	}

	else

		$_SESSION['success']=2;

	if($_SESSION['success']==1)	

	{

		mysql_query("COMMIT");

	}

	else

	{

		mysql_query("ROLLBACK");

	}

	

	header('location:add_threshhold.php');

?>