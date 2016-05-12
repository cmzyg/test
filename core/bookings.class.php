<?php

class Bookings extends Controller {


	public function getBookings()
	{
		// GET ALL bookings FROM THE DATABASE
		$query = 'SELECT * FROM bookings WHERE payment_received = 1 ORDER BY booking_date DESC';
		$this->selectAll($query);
		
		return $this->fetchAll();
	}

  public function getBookingsByRange($from, $to)
  {
    $from = date('Y-m-d', strtotime($from));
    $to   = date('Y-m-d', strtotime($to));
    $type = $_SESSION['type'];
    if($type !== '')
    {
      $query = "SELECT * FROM bookings WHERE (booking_date BETWEEN '$from' AND '$to') AND status = '$type' ORDER BY booking_date DESC";
      $this->selectAll($query);
    }
    else
    {
      $query = "SELECT * FROM bookings WHERE booking_date BETWEEN '$from' AND '$to' ORDER BY booking_date DESC";
      $this->selectAll($query);
    }
    
    return $this->fetchAll();
  }

	public function getBookingsByStatus($status)
	{
		// GET ALL bookings FROM THE DATABASE
		$query = 'SELECT * FROM bookings WHERE status = ? AND payment_received = 1 ORDER BY booking_date DESC';
        $bookings_array = array(
			'status' => $status
		);
		$this->selectAll($query, $bookings_array);
		return $this->fetchAll();
	}

  public function getTwoBookingsByStatus($status)
  {
    // GET ALL bookings FROM THE DATABASE
    $query = 'SELECT * FROM bookings WHERE status = ? AND payment_received = 1 ORDER BY booking_date DESC LIMIT 2';
        $bookings_array = array(
      'status' => $status
    );
    $this->selectAll($query, $bookings_array);
    return $this->fetchAll();
  }

  public function getBookingsByDate($date)
  {
    $booking_date  = $date . ' 00:00:00';
    $booking_date2 = $date . ' 23:59:59';
    // GET ALL bookings FROM THE DATABASE
    $query = "SELECT * FROM bookings WHERE booking_date BETWEEN '$booking_date' AND '$booking_date2' ORDER BY booking_date DESC";
    $this->selectAll($query);
    return $this->fetchAll();
  }

	public function getTodaysBookings()
	{
		date_default_timezone_set('Europe/London');
		$booking_date = date('Y-m-d') . ' 00:00:00';
		$booking_date2 = date('Y-m-d') . ' 23:59:59';
		// GET ALL bookings FROM THE DATABASE
		$query = "SELECT * FROM bookings WHERE booking_date BETWEEN '$booking_date' AND '$booking_date2' ORDER BY booking_date DESC";
		$this->selectAll($query);
		return $this->fetchAll();
	}

	public function countBookings()
	{
		$query = 'SELECT id FROM bookings WHERE payment_received = 1';

		return $this->rowCount($query);
	}

  public function countBookingsByDate($date)
  {
    $booking_date  = $date . ' 00:00:00';
    $booking_date2 = $date . ' 23:59:59';
    // GET ALL bookings FROM THE DATABASE
    $query = "SELECT id FROM bookings WHERE booking_date BETWEEN '$booking_date' AND '$booking_date2'";

    return $this->rowCount($query);
  }

  public function countBookingsByRange()
  {
    $from = date('Y-m-d', strtotime($_SESSION['date_from']));
    $to   = date('Y-m-d', strtotime($_SESSION['date_to']));
    // GET ALL bookings FROM THE DATABASE
    $query = "SELECT id FROM bookings WHERE booking_date BETWEEN '$from' AND '$to'";

    return $this->rowCount($query);
  }

	public function countBookingsByStatus($status)
	{
		$query = 'SELECT id FROM bookings WHERE status = ?';
		$bookings_array = array(
			'status' => $status
		);
		return $this->rowCount($query, $bookings_array);
	}

