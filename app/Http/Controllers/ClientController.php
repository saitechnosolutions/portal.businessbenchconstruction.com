<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{
    public function createClients(Request $request)
    {
        $name = $request->name;
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $address = $request->address;
        $phnumber = $request->phnumber;
        $emailid = $request->emailid;
        $estimatedvalue = $request->estimatedvalue;
        $engineercode = $request->engineercode;
        $package = $request->package;

        $services = $request->services;
        $dealershipregion = $request->dealershipregion;
        $dealershiparea = $request->dealershiparea;
        $plotarea = $request->plotarea;
        $maplocation = $request->maplocation;
        $constructionarea = $request->constructionarea;

        $rmid = $request->rmid;

        if($request->leadid == '')
        {
            $invID =0;
            $maxValue = DB::connection('mysql2')->table('website_leads')->max('id');
            $invID=$maxValue+1;
            $invID = str_pad($invID, 4, '0', STR_PAD_LEFT);
            $leadid="LEAD".$invID;

            $saveclient = DB::connection('mysql2')->table('website_leads')
         ->insert([
            "user_name"=>$name,
            "phone_number"=>$phnumber,
            "email"=>$emailid,
            "location"=>$dealershiparea,
            "leadid"=>$leadid,
            "package_type" => $request->package,
            "lead_type" => 1,
         ]);
        }
        else
        {
            $leadid = $request->leadid;
        }


        $invID =0;
         $maxValue = DB::table('clients')->max('id');
         $invID=$maxValue+1;
         $invID = str_pad($invID, 3, '0', STR_PAD_LEFT);
         $clientid=$engineercode."CL".$invID;


         $saveclient = DB::table('clients')
         ->insert([
            "name"=>$name,
            "engineercode"=>$engineercode,
            "clientcode"=>$clientid,
            "typeofservices"=>$services,
            "plotarea"=>$plotarea,
            "constructionarea"=>$constructionarea,
            "totalestimatevalue"=>$estimatedvalue,
            "projectstartdate"=>$startdate,
            "expecteddate"=>$enddate,
            "address"=>$address,
            "mobilenumber"=>$phnumber,
            "zone"=>$dealershipregion,
            "area"=>$dealershiparea,
            "googlemaplocation"=>$maplocation,
            "regionalmanagercode"=>'',
            "emailid"=>$emailid,
            "planname"=>$package,
            "leadid"=>$leadid,
            "rmid"=>$rmid
         ]);


         return $saveclient;

        //  $leadconvert = DB::table('drawings')
        //  ->select('*')
        //  ->where('leadid','=',$leadid)
        //  ->update([
        //      "clientid"=>$clientid,
        //      "status"=>''
        //      ]);
//              if($request->leadid != '')
//              {
//                  $getemailid = DB::table('drawings')
//              ->select('*')
//              ->where('leadid','=',$leadid)
//              ->first();
//              $email = DB::table('users')
//              ->select('*')
//              ->where('userid','=',$getemailid->assigned_to)
//              ->first();



// if ($email) {
//     require base_path("vendor/autoload.php");
//     $mail = new PHPMailer(true);     // Passing `true` enables exceptions

//     try {
//         // Email server settings
//         $mail->SMTPDebug = 0;
//         $mail->isSMTP();
//         $mail->Host = 'smtp.gmail.com';             //  smtp host
//         $mail->SMTPAuth = true;
//         $mail->Username = 'saitechnosolutionscbe@gmail.com';
//         $mail->Password = 'lwysjixcfqanrtgr';
//         $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
//         $mail->Port = 587;

//         $mail->setFrom('businessbench@gmail.com', 'Business Bench');
//         $mail->addAddress($email->email);
//         // $mail->addCC($request->emailCc);
//         // $mail->addBCC($request->emailBcc);

//         // $mail->addReplyTo('kesavaraj@saitechnosolutions.net', 'Kesavaraj');

//         // if(isset($_FILES['emailAttachments'])) {
//                     //     for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
//                     //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
//                     //     }
//         // }


//         $mail->isHTML(true);                // Set email content format to HTML

//         $mail->Subject = "Lead Converted";
//         $mail->Body    =
//         "$leadid Lead Converted Kindly Upload the All Drawings";

//         // $mail->AltBody = plain text version of email body;

//         if (!$mail->send()) {
//             return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
//         } else {
//             return back()->with("success", "Email has been sent.");
//         }
//     } catch (Exception $e) {
//         return back()->with('error', 'Message could not be sent.');
//     }
// }
// }


    }

    public function getclient($id)
    {
        $getclient = DB::table('clients')
        ->select('*')
        ->where('clientcode','=',$id)
        ->first();

        return $getclient;
    }

    public function getallclients()
    {
        $engid = Auth::user()->userid;
        $usertype = Auth::user()->usertype;

        $rmid = Auth::user()->rmid;
        if($usertype == 3)
        {
            $getallclient = DB::table('clients')
            ->select('*')
            ->where('engineercode','=',$engid)
            ->orderBy("id","desc")
            ->get();
        }
        else
        {
            $getallclient = DB::table('clients')
            ->select('*')
            ->orderBy("id","desc")
            ->get();
        }

        // dd($getallclient);
        $leads = DB::connection('mysql2')->table('website_leads')
        ->select('*')
        ->where('ae_assign_id','=',$engid)
        ->where('leadstatus','=',1)
        ->get();


            $rmid = DB::table('engineers')
            ->select('*')
            ->where('engineerid','=',Auth::user()->userid)
            ->first();



        // dd($rmid);

        return view('pages.clients',compact('getallclient','leads','rmid'));

    }

    public function clientdetails($id)
    {
        $clientview = DB::table('clients')
        ->select('*')
        ->where('clientcode','=',$id)
        ->first();

        return view('pages.clientdetails',compact('id','clientview'));
    }

    public function ClientView($id){

        $clientid = $id;
        $clients = DB::table('clients')
        ->select('*')
        ->where('clientcode','=',$clientid)
        ->first();

        return response()->json($clients);
    }

    public function UpdateClient(Request $request){

        $editid = $request->input("edit_client_id");
        $name = $request->input("name");
        $mobile = $request->input("phnumber");
        $emailid = $request->input("emailid");
        $address = $request->input("address");
        $maplocation = $request->input("maplocation");
        $plotarea = $request->input("plotarea");
        $startdate = $request->input("startdate");
        $enddate = $request->input("enddate");
        $estimatedvalue = $request->input("estimatedvalue");
        $services = $request->input("services");
        $package = $request->input("package");
        $dealershipregion = $request->input("dealershipregion");
        $dealershiparea = $request->input("dealershiparea");
        $constructionarea = $request->input("constructionarea");
        // die();
        $edit = DB::table('clients')
              ->where('id', $editid)
              ->update(
                  ['name' => $name,
                  'emailid' => $emailid,
                  'mobilenumber' => $mobile,
                  'address' => $address,
                  'googlemaplocation' => $maplocation,
                  'plotarea' => $plotarea,
                  'projectstartdate' => $startdate,
                  'expecteddate' => $enddate,
                  'typeofservices' => $services,
                  'totalestimatevalue' => $estimatedvalue,
                  'planname' => $package,
                  'constructionarea' => $constructionarea,
                  'zone' => $dealershipregion,
                  'area' => $dealershiparea
                  ]
                );

        return back()->with("Success-Client","Updated Successfully");
    }

    public function clientapproval(Request $request)
    {
        $clientstatus = $request->clientstatus;
        $clientapprovalid = $request->clientapprovalid;

        if($clientstatus == '2')
        {
            $getclientdetails = DB::table('clients')
            ->select('*')
            ->where('clientcode','=',$clientapprovalid)
            ->first();

            $password = Hash::make($getclientdetails->mobilenumber."@bb");
            $createuser = DB::table('users')
            ->insert([
               "name"=>$getclientdetails->name,
               "email"=>$getclientdetails->emailid,
               "mobilenumber"=>$getclientdetails->mobilenumber,
               "password"=>$password,
               "userid"=>$clientapprovalid,
               "usertype"=>"4",
               "role"=>"4"
            ]);

            $updateapprove = DB::table('clients')
            ->select('*')
            ->where('clientcode','=',$clientapprovalid)
            ->update([
                "clientapprovalstatus"=>2
            ]);

            if($createuser)
            {
               require base_path("vendor/autoload.php");
               $mail = new PHPMailer(true);     // Passing `true` enables exceptions

               try {

                   // Email server settings
                   $mail->SMTPDebug = 0;
                   $mail->isSMTP();
                   $mail->Host = 'smtp.gmail.com';             //  smtp host
                   $mail->SMTPAuth = true;
                //   $mail->Username = 'saitechnosolutionscbe@gmail.com';
                //   $mail->Password = 'lwysjixcfqanrtgr';
                    $mail->Username = 'info@businessbench.in';
                    $mail->Password = 'xjonooiofbrehtfn';
                   $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
                   $mail->Port = 587;

                   $mail->setFrom('businessbench@gmail.com', 'Business Bench');
                   $mail->addAddress($getclientdetails->emailid);
                   // $mail->addCC($request->emailCc);
                   // $mail->addBCC($request->emailBcc);

                //    $mail->addReplyTo('kesavaraj@saitechnosolutions.net', 'Kesavaraj');

                   // if(isset($_FILES['emailAttachments'])) {
                   //     for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                   //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
                   //     }
                   // }


                   $mail->isHTML(true);                // Set email content format to HTML

                   $mail->Subject = "Welcome ".$getclientdetails->name;
                   $mail->Body    =
                   "<html>
                   <head>

                   </head>
                   <body>
                   <p>Dear, $getclientdetails->name</p>
                   <br><br>
                   <p>Welcome to Business Bench! We are delighted to have you on board and look forward to providing you with our high-quality construction services.</p>
                   <br>
                   <p>This email is to provide you with your login credentials for the project portal, which is where we will keep all of your project documents, updates, and communication in one place.</p>
                   <p><b>Your username is</b> : ".$getclientdetails->clientcode."</p>
                   <p><b>Your password is</b> : ".$getclientdetails->mobilenumber."@bb</p>
                   <p> <b>You can access the portal at</b> : <a href='https://portal.businessbenchconstruction.com/'>Click here</a></p>
                   <br>
                   <p>Please feel free to reach out if you need any help getting started. We are more than happy to answer any questions or provide support as needed.</p>
                   <p>We look forward to working with you on this project!</p>
                   <br>
                   <p>Regards,</p>
                   <p><b>BUSINESS BENCH TEAM</b></p>
                   <br><br><br><br>
                   <p style='text-align:left'>Call us - +91 8489988884, +91 8489988885</p>
                   <p style='text-align:left'>Email – Construction@businessbench.com</p>
                   <p style='text-align:left'>Website – www.businessbenchconstruction.com</p>
                   <p style='text-align:left'><b>*Note-do not share the login credentials*</b></p>
                   </body>
                   </html>";

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
        }


        if($clientstatus == '3')
        {
            $getclientdetails = DB::table('clients')
            ->select('*')
            ->where('clientcode','=',$clientapprovalid)
            ->first();

            $updateapprove = DB::table('clients')
            ->select('*')
            ->where('clientcode','=',$clientapprovalid)
            ->update([
                "clientapprovalstatus"=>3
            ]);

            if($getclientdetails)
            {
               require base_path("vendor/autoload.php");
               $mail = new PHPMailer(true);     // Passing `true` enables exceptions

               try {

                   // Email server settings
                   $mail->SMTPDebug = 0;
                   $mail->isSMTP();
                   $mail->Host = 'smtp.gmail.com';             //  smtp host
                   $mail->SMTPAuth = true;
                //   $mail->Username = 'saitechnosolutionscbe@gmail.com';
                //   $mail->Password = 'lwysjixcfqanrtgr';
                $mail->Username = 'info@businessbench.in';
                    $mail->Password = 'xjonooiofbrehtfn';
                   $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
                   $mail->Port = 587;

                   $mail->setFrom('businessbenchconstruction@gmail.com', 'Business Bench');
                   $mail->addAddress($getclientdetails->emailid);
                   // $mail->addCC($request->emailCc);
                   // $mail->addBCC($request->emailBcc);

                //    $mail->addReplyTo('kesavaraj@saitechnosolutions.net', 'Kesavaraj');

                   // if(isset($_FILES['emailAttachments'])) {
                   //     for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                   //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
                   //     }
                   // }


                   $mail->isHTML(true);                // Set email content format to HTML

                   $mail->Subject = "Hi ".$getclientdetails->name;
                   $mail->Body    =
                   "<html>
                   <head>

                   </head>
                   <body>
                   <p>Hi, $getclientdetails->name</p>

                   <p>Your Request Rejected</p>

                   </body>
                   </html>";

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
        }


    }
}
