<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usertype = Auth::user()->usertype;
        $userid = Auth::user()->userid;

        if($usertype == '3')
        {
            $leads = DB::connection('mysql2')->table('website_leads')
            ->select('*')
            ->where('ae_assign_id','=',$userid)
            ->orderBy('id', 'DESC')
            ->get();
        }
        elseif($usertype == '2')
        {
         $leads = DB::connection('mysql2')->table('website_leads')
        ->select('*')
        ->where('telecaller_assign_id','=',$userid)
        ->orderBy('id', 'DESC')
        ->get();


        }
        else
        {

            $leads = DB::connection('mysql2')->table('website_leads')
        ->select('*')
        ->where('lead_type','=',2)
        ->orderBy('id', 'DESC')
        ->get();

        }
        $telecaller = DB::table('users')
        ->select('*')
        ->where('role','=',2)
        ->orderBy('id', 'DESC')
        ->get();

        $ae = DB::table('engineers')
        ->select('*')
        ->orderBy('id', 'DESC')
        ->get();

        return view('pages.lead2',compact('leads','telecaller','ae'));
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

    public function saveLeads(Request $request)
    {
        $leads = new Lead();

        $leads->name = $request->name;
        $leads->mobile_num = $request->phnumber;
        $leads->email = $request->emailid;
        $leads->address = $request->address;
        $leads->google_map_link = $request->maplocation;
        $leads->plotarea = $request->plotarea;
        $leads->startdate = $request->startdate;
        $leads->enddate = $request->enddate;
        $leads->budgetvalue = $request->budgetvalue;
        $leads->payment = $request->payment;
        $leads->availabilityonsite = $request->availability;
        $leads->occupasion = $request->occupation;
        $leads->qnone = $request->qnone;
        $leads->qntwo = $request->qntwo;
        $leads->qnthree = $request->qnthree;
        $leads->qnfour = $request->qnfour;
        $leads->qnfive = $request->qnfive;
        $leads->qnsix = $request->qnsix;


        // $invID =0;
        // $maxValue = DB::table('leads')->max('id');
        // $invID=$maxValue+1;
        // $invID = str_pad($invID, 3, '0', STR_PAD_LEFT);
        // $leadid="LEAD".$invID;
        $leadid = $request->leadid;
        $leads->leadid = $request->leadid;
        $engid = Auth::user()->userid;
        // dd($engid);
        $leads->engineerid = $engid;
        $leads->save();

        $requirenments = $request->requirenments;

        foreach($requirenments as $req)
        {
            $requirenments = $req;


            DB::table('house_requiremnts')
            ->insert([
                "leadid"=>$leadid,
                "spec1"=>$requirenments
            ]);

        }


        $member = $request->member;
        $age = $request->age;

        foreach($member as $key => $mem)
        {
            $member = $mem;
            $age = $request->age[$key];

            DB::table('clientfamilydetails')
            ->insert([
                "name"=>$member,
                "age"=>$age,
                "leadid"=>$leadid,
            ]);

        }

    }

    public function getleaddetails($leadid)
    {
        $leads = DB::table('leads')
        ->select('*')
        ->where('leadid','=',$leadid)
        ->first();

        return $leads;
    }

    public function gethouserequirements($leadid)
    {
        $houserequirements = DB::table('house_requiremnts')
        ->select('*')
        ->where('leadid','=',$leadid)
        ->get();

        return $houserequirements;
    }

    public function getfamilymembers($leadid)
    {
        $familydetails = DB::table('clientfamilydetails')
        ->select('*')
        ->where('leadid','=',$leadid)
        ->get();

        return $familydetails;
    }

    // public function Getleads(){
    //     $leadid = $_POST['leadid'];

    //     $getleads = DB::table('leads')
    //     ->select('*')
    //     ->where('leadid','=',$leadid)
    //     ->get();

    //     return response()->json($getleads);
    // }

    public function Leadsview(){
        $leadid = $_POST['leadid'];
        // $getleads = DB::connection('mysql2')->table('website_leads')
        // ->select('*')
        // ->where('leadid','=',$leadid)
        // ->first();

         $getleads = DB::table('leads')
        ->select('*')
        ->where('leadid','=',$leadid)
        ->first();

        return response()->json($getleads);
    }

    public function Getleads(){

        $leadid = $_POST['view_id'];
        $getleads = DB::table('leads')
        ->select('*')
        ->where('id','=',$leadid)
        ->first();

        $var = $getleads->leadid;

        $get_id = DB::table('clientfamilydetails')
        ->select('*')
        ->where('leadid','=',$var)
        ->get();

        $get_require = DB::table('house_requiremnts')
        ->select('*')
        ->where('leadid','=',$var)
        ->get();

        return response()->json([$getleads,$get_id,$get_require,$var]);
    }

    public function LeadUpdate(Request $request){

        $editid = $request->input("edit_lead_id");
        $hidden_id = $request->input("hidden_lead_id");
        $name = $request->input("name");
        $mobile = $request->input("phnumber");
        $emailid = $request->input("emailid");
        $address = $request->input("address");
        $maplocation = $request->input("maplocation");
        $plotarea = $request->input("plotarea");
        $startdate = $request->input("startdate");
        $enddate = $request->input("enddate");
        $budgetvalue = $request->input("budgetvalue");
        $payment = $request->input("payment");
        $availability = $request->input("availability");
        $occupation = $request->input("occupation");
        $qnone = $request->input("qnone");
        $qntwo = $request->input("qntwo");
        $qnthree = $request->input("qnthree");
        $qnfour = $request->input("qnfour");
        $qnfive = $request->input("qnfive");
        $qnsix = $request->input("qnsix");
        // die();
        $edit = DB::table('leads')
              ->where('id', $editid)
              ->update(
                  ['name' => $name,
                  'email' => $emailid,
                  'mobile_num' => $mobile,
                  'address' => $address,
                  'google_map_link' => $maplocation,
                  'plotarea' => $plotarea,
                  'startdate' => $startdate,
                  'enddate' => $enddate,
                  'budgetvalue' => $budgetvalue,
                  'payment' => $payment,
                  'availabilityonsite' => $availability,
                  'occupasion' => $occupation,
                  'qnone' => $qnone,
                  'qntwo' => $qntwo,
                  'qnthree' => $qnthree,
                  'qnfour' => $qnfour,
                  'qnfive' => $qnfive,
                  'qnsix' => $qnsix
                  ]
                );

        $member = $request->member;
        $age = $request->age;
        $requirenments = $request->requirenments;

        $delete_requre = DB::table('house_requiremnts')
        ->select('*')
        ->where('leadid','=',$hidden_id)
        ->delete();

        $delete_family = DB::table('clientfamilydetails')
        ->select('*')
        ->where('leadid','=',$hidden_id)
        ->delete();

        foreach($requirenments as $req)
            {
                $requirenments = $req;


                DB::table('house_requiremnts')
                ->insert([
                    "leadid"=>$hidden_id,
                    "spec1"=>$requirenments
                ]);

            }

            foreach($member as $key => $mem)
            {
                $member = $mem;
                $age = $request->age[$key];

                DB::table('clientfamilydetails')
                ->insert([
                    "name"=>$member,
                    "age"=>$age,
                    "leadid"=>$hidden_id,
                ]);

            }

        return back()->with("Success-Lead","Updated Successfully");
    }

    public function DeleteLead($id)
    {
        $user = DB::table('leads')
        ->select('*')
        ->where('id','=',$id)
        ->delete();

        return response()->json("Deleted");
    }

    public function assigntelecaller(Request $request)
    {
        $telecaller = $request->telecaller;
        $leadid = $request->leadid;

        $assigned = DB::connection('mysql2')
        ->table('website_leads')
        ->select('*')
        ->where('leadid','=',$leadid)
        ->update([
            "telecaller_assign_id"=>$telecaller
        ]);
        
        $users = DB::table('users')
        ->select('*')
        ->where('userid','=',$telecaller)
        ->first();
        
        if($assigned)
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
                $mail->Port = 587;
        
                $mail->setFrom('businessbench@gmail.com', 'Business Bench');
                $mail->addAddress($users->email);
                // $mail->addCC($request->emailCc);
                // $mail->addBCC($request->emailBcc);
        
                // $mail->addReplyTo('kesavaraj@saitechnosolutions.net', 'Kesavaraj');
        
                // if(isset($_FILES['emailAttachments'])) {
                            //     for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                            //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
                            //     }
                // }
        
        
                $mail->isHTML(true);                // Set email content format to HTML
        
                $mail->Subject = "Lead Assigned";
                $mail->Body    =
                "$leadid Assigned for Telecaller Head";
        
                // $mail->AltBody = plain text version of email body;
        
                if (!$mail->send()) {
                    return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
                } else {
                    return back()->with("success", "Email has been sent.");
                }
            } catch (Exception $e) {
                return back()->with('error', 'Message could not be sent.');
            }
        }
    }

    public function assignae(Request $request)
    {
        $ae = $request->ae;
        $leadid = $request->leadid;

        $assignae = DB::connection('mysql2')
        ->table('website_leads')
        ->select('*')
        ->where('leadid','=',$leadid)
        ->update([
            "ae_assign_id"=>$ae
        ]);
        
        $aedetails = DB::table('engineers')
        ->select('*')
        ->where('engineerid','=',$ae)
        ->first();
        
        if($assignae)
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
                $mail->Port = 587;
        
                $mail->setFrom('businessbench@gmail.com', 'Business Bench');
                $mail->addAddress($aedetails->emailid);
                // $mail->addCC($request->emailCc);
                // $mail->addBCC($request->emailBcc);
        
                // $mail->addReplyTo('kesavaraj@saitechnosolutions.net', 'Kesavaraj');
        
                // if(isset($_FILES['emailAttachments'])) {
                            //     for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                            //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
                            //     }
                // }
        
        
                $mail->isHTML(true);                // Set email content format to HTML
        
                $mail->Subject = "Lead Assigned";
                $mail->Body    =
                "$leadid Assigned for Telecaller";
        
                // $mail->AltBody = plain text version of email body;
        
                if (!$mail->send()) {
                    return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
                } else {
                    return back()->with("success", "Email has been sent.");
                }
            } catch (Exception $e) {
                return back()->with('error', 'Message could not be sent.');
            }
        }
        
    }

    public function changeleadstatus(Request $request)
    {
        $leadstatus = $request->leadstatus;
        $leadid = $request->leadid3;

        DB::connection('mysql2')->table('website_leads')
        ->select('*')
        ->where('leadid','=',$leadid)
        ->update([
            "leadstatus"=>$leadstatus
        ]);

        DB::table('leads')
        ->select('*')
        ->where('leadid','=',$leadid)
        ->update([
            "leadstatus"=>$leadstatus
        ]);
    }

    public function addLead(Request $request)
    {
        $name = $request->name;
        $phnumber = $request->phnumber;
        $emailid = $request->emailid;
        $location = $request->location;

        $invID =0;
        $maxValue = DB::connection('mysql2')->table('website_leads')->max('id');
        $invID=$maxValue+1;
        $invID = str_pad($invID, 4, '0', STR_PAD_LEFT);
        $leadid="LEAD".$invID;

        $insertlead = DB::connection('mysql2')
        ->table('website_leads')
        ->insert([
            "user_name"=>$name,
            "phone_number"=>$phnumber,
            "email"=>$emailid,
            "location"=>$location,
            "leadid"=>$leadid,
            "lead_type" => 2
        ]);

        return $insertlead;
    }


    public function leaddelete($leadid)
    {
        $deletelead = DB::connection('mysql2')->table('website_leads')
        ->select('*')
        ->where('leadid','=',$leadid)
        ->delete();

        return $deletelead;
    }
}