	public function performAction($action)
	{
    if($_POST['date_from'] !== '' && $_POST['date_to'] !== '')
    {
      $_SESSION['type']      = $action;
      $_SESSION['date_from'] = $_POST['date_from'];
      $_SESSION['date_to']   = $_POST['date_to'];
      $this->redirect("bookings/range/1");
    }
		if($action == 'delete')
		{
			$bookings = $_POST['bookings'];
			foreach($bookings as $row)
			{
        // delete from calendar
        $this->select("SELECT * FROM bookings WHERE id = $row");
        $booking = $this->fetch();

        $booking['booking_date'] = date('Y-m-d', strtotime($booking['booking_date']));
        $calendar_array = array(
          'booking_date' => $booking['booking_date']
        );
   
        $this->update("UPDATE bookings_calendar SET $booking[status] = $booking[status] - 1 WHERE booking_date = ?", $calendar_array);


        // delete booking
				$query = 'DELETE FROM bookings WHERE id = ?';
				$bookings_array = array(
					'id' => $row
				);
				$this->delete($query, $bookings_array);
			}
			$this->set_flashdata('Deleted', 'Bookings Deleted');
			$this->redirect('bookings/1');			
		}
		elseif($action == 'all')
		{
			$this->redirect("bookings/1");
		}
		else
		{
			$this->redirect("bookings/$action/1");
		}
	}


