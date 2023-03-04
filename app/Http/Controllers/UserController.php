<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class UserController extends Controller
{
    //


    public function createUser(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'mobilenumber' => 'required',
            'designation_list' => 'required',
            'password' => 'required'
        ]);

        $name = $request->name;
        $email = $request->email;
        $mobilenumber = $request->mobilenumber;
        $role = $request->designation_list;
        $password = Hash::make($request->password);
        $userid = $request->userid;
        $projectmenu = $request->projectmenu;
        $zonemenu = $request->zonemenu;
        // $regionmenu = $request->regionmenu;
        $areamenu = $request->area;
        $usersmenu = $request->users;
        $clientsmenu = $request->client;
        $estimatemenu = $request->estimate;
        $designationmenu = $request->designation;
        $drawingmenu = $request->draws;
        $engineersmenu = $request->engineers;
        $leadsmenu = $request->leads;
        $usertype = $request->designation_list;
        $stagemaster = $request->stagemaster;
        $rmzone = $request->zone;
        $drawimagess = $request->file("profilepic");
        $drawimage = $drawimagess->getClientOriginalName();
        $drawimagess->move(public_path('users'), $drawimagess->getClientOriginalName());

        $invID = 0;
        $maxValue = DB::table('users')->max('id');
        $invID = $maxValue + 1;
        $invID = str_pad($invID, 3, '0', STR_PAD_LEFT);
        $userid = "BBUSR" . $invID;

        if($validated->passes())
        {
            $saveuser = DB::table('users')
            ->insert([
                "name"=>$name,
                "email"=>$email,
                "mobilenumber"=>$mobilenumber,
                "role"=>$role,
                "password"=>$password,
                "userid"=>$userid,
                "project" => $projectmenu,
            "zones" => $zonemenu,
            "area" => $areamenu,
            // "region" => $regionmenu,
            "engineers" => $engineersmenu,
            "users" => $usersmenu,
            "clients" => $clientsmenu,
            "estimates" => $estimatemenu,
            "leads" => $leadsmenu,
            "drawings" => $drawingmenu,
            "designation" => $designationmenu,
                "usertype"=>$usertype,
                "stagemaster"=>$stagemaster,
                "rm_region"=>$rmzone,
                "user_img"=>$drawimage

            ]);

            if($saveuser)
            {
                 require base_path("vendor/autoload.php");
                $mail = new PHPMailer(true);     // Passing `true` enables exceptions

                try {

                    // Email server settings
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';             //  smtp host
                    $mail->SMTPAuth = true;
                    // $mail->Username = 'saitechnosolutionscbe@gmail.com';
                    // $mail->Password = 'lwysjixcfqanrtgr';
                    $mail->Username = 'info@businessbench.in';
                    $mail->Password = 'xjonooiofbrehtfn';
                    $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
                    $mail->Port = 587;                          // port - 587/465

                    $mail->setFrom('businessbench@gmail.com', 'Business Bench');
                    $mail->addAddress($email);
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
                        <p><b>Welcome,".$name." </b></p>
                        <p> Your Username ".$userid."</p>
                        <p> Password ".$request->password."</p>
                        <p>Congratulations!</p>
                        </body>
                        </html>
                        ";
                    $mail->isHTML(true);                // Set email content format to HTML

                    $mail->Subject = "Welcome User";
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

                return response()->json(['success'=>'User Created Successfully']);
            }
        }
        else
        {
            return response()->json(['error'=>$validated->errors()]);
        }
    }


    public function viewUsers()
    {
        $users = DB::table('users')
        ->select('*')
        ->orderBy("id","DESC")
        ->get();

        return $users;
    }


    public function authendicate(Request $request)
    {
        $request->validate(
            [
                'userid'=>'required',
                'password'=>'required'
            ]
            );

            $userid = $request->input('userid');
            $password = $request->input('password');

            // $credentials = $request->only('userid', 'password');
            $credentials = [
                'userid' => $request['userid'],
                'password' => $request['password'],
            ];


            // dd($credentials);
            $test = Auth::attempt($credentials);
            // dd($test);
            if (Auth::attempt($credentials))
            {
                $user = User::where('userid',$userid)->first();
                Auth::login($user);
                $userid = Auth::user()->userid;

                return redirect('dashboard');
            }
            else
            {
                return back()->with('error','Username or Password Incorrect...');
            }

    }

    public function deleteuser($id)
    {
        $user = DB::table('users')
        ->select('*')
        ->where('userid','=',$id)
        ->delete();

        return $user;
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function getuser($id)
    {
        $getuser = DB::table('users')
        ->select('*')
        ->where('userid','=',$id)
        ->first();

        return $getuser;
    }

    public function GetUsers(){
        $viewid = $_POST['view_id'];

        $getusers = DB::table('users')
        ->select('*')
        ->where('id','=',$viewid)
        ->get();

        $designation = DB::table('designations')->get();

        return response()->json([$getusers,$designation]);
    }

    public function UserEdit(Request $request){

        $editid = $request->input("edit_user_id");
        $name = $request->input("name");
        $mobile = $request->input("mobile");
        $password = $request->input("password");
        $old_pass = $request->input("hide_password");
        if($password != ''){
            $hash_pass = Hash::make($password);
        }else{
           echo $hash_pass = $old_pass;
        }

        $mail = $request->input("mail");
        $role = $request->input("role");
        $projectmenu = $request->input("projectmenu");
        $zonemenu = $request->input("zonemenu");
        $areamenu = $request->input("areamenu");
        $engineersmenu = $request->input("engineersmenu");
        $usersmenu = $request->input("usersmenu");
        $clientsmenu = $request->input("clientsmenu");
        $estimatemenu = $request->input("estimatemenu");
        $leadsmenu = $request->input("leadsmenu");
        $designationmenu = $request->input("designationmenu");
        $drawingmenu = $request->input("drawingmenu");

        $old_user = $request->input("old_user");
        $drawimagess = $request->file("profilepic");
        if(!empty($drawimagess)){
            $drawimage = $drawimagess->getClientOriginalName();
            $drawimagess->move(public_path('users'), $drawimagess->getClientOriginalName());
        }else{
            $drawimage = $old_user;
        }

        // die();
        $edit = DB::table('users')
              ->where('id', $editid)
              ->update(
                  ['name' => $name,
                  'email' => $mail,
                  'mobilenumber' => $mobile,
                  'role' => $role,
                  'password' => $hash_pass,
                  'project' => $projectmenu,
                  'zones' => $zonemenu,
                  'area' => $areamenu,
                  'engineers' => $engineersmenu,
                  'users' => $usersmenu,
                  'clients' => $clientsmenu,
                  'estimates' => $estimatemenu,
                  'drawings' => $drawingmenu,
                  'leads' => $leadsmenu,
                  'designation' => $designationmenu,
                  'user_img'=> $drawimage
                  ]
                );

        return back()->with("Success-User","Updated Successfully");
    }
}
