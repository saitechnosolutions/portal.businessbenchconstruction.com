<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function paymentraise(Request $request)
    {

        $payestid = $request->payestimateid;
        $payetageid = $request->payetageid;
        $payamt = $request->payamt;
        $payment_raise_date = date("Y-m-d");
        $id = $request->id;
        $esttype = $request->esttype;

        // if($request->esttype == 'Additional')
        // {
        //     $payetageid = $request->payestid;
        //     $esttype = "1";
        //     $getdetails = DB::table('additionalestmasters')
        // ->select('*')
        // ->where('additionalestid','=',$payestid)
        // ->first();
        // }
        // else
        // {
        //     $esttype = "0";
        //     $payetageid = $request->payetageid;
        //     $getdetails = DB::table('twoestimates')
        // ->select('*')
        // ->where('estid','=',$payestid)
        // ->first();
        // }

        if($esttype == 0)
        {
            $getdetails = DB::table('twoestimates')
            ->select('*')
            ->where('estid','=',$payestid)
            ->first();

            $engid = $getdetails->engineerid;
        }
        else
        {
            $getdetails = DB::table('payments')
            ->select('*')
            ->where('estimateid','=',$payestid)
            ->first();

            $engid = $getdetails->engid;
        }



          $paymentraise =  DB::table('payments')
            ->select('*')
            ->where('estimateid','=',$payestid)
            ->where('id','=',$id)
            ->update([
                "approval_status"=>0
            ]);


        // $savepayment = DB::table('payments')
        // ->insert([
        //     "estimateid" => $payestid,
        //     "stageid" => $payetageid,
        //     "payamount" => $payamt,
        //     "engid" => $getdetails->engineerid,
        //     "clientid" => $getdetails->clientid,
        //     "payment_raise_date" => $payment_raise_date,
        //     "esttype" => $esttype,
        //     "approval_status"=>0
        // ]);

        $getclientdetails = DB::table('clients')
        ->select('*')
        ->where('clientcode','=',$getdetails->clientid)
        ->first();

        if($esttype == 0)
        {
            $getquantitysurveyor = DB::table('estimaterequests')
            ->select('*')
            ->where('estimate_id','=',$payestid)
            ->first();

            $qsid = $getquantitysurveyor->assigned_to;
        }
        else
        {
            $getquantitysurveyor = DB::table('additionalestmasters')
            ->select('*')
            ->where('additionalestid','=',$payestid)
            ->first();

            $qsid = $getquantitysurveyor->qs_id;
        }


        DB::table('notifications')
            ->insert([
                "notificationview"=>$getdetails->clientid,
                "purposeid"=>$payestid,
                "purposename"=>"AE Raise Payment $payetageid Payment Amount $payamt"
            ]);

            DB::table('notifications')
            ->insert([
                "notificationview"=>$getclientdetails->rmid,
                "purposeid"=>$payestid,
                "purposename"=>"AE Raise Payment $payetageid Client ID $getdetails->clientid Payment Amount $payamt"
            ]);

            DB::table('notifications')
            ->insert([
                "notificationview"=>$qsid,
                "purposeid"=>$payestid,
                "purposename"=>"AE Raise Payment $payetageid Client ID $getdetails->clientid Payment Amount $payamt"
            ]);



        if($paymentraise)
        {
             require base_path("vendor/autoload.php");
                $mail = new PHPMailer(true);     // Passing `true` enables exceptions

                try {

                    // Email server settings
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';             //  smtp host
                    $mail->SMTPAuth = true;
                    $mail->Username = 'saitechnosolutionscbe@gmail.com';
                    $mail->Password = 'lwysjixcfqanrtgr';
                    $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
                    $mail->Port = 587;                          // port - 587/465

                    $mail->setFrom('businessbench@gmail.com', 'Business Bench');
                    $mail->addAddress($getclientdetails->emailid);
                    // $mail->addCC($request->emailCc);
                    // $mail->addBCC($request->emailBcc);

                    // $mail->addReplyTo('kesavaraj@saitechnosolutions.net', 'SenderReplyName');

                    // if(isset($_FILES['emailAttachments'])) {
                    //     for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                    //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
                    //     }
                    // }

                        $description =
                        "<html>
                        <body>
                            <h3>AE Raised Payment for $payetageid</h3>
                            <p>Payment Amount $payamt</p>
                            <p>Engineer ID $engid</p>
                            <p>Payment Raise Date $payment_raise_date</p>
                        </body>
                        </html>
                        ";
                    $mail->isHTML(true);                // Set email content format to HTML

                    $mail->Subject = "Payment Raised for AE";
                    $mail->Body    = $description;

                    // $mail->AltBody = plain text version of email body;

                    if( !$mail->send() ) {
                        return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
                    }
                    else {
                        return back()->with("success", "Email has been sent.");
                    }

                } catch (Exception $e) {
                     return back()->with('error','Message could not be sent.');
                }


        }
        return $savepayment;
    }

    public function paymentpaid(Request $request)
    {
        $payestid = $request->payestimateid;
        $payetageid = $request->payetageid;
        $payamt = $request->payamt;
        $paymentmenthod = $request->paymentmenthod;
        $payment_pay_date = date("Y-m-d");
        $clientid = $request->clientid;
        $id = $request->id;

        $updatepayment = DB::table('payments')
        ->select('*')
        ->where('estimateid','=',$payestid)
        ->where('stageid','=',$payetageid)
        ->where('id','=',$id)
        ->update([
            "payment_status" => 2,
            "approval_status" => 3,
            "payment_pay_date" => $payment_pay_date,
            "payment_mode" => $paymentmenthod

        ]);

        $getclientdetails = DB::table('clients')
        ->select('*')
        ->where('clientcode','=',$clientid)
        ->first();

        $getengineerdetails = DB::table('engineers')
        ->select('*')
        ->where('engineerid','=',$getclientdetails->engineercode)
        ->first();

        DB::table('notifications')
          ->insert([
            "notificationview"=>$getclientdetails->engineercode,
            "purposeid"=>$payetageid,
            "purposename"=>"$clientid Client Paid Amount for $payetageid"
          ]);

          $getrmid = DB::table('clients')
        ->select('*')
        ->where('clientcode','=',$clientid)
        ->first();

          DB::table('notifications')
          ->insert([
            "notificationview"=>$getrmid->rmid,
            "purposeid"=>$payetageid,
            "purposename"=>"$clientid Client Paid Amount for $payetageid"
          ]);

         require base_path("vendor/autoload.php");
                $mail = new PHPMailer(true);     // Passing `true` enables exceptions

                try {

                    // Email server settings
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';             //  smtp host
                    $mail->SMTPAuth = true;
                    $mail->Username = 'saitechnosolutionscbe@gmail.com';
                    $mail->Password = 'lwysjixcfqanrtgr';
                    $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
                    $mail->Port = 587;                          // port - 587/465

                    $mail->setFrom('businessbench@gmail.com', 'Business Bench');
                    $mail->addAddress($getengineerdetails->emailid);
                    // $mail->addCC($request->emailCc);
                    // $mail->addBCC($request->emailBcc);

                    // $mail->addReplyTo('kesavaraj@saitechnosolutions.net', 'SenderReplyName');

                    // if(isset($_FILES['emailAttachments'])) {
                    //     for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                    //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
                    //     }
                    // }

                        $description =
                        "<html>
                        <body>
                            <h3>Amount Paid for $payetageid</h3>
                            <p>Paid Amount $payamt</p>
                            <p>Engineer ID $getengineerdetails->engineerid</p>
                            <p>Amount Paid Date $payment_pay_date</p>
                            <p>Payment Method $paymentmenthod</p>
                        </body>
                        </html>
                        ";
                    $mail->isHTML(true);                // Set email content format to HTML

                    $mail->Subject = "Client Paid Amount";
                    $mail->Body    = $description;

                    // $mail->AltBody = plain text version of email body;

                    if( !$mail->send() ) {
                        return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
                    }
                    else {
                        return back()->with("success", "Email has been sent.");
                    }

                } catch (Exception $e) {
                     return back()->with('error','Message could not be sent.');
                }

        // if($request->esttype == 'Additional')
        // {
        //     $updatepayment = DB::table('payments')
        //     ->select('*')
        //     ->where('estimateid','=',$payestid)
        //     ->where('stageid','=',$payestid)
        //     ->update([
        //     "payment_status" => 2,
        //     "payment_pay_date" => $payment_pay_date,
        //     "payment_mode" => $paymentmenthod

        //     ]);

        // $getclientdetails = DB::table('clients')
        // ->select('*')
        // ->where('clientcode','=',$clientid)
        // ->first();
        // dd($getclientdetails);
        // $getengineerdetails = DB::table('engineers')
        // ->select('*')
        // ->where('engineerid','=',$getclientdetails->engineercode)
        // ->first();

        //  require base_path("vendor/autoload.php");
        //         $mail = new PHPMailer(true);

        //         try {

        //             // Email server settings
        //             $mail->SMTPDebug = 0;
        //             $mail->isSMTP();
        //             $mail->Host = 'smtp.gmail.com';             //  smtp host
        //             $mail->SMTPAuth = true;
        //             $mail->Username = 'saitechnosolutionscbe@gmail.com';
        //             $mail->Password = 'lwysjixcfqanrtgr';
        //             $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
        //             $mail->Port = 587;                          // port - 587/465

        //             $mail->setFrom('businessbench@gmail.com', 'Business Bench');
                    // $mail->addAddress($getengineerdetails->emailid);
                    // $mail->addCC($request->emailCc);
                    // $mail->addBCC($request->emailBcc);

                    // $mail->addReplyTo('kesavaraj@saitechnosolutions.net', 'SenderReplyName');

                    // if(isset($_FILES['emailAttachments'])) {
                    //     for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                    //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
                    //     }
                    // }

        //                 $description =
        //                 "<html>
        //                 <body>
        //                     <h3>Amount Paid for $payetageid</h3>
        //                     <p>Paid Amount $payamt</p>
        //                     <p>Engineer ID $getengineerdetails->engineerid</p>
        //                     <p>Amount Paid Date $payment_pay_date</p>
        //                     <p>Payment Method $paymentmenthod</p>
        //                 </body>
        //                 </html>
        //                 ";
        //             $mail->isHTML(true);                // Set email content format to HTML

        //             $mail->Subject = "Client Paid Amount";
        //             $mail->Body    = $description;

        //             $mail->AltBody = plain text version of email body;

        //             if( !$mail->send() ) {
        //                 return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
        //             }
        //             else {
        //                 return back()->with("success", "Email has been sent.");
        //             }

        //         } catch (Exception $e) {
        //              return back()->with('error','Message could not be sent.');
        //         }

        // }
        // else
        // {

        // }



        return $updatepayment;
    }


    public function paymentapprove($stageid,$estid,$esttype)
    {
        $approvedate = date("Y-m-d");

        if($esttype == "Additional")
        {
            $dateapprove = DB::table('payments')
        ->select('*')
        ->where('estimateid','=',$estid)
        ->where('stageid','=',$estid)
        ->update([
            "payment_status" => 1,
            "payment_approved_date" => $approvedate
        ]);

        $getclientdetails = DB::table('payments')
        ->where('estimateid','=',$estid)
        ->where('stageid','=',$estid)
        ->first();
         $getclient = DB::table('clients')
        ->select('*')
        ->where('clientcode','=',$getclientdetails->clientid)
        ->first();

        require base_path("vendor/autoload.php");
                $mail = new PHPMailer(true);     // Passing `true` enables exceptions

                try {

                    // Email server settings
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';             //  smtp host
                    $mail->SMTPAuth = true;
                    $mail->Username = 'saitechnosolutionscbe@gmail.com';
                    $mail->Password = 'lwysjixcfqanrtgr';
                    $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
                    $mail->Port = 587;                          // port - 587/465

                    $mail->setFrom('businessbench@gmail.com', 'Business Bench');
                    $mail->addAddress($getclient->emailid);
                    // $mail->addCC($request->emailCc);
                    // $mail->addBCC($request->emailBcc);

                    // $mail->addReplyTo('kesavaraj@saitechnosolutions.net', 'SenderReplyName');

                    // if(isset($_FILES['emailAttachments'])) {
                    //     for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                    //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
                    //     }
                    // }

                        $description =
                        "<html>
                        <body>
                            <h3>Payment Approve for $stageid</h3>
                            <p>Engineer ID $getclientdetails->engid</p>
                            <p>Approve Date $approvedate</p>
                        </body>
                        </html>
                        ";
                    $mail->isHTML(true);                // Set email content format to HTML

                    $mail->Subject = "Payment Approve";
                    $mail->Body    = $description;

                    // $mail->AltBody = plain text version of email body;

                    if( !$mail->send() ) {
                        return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
                    }
                    else {
                        return back()->with("success", "Email has been sent.");
                    }

                } catch (Exception $e) {
                     return back()->with('error','Message could not be sent.');
                }

        }
        else
        {
            $dateapprove = DB::table('payments')
        ->select('*')
        ->where('estimateid','=',$estid)
        ->where('stageid','=',$stageid)
        ->update([
            "payment_status" => 1,
            "payment_approved_date" => $approvedate
        ]);

         $getclientdetails = DB::table('payments')
        ->where('estimateid','=',$estid)
        ->where('stageid','=',$stageid)
        ->first();

        $getclient = DB::table('clients')
        ->select('*')
        ->where('clientcode','=',$getclientdetails->clientid)
        ->first();

        require base_path("vendor/autoload.php");
                $mail = new PHPMailer(true);     // Passing `true` enables exceptions

                try {

                    // Email server settings
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';             //  smtp host
                    $mail->SMTPAuth = true;
                    $mail->Username = 'saitechnosolutionscbe@gmail.com';
                    $mail->Password = 'lwysjixcfqanrtgr';
                    $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
                    $mail->Port = 587;                          // port - 587/465

                    $mail->setFrom('businessbench@gmail.com', 'Business Bench');
                    $mail->addAddress($getclient->emailid);
                    // $mail->addCC($request->emailCc);
                    // $mail->addBCC($request->emailBcc);

                    // $mail->addReplyTo('kesavaraj@saitechnosolutions.net', 'SenderReplyName');

                    // if(isset($_FILES['emailAttachments'])) {
                    //     for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                    //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
                    //     }
                    // }

                        $description =
                        "<html>
                        <body>
                            <h3>Payment Approve for $stageid</h3>
                            <p>Engineer ID $getclientdetails->engid</p>
                            <p>Approve Date $approvedate</p>
                        </body>
                        </html>
                        ";
                    $mail->isHTML(true);                // Set email content format to HTML

                    $mail->Subject = "Payment Approved";
                    $mail->Body    = $description;

                    // $mail->AltBody = plain text version of email body;

                    if( !$mail->send() ) {
                        return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
                    }
                    else {
                        return back()->with("success", "Email has been sent.");
                    }

                } catch (Exception $e) {
                     return back()->with('error','Message could not be sent.');
                }
        }


        return $dateapprove;
    }


    public function paymentdetails($id)
    {
        $payments = DB::table('payments')
        ->select('*')
        ->where('clientid','=',$id)
        ->get();

        return view('pages.paymentdetails',compact('payments'));
    }

    public function paymentcreation($engcode,$clientcode)
    {
        $payments = DB::table('payments')
        ->select('*')
        ->where('engid','=',$engcode)
        ->where('clientid','=',$clientcode)
        ->get();

        return view('pages.paymentcreation',compact('engcode','clientcode','payments'));
    }
}