	public function cancelBooking($id)
	{
		date_default_timezone_set('Europe/London');
		// get booking date
		$id = $_GET['id'];
		$this->select("SELECT * FROM bookings WHERE id = $id");
		$booking_date = $this->fetch();

		// get booking id
		$array = array(
			'status'    => 'cancelled',
      'responded' => date('Y-m-d H:i:s'),
			'id'        => $_GET['id']
		);

		$this->update('UPDATE bookings SET status = ?, responded = ? WHERE id = ?', $array);


    $array_booking_date = array('booking_date' => date('Y-m-d', strtotime($booking_date['booking_date'])));
		$this->update('UPDATE bookings_calendar SET cancelled = cancelled + 1 WHERE booking_date = ?', $array_booking_date);
		$this->update("UPDATE bookings_calendar SET $booking_date[status] = $booking_date[status] - 1 WHERE booking_date = ?", $array_booking_date);

        // get website email address
        $this->select('SELECT * FROM settings');
        $array = $this->fetch();

        if($booking_date['saloon'] == 1) { $vehicles = '<li>Saloon</li>'; }
        if($booking_date['estate'] == 1) { $vehicles .= '<li>Estate</li>'; }
        if($booking_date['executive'] == 1) { $vehicles .= '<li>Executive</li>'; }
        if($booking_date['mpv'] == 1) { $vehicles .= '<li>MPV</option>'; }
        if($booking_date['minibus'] == 1) { $vehicles .= '<li>Minibus</li>'; }
        if($booking_date['minicoach'] == 1) { $vehicles .= '<li>Minicoach</li>'; }

        if($booking_date['meet_and_greet_service'] == 1)
        {
            $meet_and_greet = 'Yes';
        }
        else
        {
            $meet_and_greet = 'No';
        }

        if($booking_date['return_date'] !== '0000-00-00 00:00:00')
        {
          $booking_date['return_date'] =  '<p>Return Date: ' . date('d-m-Y H:i:s', strtotime($booking_date['return_date'])) . '</p>';
        }
        else
        {
          $booking_info['return_date'] = '';
        }

        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>CompanyXXX</title>
        </head>

        <body bgcolor="#8d8e90">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90">
        <tr>
        <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        <td width="393"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        </table></td>
        </tr>
        </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="10%">&nbsp;</td>
                <td width="80%" align="left" valign="top"><font style="font-family: Georgia, "Times New Roman", Times, serif; color:#010101; font-size:24px"></font>
                  <font style="font-family: Verdana, Geneva, sans-serif; color:#666766; font-size:13px; line-height:21px">
                  <p>Dear ' . $booking_date['fullname'] . ',</p>
                  <br />
                  <p>This is to confirm your booking has been cancelled.</p>
                  <br />
                  <p>If you pre-paid by card, we shall make a full refund in accordance with our refund / cancellation policy, details of which you can find on our website under FAQs and Terms.</p>
                  <br />
                  <p>If you have any queries or need to call us, please call ' . $array['company_name'] . ' on ' . $array['website_phone'] . '. </p>
                  <br />
                  <p><strong>Booking Details</strong></p>
                  <p>Booking ID: ' . $booking_date['booking_id'] . '</p>
                  <p>Booking Type: ' . $booking_date['booking_type'] . '</p>
                  <p>Booking made on: ' . $booking_date['received'] . '</p>
                  <br />
                  <p><strong>Journey Quoted:</strong></p>
                  <p>Pickup date and time: ' . date('d-m-Y H:i:s', strtotime($booking_date['booking_date'])) . '</p>
                  <p>Pickup: ' . $booking_date['pickup'] . '</p>
                  <p>Destination: ' . $booking_date['destination'] . '</p>                  
                  <p>Vehicle(s): <ul>' . $vehicles . '</ul></p>
                  <p>Meet & Greet: ' . $meet_and_greet . '</p>
                  ' . $booking_date['return_date'] . '
                  <p>Total Cost: &pound;' . number_format($booking_date['payment'], 2) . '</p>
                  <p>Comments: ' . $booking_date['note'] . '</p>
                  <br />
                  <p><strong>Customer Details:</strong></p>
                  <p>Name: ' . $booking_date['fullname'] . '</p>
                  <p>Tel no.: ' .$booking_date['telephone'] . '</p>
                  <p>Email: ' . $booking_date['email'] . '</p>
                  <p>Pickup address: ' . $booking_date['actual_pickup'] . '</p>
                  <p>Destination address: ' . $booking_date['actual_destination'] . '</p>
                  <br /><br />
                  <p>We appreciate your business and look forward to being of service in the near future. Thank you.</p>
                  <br /><strong><p>The Team,</p>
                  <p>' . $array['company_name'] . '</p></strong>
                  <p>Tel: ' . $array['website_phone'] . '</p>
                  <p>Email: ' . $array['website_email_address'] . '</p>
                  <p>Web: <a href="' . $array['site_url'] . '">' . $array['site_url'] . '</a></p>
                  </font></td>

                <td width="10%">&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td align="right" valign="top"><table width="108" border="0" cellspacing="0" cellpadding="0">
                


                  <tr>
                    <td height="10" align="left" valign="left"></td>
                  </tr>
                </table></td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>

        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
';


 
        // send an email to customer
        require("../core/mailer/class.phpmailer.php");
        $mail = new PHPMailer();

        $mail->From = $array['backend_email_address'];
        $mail->FromName = $array["company_name"];
        $mail->AddAddress($booking_date['email']);
        $mail->AddReplyTo($array['backend_email_address'], "Information");

        $mail->WordWrap = 50;
        $mail->IsHTML(true);                                  

        $mail->Subject = "Booking Cancelled.";
        $mail->Body    = $message;
        $mail->AltBody = "Your booking has been cancelled.";

        if(!$mail->Send())
        {
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
            exit;
        }
         

		// success message and redirect
		$this->set_flashdata('Success', '<div class="update-nag">Booking Cancelled</div>');
		$this->redirect('../bookings/1');
	}



