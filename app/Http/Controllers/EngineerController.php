<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Auth;



class EngineerController extends Controller
{
    //

    public function createEngineer(Request $request)
    {
        $validated = Validator::make($request->all(),[
            // 'name' => 'required',
            // 'startdate' => 'required',
            // 'enddate' => 'required',
            // 'address' => 'required',
            // 'phnumber' => 'required',
            // 'emailid' => 'required',
            // 'dealershipregion' => 'required',
            // 'dealershiparea' => 'required',
            // // 'photo' => 'required',
            // // 'aadhardocument' => 'required',
            // 'address' => 'required',
            // 'maplocation' => 'required',
        ]);

        $name = $request->name;
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $address = $request->address;
        $phnumber = $request->phnumber;
        $emailid = $request->emailid;
        $dealershipregion = $request->dealershipregion;
        $dealershiparea = $request->dealershiparea;
        // $photo = $request->photo;
        // $aadhardocument = $request->aadharnumber;
        $officeaddress = $request->officeaddress;
        $maplocation = $request->maplocation;

        $invID =0;
         $maxValue = DB::table('engineers')->max('id');
         $invID=$maxValue+1;
         $invID = str_pad($invID, 3, '0', STR_PAD_LEFT);
         $engineerid=$dealershipregion.$dealershiparea.$invID;
         if($request->hasfile('photo'))
         {
             $file = $request->file('photo');
             $extension = $file ->getClientOriginalExtension();
             $filename = time().'_eng'.'.'.$extension;
             $file->move('images/',$filename);
             $photo = $filename;
         }

         if($request->hasfile('aadhardocument'))
         {
             $file = $request->file('aadhardocument');
             $extension = $file ->getClientOriginalExtension();
             $filename = time().'_aadhar'.'.'.$extension;
             $file->move('images/',$filename);
             $aadhardocument = $filename;
         }

         if($validated->passes())
         {
            $engineers = DB::table('engineers')->insert([
                "engineerid"=>$engineerid,
                "name"=>$name,
                "startdate"=>$startdate,
                "enddate"=>$enddate,
                "address"=>$address,
                "phnumber"=>$phnumber,
                "emailid"=>$emailid,
                "dealershipregion"=>$dealershipregion,
                "dealershiparea"=>$dealershiparea,
                "photo"=>$photo,
                "aadhardocument"=>$aadhardocument,
                "officeaddress"=>$address,
                "maplocation"=>$maplocation,
            ]);

            if($engineers)
            {


                $saveusertable = DB::table('users')->insert([
                    "name"=>$name,
                    "email"=>$emailid,
                    "mobilenumber"=>$phnumber,
                    "password"=>Hash::make($name."@2022"),
                    "userid"=>$engineerid,
                    "usertype"=>"3",
                    "role"=>"3",
                    "project" => 1,
                    "zones" => 1,
                    "area" => 1,
                    "clients" => 1,
                    "estimates" => 1,
                    "leads" => 1,
                    "drawings" => 1,
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
                    $mail->addAddress($emailid);
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
                        <p><b>Dear ".$name." </b></p>
                        <p><b>Welcome to BUSINESS BENCH family!</b></p>
                        <p>We are excited to have you onboard with us as an associate engineer. We understand that you have the skills and experience to succeed in the construction industry and we want to help you make the most of your opportunities.</p>
                        <p>At Business Bench, we provide our associate engineers with a full range of services, from project selection and management to business support and guidance. We also have a secure online portal where you can easily access all the information and resources needed for your projects.</p>
                        <p>We are committed to helping our associate engineers achieve a maximum number of successful projects each year. Our team is always available to answer any questions or queries you may have, so please reach out if there is anything we can do for you.</p>
                        <p>We look forward to working with you in the future!</p>
                        <p> <b>Your username is</b> : ".$engineerid."</p>
                        <p> <b>Your password is</b> : ".$name."@2022</p>
                        <p> <b>You can access the portal at</b> : <a href='https://portal.businessbenchconstruction.com/'>Click here</a></p>
                        <p> We are looking forward to create a history</p>
                        <p><b>*Note-do not share the login credentials.*</b></p>
                        <br><br><br>
                        <p>Sincerely,</p>
                        <p>For more information </p>
                        <p>Call us - +91 8489988884, +91 8489988885</p>
                        <p>Email – Construction@businessbench.com</p>
                        <p>Website – www.businessbenchconstruction.com</p>
                        </body>
                        </html>
                        ";
                    $mail->isHTML(true);                // Set email content format to HTML

                    $mail->Subject = "Welcome to Business Bench Construction";
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
                return "not saved";
            }

         }

         return response()->json(['error'=>$validated->errors()]);
    }


    public function viewengineer()
    {

        $getengineer = DB::table('engineers')
        ->select()
        ->orderBy('id', 'desc')
        ->get();

        return $getengineer;

    }

    public function viewengineerdetails($engid)
    {
        $getsingleengineer = DB::table('engineers')
        ->select()
        ->where('engineerid','=',$engid)
        ->first();

        return $getsingleengineer;
    }

    public function deleteeng($engid)
    {
        $deleteengineer = DB::table('engineers')
        ->select()
        ->where('engineerid','=',$engid)
        ->delete();

        return response()->json(['success'=>'Data Deleted']);
    }

    public function getengineer($id)
    {
        $getengineer = DB::table('engineers')
        ->select('*')
        ->where('engineerid','=',$id)
        ->first();

        return $getengineer;
    }

    public function UpdateEngineer(){
        $viewid = $_POST['view_id'];

        $getengineer = DB::table('engineers')
        ->select('*')
        ->where('id','=',$viewid)
        ->get();

        $zone = DB::table('zones')->get();
        $area = DB::table('areas')->get();

        return response()->json([$getengineer,$zone,$area]);
    }

    public function EditEngineer(Request $request){

        $editid = $request->input("edit_engineer_id");
        $old_aadhar = $request->input("aadhar_img");
        $old_img = $request->input("photo_img");
        $name = $request->input("name");
        $startdate = $request->input("startdate");
        $enddate = $request->input("enddate");
        $address = $request->input("address");
        $maplocation = $request->input("maplocation");
        $phnumber = $request->input("phnumber");
        $emailid = $request->input("emailid");
        $aadhardocument = $request->file("aadhardocument");
        $photo = $request->file("photo");
        $area = $request->input("dealershiparea");
        $region = $request->input("dealershipregion");

        if($photo != ''){
             $file = $request->file('photo');
             $extension = $file ->getClientOriginalExtension();
             $filename = time().'photo'.'.'.$extension;
             $file->move('images/',$filename);
             $photo_new = $filename;
        }else{
            $photo_new = $old_img;
        }

        if($aadhardocument != ''){
            $file = $request->file('aadhardocument');
             $extension = $file ->getClientOriginalExtension();
             $filename = time().'_aadhar'.'.'.$extension;
             $file->move('images/',$filename);
             $aadhar_new = $filename;
        }else{
            $aadhar_new = $old_aadhar;
        }


        $edit = DB::table('engineers')
              ->where('id', $editid)
              ->update(
                  ['name' => $name,
                  'startdate' => $startdate,
                  'enddate' => $enddate,
                  'address' => $address,
                  'phnumber' => $phnumber,
                  'emailid' => $emailid,
                  'photo' => $photo_new,
                  'aadhardocument' => $aadhar_new,
                  'maplocation' => $maplocation,
                  'dealershiparea' => $area,
                  'dealershipregion' => $region]
                );

        return back()->with("Success-engineer","Success");
    }

    public function assignengineer(Request $request)
    {
        $engid = $request->engid;
        $assigneng = $request->assigneng;

        DB::table('engineers')
        ->select('*')
        ->where('engineerid','=',$engid)
        ->update([
            "rmid"=>$assigneng
        ]);

        DB::table('clients')
        ->select('*')
        ->where('engineercode','=',$engid)
        ->update([
            "rmid"=>$assigneng
            ]);
    }

    public function Areaview(){
        $area = $_POST['region'];
        $district_code = DB::table('areas')->where("district_code","=",$area)->get();

        return response()->json($district_code);
    }

}