  public function declineBooking($id)
  {
    date_default_timezone_set('Europe/London');
    // get booking date
    $id = $_GET['id'];
    $this->select("SELECT * FROM bookings WHERE id = $id");
    $booking_date = $this->fetch();

    // get booking id
    $array = array(
      'status'    => 'declined',
      'responded' => date('Y-m-d H:i:s'),
      'id'        => $_GET['id']
    );

    $this->update('UPDATE bookings SET status = ?, responded = ? WHERE id = ?', $array);


    $array_booking_date = array('booking_date' => date('Y-m-d', strtotime($booking_date['booking_date'])));
    $this->update('UPDATE bookings_calendar SET declined = declined + 1 WHERE booking_date = ?', $array_booking_date);
    $this->update("UPDATE bookings_calendar SET $booking_date[status] = $booking_date[status] - 1 WHERE booking_date = ?", $array_booking_date);

        // get website email address
        $this->select('SELECT * FROM settings');
        $array = $this->fetch();

        if($booking_date['saloon'] == 1) { $vehicles = '<li>Saloon</li>'; }
        if($booking_date['estate'] == 1) { $vehicles .= '<li>Estate</li>'; }
        if($booking_date['executive'] == 1) { $vehicles .= '<li>Executive</li>'; }
        if($booking_date['mpv'] == 1) { $vehicles .= '<li>MPV</option>'; }
        if($booking_date['minibus'] == 1) { $vehicles .= '<li>Minibus</li>'; }
        if($booking_date['minicoach'] == 1) { $vehicles .= '<li>Minicoach</li>'; }

        if($booking_date['meet_and_greet_service'] == 1)
        {
            $meet_and_greet = 'Yes';
        }
        else
        {
            $meet_and_greet = 'No';
        }

        if($booking_date['return_date'] !== '0000-00-00 00:00:00')
        {
          $booking_date['return_date'] =  '<p>Return Date: ' . date('d-m-Y H:i:s', strtotime($booking_date['return_date'])) . '</p>';
        }
        else
        {
          $booking_info['return_date'] = '';
        }

        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>CompanyXXX</title>
        </head>

        <body bgcolor="#8d8e90">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90">
        <tr>
        <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        <td width="393"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        </table></td>
        </tr>
        </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="10%">&nbsp;</td>
                <td width="80%" align="left" valign="top"><font style="font-family: Georgia, "Times New Roman", Times, serif; color:#010101; font-size:24px"></font>
                  <font style="font-family: Verdana, Geneva, sans-serif; color:#666766; font-size:13px; line-height:21px">
                  <p>Dear ' . $booking_date['fullname'] . ',</p>
                  <br />
                  <p>We regret to inform you that your booking has been declined due to no availability on the requested day and time. We’re sorry we can’t help on this occasion but hope we can be of service in the future. If you have any queries or need to call us, please call ' . $array['company_name'] . ' on ' . $array['website_phone'] . '. </p>
                  <br />
                  <p>If you pre-paid by card, we shall make a full refund in accordance with our refund / cancellation policy, details of which you can find on our website under FAQs and Terms.</p>
                  <br />
                  <p><strong>Booking Details</strong></p>
                  <p>Booking ID: ' . $booking_date['booking_id'] . '</p>
                  <p>Booking Type: ' . $booking_date['booking_type'] . '</p>
                  <p>Booking made on: ' . $booking_date['received'] . '</p>
                  <br />
                  <p><strong>Journey Quoted:</strong></p>
                  <p>Pickup date and time: ' . date('d-m-Y H:i:s', strtotime($booking_date['booking_date'])) . '</p>
                  <p>Pickup: ' . $booking_date['pickup'] . '</p>
                  <p>Destination: ' . $booking_date['destination'] . '</p>                  
                  <p>Vehicle(s): <ul>' . $vehicles . '</ul></p>
                  <p>Meet & Greet: ' . $meet_and_greet . '</p>
                  ' . $booking_date['return_date'] . '
                  <p>Total Cost: &pound;' . number_format($booking_date['payment'], 2) . '</p>
                  <p>Comments: ' . $booking_date['note'] . '</p>
                  <br />
                  <p><strong>Customer Details:</strong></p>
                  <p>Name: ' . $booking_date['fullname'] . '</p>
                  <p>Tel no.: ' .$booking_date['telephone'] . '</p>
                  <p>Email: ' . $booking_date['email'] . '</p>
                  <p>Pickup address: ' . $booking_date['actual_pickup'] . '</p>
                  <p>Destination address: ' . $booking_date['actual_destination'] . '</p>
                  <br /><br />
                  <p>We appreciate your business and look forward to being of service in the near future. Thank you.</p>
                  <br /><strong><p>The Team,</p>
                  <p>' . $array['company_name'] . '</p></strong>
                  <p>Tel: ' . $array['website_phone'] . '</p>
                  <p>Email: ' . $array['website_email_address'] . '</p>
                  <p>Web: <a href="' . $array['site_url'] . '">' . $array['site_url'] . '</a></p>
                  </font></td>

                <td width="10%">&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td align="right" valign="top"><table width="108" border="0" cellspacing="0" cellpadding="0">
                


                  <tr>
                    <td height="10" align="left" valign="left"></td>
                  </tr>
                </table></td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>

        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
';


 
        // send an email to customer
        require("../core/mailer/class.phpmailer.php");
        $mail = new PHPMailer();

        $mail->From = $array['backend_email_address'];
        $mail->FromName = $array["company_name"];
        $mail->AddAddress($booking_date['email']);
        $mail->AddReplyTo($array['backend_email_address'], "Information");

        $mail->WordWrap = 50;
        $mail->IsHTML(true);                                  

        $mail->Subject = "Booking Declined.";
        $mail->Body    = $message;
        $mail->AltBody = "Your booking has been declined.";

        if(!$mail->Send())
        {
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
            exit;
        }
         

    // success message and redirect
    $this->set_flashdata('Success', '<div class="update-nag">Booking Declined</div>');
    $this->redirect('../bookings/1');
  }



	public function acceptBooking($id)
	{
		date_default_timezone_set('Europe/London');
		// get booking date
		$array = array('id' => $this->filter($_GET['id']));
		$this->select('SELECT * FROM bookings WHERE id = ?', $array);
		$booking_date = $this->fetch();

		// get booking id
		$array = array(
			'status'    => 'accepted',
      'responded' => date('Y-m-d H:i:s'),
			'id'        => $this->filter($_GET['id'])
		);

		$this->update('UPDATE bookings SET status = ?, responded = ? WHERE id = ?', $array);


    $array_booking_date = array('booking_date' => date('Y-m-d', strtotime($booking_date['booking_date'])));
		$this->update('UPDATE bookings_calendar SET accepted = accepted + 1 WHERE booking_date = ?', $array_booking_date);
		$this->update("UPDATE bookings_calendar SET $booking_date[status] = $booking_date[status] - 1 WHERE booking_date = ?", $array_booking_date);


        // get website email address
        $this->select('SELECT * FROM settings');
        $array = $this->fetch();

        if($booking_date['saloon'] == 1) { $vehicles = '<li>Saloon</li>'; }
        if($booking_date['estate'] == 1) { $vehicles .= '<li>Estate</li>'; }
        if($booking_date['executive'] == 1) { $vehicles .= '<li>Executive</li>'; }
        if($booking_date['mpv'] == 1) { $vehicles .= '<li>MPV</option>'; }
        if($booking_date['minibus'] == 1) { $vehicles .= '<li>Minibus</li>'; }
        if($booking_date['minicoach'] == 1) { $vehicles .= '<li>Minicoach</li>'; }

        if($booking_date['meet_and_greet_service'] == 1)
        {
            $meet_and_greet = 'Yes';
        }
        else
        {
            $meet_and_greet = 'No';
        }

        if($booking_date['return_date'] !== '0000-00-00 00:00:00')
        {
          $booking_date['return_date'] =  '<p>Return Date: ' . date('d-m-Y H:i:s', strtotime($booking_date['return_date'])) . '</p>';
        }
        else
        {
          $booking_info['return_date'] = '';
        }
        

		    // send email to the customer
$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>CompanyXXX</title>
        </head>

        <body bgcolor="#8d8e90">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90">
        <tr>
        <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        <td width="393"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        </table></td>
        </tr>
        </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="10%">&nbsp;</td>
                <td width="80%" align="left" valign="top"><font style="font-family: Georgia, "Times New Roman", Times, serif; color:#010101; font-size:24px"></font>
                  <font style="font-family: Verdana, Geneva, sans-serif; color:#666766; font-size:13px; line-height:21px">
                  <p>Dear ' . $booking_date['fullname'] . ',</p>
                  <br />
                  <p> We are pleased to confirm your booking has been accepted. If you need to amend your booking, have any queries or need to call us, please call ' . $array['company_name'] . ' on ' . $array['website_phone'] . '. </p>
                  <br />
                  <p><strong>Booking Details</strong></p>
                  <p>Booking ID: ' . $booking_date['booking_id'] . '</p>
                  <p>Booking Type: ' . $booking_date['booking_type'] . '</p>
                  <p>Booking made on: ' . $booking_date['received'] . '</p>
                  <br />
                  <p><strong>Journey Quoted:</strong></p>
                  <p>Pickup date and time: ' . date('d-m-Y H:i:s', strtotime($booking_date['booking_date'])) . '</p>
                  <p>Pickup: ' . $booking_date['pickup'] . '</p>
                  <p>Destination: ' . $booking_date['destination'] . '</p>                  
                  <p>Vehicle(s): <ul>' . $vehicles . '</ul></p>
                  <p>Meet & Greet: ' . $meet_and_greet . '</p>
                  ' . $booking_date['return_date'] . '
                  <p>Total Cost: &pound;' . number_format($booking_date['payment'], 2) . '</p>
                  <p>Comments: ' . $booking_date['note'] . '</p>
                  <br />
                  <p><strong>Customer Details:</strong></p>
                  <p>Name: ' . $booking_date['fullname'] . '</p>
                  <p>Tel no.: ' .$booking_date['telephone'] . '</p>
                  <p>Email: ' . $booking_date['email'] . '</p>
                  <p>Pickup address: ' . $booking_date['actual_pickup'] . '</p>
                  <p>Destination address: ' . $booking_date['actual_destination'] . '</p>
                  <br /><br />
                  <p>We appreciate your business and look forward to being of service in the near future. Thank you.</p>
                  <br /><strong><p>The Team,</p>
                  <p>' . $array['company_name'] . '</p></strong>
                  <p>Tel: ' . $array['website_phone'] . '</p>
                  <p>Email: ' . $array['website_email_address'] . '</p>
                  <p>Web: <a href="' . $array['site_url'] . '">' . $array['site_url'] . '</a></p>
                  </font></td>

                <td width="10%">&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td align="right" valign="top"><table width="108" border="0" cellspacing="0" cellpadding="0">
                


                  <tr>
                    <td height="10" align="left" valign="left"></td>
                  </tr>
                </table></td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>

        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
';


 
        // send an email to customer
        require("../core/mailer/class.phpmailer.php");
        $mail = new PHPMailer();

        $mail->From = $array['backend_email_address'];
        $mail->FromName = $array["company_name"];
        $mail->AddAddress($booking_date['email']);
        $mail->AddReplyTo($array['backend_email_address'], "Information");

        $mail->WordWrap = 50;
        $mail->IsHTML(true);                                  

        $mail->Subject = "Booking Accepted.";
        $mail->Body    = $message;
        $mail->AltBody = "Your booking has been accepted.";

        if(!$mail->Send())
        {
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
            exit;
        }
         


		// success message and redirect
		$this->set_flashdata('Success', '<div class="update-nag">Booking accepted, confirmation email sent</div>');
		$this->redirect('../bookings/1');
	}


	public function completeBooking($id)
	{
		// get booking date
		$array = array('id' => $this->filter($_GET['id']));
		$this->select('SELECT booking_date, status FROM bookings WHERE id = ?', $array);
		$booking_date = $this->fetch();


		// get booking id
		$array = array(
			'status' => 'completed',
      'responded' => date('Y-m-d H:i:s'),
			'id'     => $this->filter($_GET['id'])
		);

		$this->update('UPDATE bookings SET status = ?, responded = ? WHERE id = ?', $array);


    $array_booking_date = array('booking_date' => date('Y-m-d', strtotime($booking_date['booking_date'])));
		$this->update('UPDATE bookings_calendar SET completed = completed + 1 WHERE booking_date = ?', $array_booking_date);
		$this->update("UPDATE bookings_calendar SET $booking_date[status] = $booking_date[status] - 1 WHERE booking_date = ?", $array_booking_date);


		// success message and redirect
		$this->set_flashdata('Success', '<div class="update-nag">Booking Completed</div>');
		$this->redirect('../bookings/1');
	}

  // automatically complete all accepted bookings that are one day old
  public function autoComplete()
  {
    $autocomplete_array = array('new_status' => 'completed', 'status' => 'accepted');
    $this->update('UPDATE bookings SET status = ? WHERE booking_date < DATE_ADD(NOW(), INTERVAL -1 DAY) AND status = ?', $autocomplete_array);
  }



}